<?php
/**
 * Class ApiService
 */
namespace Api\Service;

use Api\Entity\Atividade;
use Api\Exception\ParamNotFoundException;
use Api\Repository\AtividadeRepository;
use Base\Service\AbstractService;
use Doctrine\Common\Persistence\ObjectManager;
use Api\Collection\DataCollection;
use Api\Processor\Filter;
use Zend\Stdlib\Hydrator\ClassMethods;

class ApiService extends AbstractService
{
    /**
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $repository = $objectManager->getRepository(Atividade::ENTITY);
        parent::__construct($objectManager, $repository);
    }

    /**
     * @param array $data
     * @return Atividade
     * @throws \Exception
     */
    public function create(array $data)
    {
        try {
            $atividade = new Atividade();
            $hydrator = new ClassMethods();
            $hydrator->hydrate($data, $atividade);
            $entity = $this->save($atividade);

            return $this->processResult($entity);

        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $id
     * @param $data
     * @return Atividade
     * @throws \Exception
     */
    public function update($id, $data)
    {
        try {
            $atividade = $this->find($id);
            if(! ($atividade instanceof Atividade)) {
                throw new ParamNotFoundException;
            }
            $hydrator = new ClassMethods();
            $hydrator->hydrate($data, $atividade);
            $entity = $this->save($atividade);

            return $this->processResult($entity);

        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param Atividade $atividade
     * @return Atividade $atividade
     * @throws \Exception
     */
    public function save(Atividade $atividade)
    {
        $objectManager = $this->objectManager;
        // BEGIN TRANSACTION
        $objectManager->beginTransaction();
        try {

            if(null == $atividade->getId()) {
                /** @var AtividadeRepository $repository */
                $repository = $this->repository;
                $indice = $repository->getLastIndice();

                $atividade->setIndice($indice);
                $objectManager->persist($atividade);
            }
            $objectManager->flush();
            // COMMIT
            $objectManager->commit();
            return $atividade;

        } catch ( \Exception $e ) {
            // ROLLBACK
            $objectManager->rollback();
            $objectManager->close();
            throw new \Exception("ERRO: Ao salvar os dados no banco \r" . $e->getMessage());
        }
    }

    /**
     * @param array $ids
     * @return array
     * @throws \Exception
     */
    public function organize(array $ids)
    {
        $response = array();
        $repository = $this->repository;
        $i = 1;
        foreach ( $ids as $id ) {
            /** @var Atividade $entity */
            $entity = $repository->find($id);
            $entity->setIndice($i);
            if($this->save($entity)) {
                $response['sucess'] = true;
            } else {
                $response['sucess'] = false;
                break;
            }
            $i++;
        }
        return $response;
    }

    /**
     * @param $id
     * @return Atividade
     */
    public function findAtividade($id)
    {
        $repository = $this->objectManager->getRepository(Atividade::ENTITY);
        $atividade = $repository->find($id);

        return $this->processResult($atividade);
    }

    /**
     * @param array $params
     * @return array
     */
    public function findAtividades($params)
    {
        $filter = new Filter(Atividade::ENTITY, $params);
        $filter->verify();

        $repository = $this->objectManager->getRepository(Atividade::ENTITY);
        $atividades = $repository->findBy($filter->getFilters());

        return $this->processResult($atividades);
    }

    /**
     * @param mixed $result
     * @return mixed
     */
    private function processResult($result)
    {
        $data = new DataCollection($result);
        return $data->getResult();
    }
} 
<?php
/**
 * Class ApiService
 */
namespace Api\Service;

use Api\Entity\Atividade;
use Api\Repository\AtividadeRepository;
use Base\Service\AbstractService;
use Doctrine\Common\Persistence\ObjectManager;
use Api\Collection\DataCollection;
use Api\Processor\Filter;

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
     * @param $id
     * @return Atividade
     */
    public function findCidade($id)
    {
        $repository = $this->objectManager->getRepository(Atividade::ENTITY);
        $cidade = $repository->find($id);

        return $this->processResult($cidade);
    }

    /**
     * @param array $params
     * @return array
     */
    public function findCidades($params)
    {
        $filter = new Filter(Atividade::ENTITY, $params);
        $filter->verify();

        $repository = $this->objectManager->getRepository(Atividade::ENTITY);
        $cidades = $repository->findBy($filter->getFilters());

        return $this->processResult($cidades);
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
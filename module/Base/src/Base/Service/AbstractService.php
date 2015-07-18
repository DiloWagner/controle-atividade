<?php
namespace Base\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * @class AbstractService
 * 
 * @package Base\Service
 * @author Diego
 *
 */
abstract class AbstractService
{
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $objectManager;

    /**
     * @var ObjectRepository
     */
    protected $repository;

	/**
	 * Dependency Injection
	 * @param ObjectManager $objectManager
     * @param ObjectRepository $objectRepository
	 */
	public function __construct( ObjectManager $objectManager, ObjectRepository $objectRepository )
    {
		$this->objectManager = $objectManager;
        $this->repository = $objectRepository;
	}

    /**
     * Retorna as entidades a serem iteradas
     *
     * @method findAll()
     * @return array Object
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }

    /**
     * Retorna um object pelos criterios passados por parametro
     *
     * @method findBy( array $criteria )
     * @param array $criteria
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     * @return object
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * Retorna um object pelos criterios passados por parametro
     *
     * @method findOneBy( array $criteria )
     * @param array $criteria
     * @return object
     */
    public function findOneBy(array $criteria)
    {
        return $this->repository->findOneBy( $criteria );
    }

    /**
     * Retorna apenas uma entidade pelo seu ID
     *
     * @method find($id)
     * @param $id
     * @return object
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Retorna a referencia do objeto passado por parâmetro
     *
     * @method getReference()
     * @param string $entityClass
     * @param int $id
     * @return mixed
     */
    public function getReference($entityClass, $id)
    {
        return $this->objectManager->getReference($entityClass, $id);
    }

    /**
     * @method save()
     * Método da classe abstrata para inserido ou alteração de entidades
     * @param $entity
     * @throws \Exception
     */
    public function save( $entity )
    {
        $objectManager = $this->objectManager;
        // BEGIN TRANSACTION
        $objectManager->beginTransaction();
        try {
            if(null == $entity->getId()) {
                $objectManager->persist($entity);
            }

            $objectManager->flush();
            // COMMIT
            $objectManager->commit();
            return $entity;

        } catch ( \Exception $e ) {
            // ROLLBACK
            $objectManager->rollback();
            $objectManager->close();
            throw new \Exception("ERRO: Ao salvar os dados no banco \r" . $e->getMessage());
        }
	}

    /**
     * @method delete()
     * Método da classe abstrata para excluir entidades
     * @param $entity
     * @return mixed
     * @throws \Exception
     */
    public function remove($entity)
    {
        $objectManager = $this->objectManager;
        // BEGIN TRANSACTION
        $objectManager->beginTransaction();
        try {

            $id = $entity->getId();
            // remove
            $objectManager->remove($entity);
            $objectManager->flush();
            // COMMIT
            $objectManager->commit();
            return $id;

        } catch ( \Exception $e ) {
            // ROLLBACK
            $objectManager->rollback();
            $objectManager->close();
            throw new \Exception("ERRO: Ao remover os dados no banco \r" . $e->getMessage());
        }
	}
}

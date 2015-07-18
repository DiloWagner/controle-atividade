<?php
/**
 * Class EnderecoApiServiceFactory
 *
 * @author Diego Wagner <desenvolvimento@discoverytecnologia.com.br>
 * http://www.discoverytecnologia.com.br
 */
namespace EnderecoApi\Service\Factory;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use EnderecoApi\Service\EnderecoApiService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EnderecoApiServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var ObjectManager $objectManager */
        $objectManager = $serviceLocator->get(EntityManager::class);
        return new EnderecoApiService($objectManager);
    }
} 
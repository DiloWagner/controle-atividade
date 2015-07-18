<?php
/**
 * Class AlertMessageFactory
 */
namespace Base\View\Helper\Factory;

use Base\View\Helper\AlertMessage;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AlertMessageFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $flashMessenger = $serviceLocator->get('Zend\View\Helper\FlashMessenger');
        return new AlertMessage($flashMessenger);
    }
}
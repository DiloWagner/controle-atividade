<?php
namespace App\Controller\Factory;

use App\Controller\AtividadeController;
use Zend\Form\FormElementManager;
use Zend\Form\FormInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AtividadeControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $locator = $serviceLocator->getServiceLocator();
        $service = $locator->get('api.service');
        /** @var FormElementManager $formManager */
        $formManager = $locator->get('FormElementManager');
        /** @var FormInterface $form */
        $form = $formManager->get('App\Form\AtividadeForm');

        return new AtividadeController($service, $form);
    }
}
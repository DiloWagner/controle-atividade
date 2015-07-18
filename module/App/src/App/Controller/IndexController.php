<?php
namespace App\Controller;

use Base\Controller\AbstractCrudController;
use Zend\View\Model\ViewModel;

/**
 * Controller
 * Controlador inicial da aplicação (Index)
 * @author DiegoWagner
 *
 * @see Base\Controller\AbstractCrudController
 *
 */
class IndexController extends AbstractCrudController
{
    /**
     * Override
     * Inicialização do sistema
     * (non-PHPdoc)
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        return new ViewModel();
    }
}
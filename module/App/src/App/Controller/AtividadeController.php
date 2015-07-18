<?php
namespace App\Controller;

use Api\Entity\Atividade;
use Api\Service\ApiService;
use Base\Controller\AbstractCrudController;
use Base\Enum\FlashMessages;
use Zend\Form\FormInterface;
use Zend\View\Exception\RuntimeException;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

/**
 * Controller
 * Controlador das ações de atividades *
 * @see Base\Controller\AbstractCrudController
 */
class AtividadeController extends AbstractCrudController
{
    /**
     * @param ApiService $service
     * @param FormInterface $form
     */
    public function __construct(ApiService $service, FormInterface $form)
    {
        $this->service = $service;
        $this->form    = $form;
    }

    /**
     * @method indexAction()
     * Responsável por fazer listagem de dados.
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     * @access public
     */
    public function indexAction()
    {
        try {
            $list = $this->service->findBy(array(), array('indice' => 'ASC'));
            return new ViewModel(array('data' => $list));
        } catch( \Exception $e ) {
            $this->flashMessenger()->addErrorMessage(FlashMessages::ERRO_INESPERADO);
        }
    }

    /**
     * @method newAction()
     * Criar um registro
     * @return \Zend\View\Model\ViewModel
     */
    public function newAction()
    {
        try {
            $atividade = new Atividade();
            $this->form->bind($atividade);
            $request = $this->getRequest();
            if ( $request->isPost() ) {
                $this->form->setData($request->getPost());
                if ( $this->form->isValid() ) {
                    if ( $this->service->save($this->form->getData()) ) {
                        $this->flashMessenger()->addSuccessMessage(FlashMessages::SUCESSO_PADRAO_SALVAR);
                        return $this->redirectToIndex();
                    }
                }
            }
            return $this->renderView(array('form' => $this->form));

        } catch( \Exception $e ) {
            $this->flashMessenger()->addErrorMessage(FlashMessages::ERRO_INESPERADO);
            return $this->redirectToIndex();
        }
    }

    /**
     * @method reorganizeAction()
     * Método JSON que popula as cidades baseado no estado selecionado no combo
     * @return \Zend\View\Model\JsonModel
     */
    public function reorganizeAction()
    {
        $ids = $this->params()->fromQuery('ids', 0);
        $ids = explode('-', $ids);
        $response = $this->service->organize($ids);
        $jsonModel = new JsonModel($response);
        $jsonModel->setTerminal(true);

        return $jsonModel;
    }
}
<?php
namespace Base\Controller;

use Base\Enum\FlashMessages;
use Base\Service\AbstractService;
use Zend\Form\Fieldset;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

abstract class AbstractCrudController extends AbstractActionController
{
    /**
     * @var AbstractService
     */
    protected $service;

    protected $entity;

    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @method indexAction()
     * Responsável por fazer listagem de dados.
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     * @access public
     */
    public function indexAction()
    {
        try {
            $list = $this->service->findAll();
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
     * @return \Zend\Http\Response|ViewModel
     * @throws InvalidInstanceException
     */
    public function editAction()
    {
        try {
            $id = $this->params()->fromRoute('id', 0);
            $entity = $this->service->find( $id );

            $this->form->bind($entity);
            $request = $this->getRequest();

            if ( $request->isPost() ) {
                $this->form->setData($request->getPost());
                if ( $this->form->isValid() ) {
                    if ( $this->service->save( $this->form->getData() ) ) {
                        $this->flashMessenger()->addSuccessMessage(FlashMessages::SUCESSO_PADRAO_SALVAR);
                        return $this->redirectToIndex();
                    }
                }
            }
            return $this->renderView(array('form' => $this->form,'id' => $id));

        } catch( \Exception $e ) {
            $this->flashMessenger()->addErrorMessage(FlashMessages::ERRO_INESPERADO);
        }
        return $this->redirectToIndex();
    }

    /**
     * @method deleteAction()
     * Deleta o registro
     * @return \Zend\View\Model\ViewModel
     * @access public
     */
    public function deleteAction()
    {
        try {
            $params = $this->params()->fromRoute('id');
            if ( isset ( $params ) )
                $ids = explode('-', $params);

            if ( is_array( $ids ) ) {

                foreach ($ids as $id) {
                    $entity = $this->service->find($id);
                    $result = $this->service->remove( $entity );
                    if ($result != $id) {
                        throw new \Exception(sprintf('Não é possível excluir o registro %s', $id));
                    }
                }
                $this->flashMessenger()->addSuccessMessage(FlashMessages::SUCESSO_PADRAO_REMOVER);
                return $this->redirectToIndex();

            } else
                throw new \Exception("Parâmetros não encontrados");

        } catch( \Exception $e ) {
            $this->flashMessenger()->addErrorMessage(FlashMessages::ERRO_INESPERADO);
            return $this->redirectToIndex();
        }
    }

    /**
     * Seta o script.phtml que está em outro lugar.
     * @return ViewModel
     * @access protected
     */
    protected function renderView( Array $vars, $disableLayout = null )
    {
        $view = new ViewModel();

        $rotulos = array('new' =>'Novo Registro',
            'edit'=>'Editar Registro');

        //$controller = explode(DIRECTORY_SEPARATOR, $this->getCurrentControllerName());
        $controller = explode('.', $this->getCurrentControllerName());
        $controllerName = end($controller);

        // explode a string por camelCase
        preg_match_all('/((?:^|[A-Z])[a-z]+)/', $controllerName, $matches);
        // junta as palavras com "-" e casa baixa
        $controllerName = strtolower(implode('-', $matches[0]));

        $folderView = strtolower($this->getCurrentNamespace());
        $actionName = $this->getEvent()->getRouteMatch()->getParam('action', 'NA');
        $view->setTemplate( $folderView . '/' . $controllerName . '/crud' );

        if($disableLayout) // desabilita o layout
            $view->setTerminal( true );

        $vars['action']	 = $actionName;
        if(isset($rotulos[$actionName])) {
            $vars['rotuloAction']	= $rotulos[$actionName];
        }

        return $view->setVariables($vars);

    }

    /**
     * Retorna o namespace corrente
     * EX: Control\Controller\EmpresaController
     * retorna: Control
     *
     * @method getCurrentNamespace()
     * @return string
     */
    public function getCurrentNamespace()
    {
        //$controllerClass = explode(DIRECTORY_SEPARATOR, get_class($this));
        $controllerClass = explode('\\', get_class($this));
        return reset($controllerClass);
    }

    /**
     * Retorna o noome do controller corrente
     *
     * @method getCurrentControllerName()
     * @return string
     */
    public function getCurrentControllerName()
    {
        return $this->params('controller');
    }

    /**
     * Retorna o nome da rota corrente
     *
     * @method getCurrentRouteName()
     * @return string
     */
    public function getCurrentRouteName()
    {
        $router = $this->getServiceLocator()->get('router');
        $request = $this->getServiceLocator()->get('request');
        $routeMatch = $router->match($request);
        return $routeMatch->getMatchedRouteName();
    }

    /**
     * Seta os campos do formulário como desabilitado
     * @param Fieldset $form
     * @access protected
     */
    protected function disableFormFields( Fieldset $form )
    {
        $elements = $form->getElements();
        /** @var \Zend\Form\Element $element */
        foreach ( $elements as $element ) {
            $element->setAttributes(array('readonly' => true, 'disabled' => true));
        }
    }

    /**
     * Redireciona o usuário novamente para a listagem
     * @method redirectToIndex()
     * @access protected
     * @return \Zend\Http\Response
     */
    protected function redirectToIndex()
    {
        return $this->redirect()->toRoute(
            $this->getCurrentRouteName(),
            array( 'controller' => strtolower($this->getCurrentControllerName())
            ) );
    }

    /**
     * Redireciona o usuário novamente para a listagem
     * @method redirectToIndex()
     * @access protected
     * @return \Zend\Http\Response
     */
    protected function redirectToHome()
    {
        return $this->redirect()->toRoute(
            'admin-index',
            array( 'controller' => 'index'
            ) );
    }
}
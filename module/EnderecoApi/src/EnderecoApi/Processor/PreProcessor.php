<?php
namespace EnderecoApi\Processor;

use Zend\Http\PhpEnvironment\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;

/**
 * Responsável por fazer o pré-processamento das requisições da APi
 * 
 * @category Api
 * @package PreProcessor
 * @author  Diego Wagner <diegowagner4@gmail.com>
 */
class PreProcessor 
{
    /**
     * Executado no pré-processamento, antes de qualquer action
     * Verifica se o usuário tem permissão de acessar o recurso
     * 
     * @param MvcEvent $e
     * @return null|\Zend\Http\PhpEnvironment\Response
     */
    public function process(MvcEvent $e)
    {
        $this->configureEnvironment($e);
        $serviceLocator = $e->getTarget()->getServiceLocator();
        $config = $serviceLocator->get('Config');
        $apiConfig = $config['api'];
        //acesso requer um token válido e permissões de acesso
        if (false !== $apiConfig['authorization']) {
            //return $this->checkAuthorization($e, $apiConfig);
        }
        return true;
    }

    /**
     * @param MvcEvent $event
     * @param array $apiConfig
     * @return bool|Response
     */
    private function checkAuthorization(MvcEvent $event, array $apiConfig)
    {
        /** @var Request $request */
        $request = $event->getRequest();
        $origin = $request->getServer('HTTP_ORIGIN');
        if(!in_array($origin, $apiConfig['domains'])) {
            /** @var Response $response */
            $response = $event->getResponse();
            $response->setStatusCode(Response::STATUS_CODE_401);
            return $response;
        }
        return true;
    }

    /**
     * Verifica se a api está sendo acessada de um ambiente de testes 
     * e configura o ambiente
     * @param  MvcEvent $e Evento
     * @return void
     */
    private function configureEnvironment(MvcEvent $e)
    {
        if ( !method_exists($e->getRequest(), 'getHeaders')) {
            return;
        }

        $env = $e->getRequest()->getHeaders('Environment');
        if ($env) {
            switch ($env->getFieldValue()) {
                case 'testing':
                    putenv("ENV=testing");
                    break;
                case 'jenkins':
                    putenv("ENV=jenkins");
                    break;
                
            }
        }
        return;
    }
}
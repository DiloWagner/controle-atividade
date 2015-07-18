<?php
namespace EnderecoApi\Processor;

use Zend\Di\Di;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

/**
 * Responsável por fazer o pós-processamento das requisições da APi
 * 
 * @category Api
 * @package PostProcessor
 * @author  Diego Wagner <diegowagner4@gmail.com>
 */
class PostProcessor
{
    /**
     * Executado no pós-processamento, após qualquer action
     * Verifica o formato requisitado (json ou xml) e gera a saída correspondente
     *
     * @param MvcEvent $e
     * @return \Zend\Http\Response
     * @throws \Exception
     */
    public function process(MvcEvent $e)
    {
        $routeMatch = $e->getRouteMatch();
        /** @var Response $response */
        $response = $e->getResponse();
        $formatter  = $routeMatch->getParam('formatter', false);
        if (false === $formatter) {
            $response->setStatusCode(Response::STATUS_CODE_404);
            return $response;
        }

        $serviceLocator = $e->getTarget()->getServiceLocator();
        $config = $serviceLocator->get('Config');
        $apiConfig = $config['api'];

        if(!in_array($formatter, $apiConfig['formatters']['types'])) {
            throw new \Exception('Invalid formatter.');
        }

        /** @var Di $di */
        $di = $serviceLocator->get('di');
        if ($e->getResult() instanceof ViewModel) {
            $vars = null;
            if (is_array($e->getResult()->getVariables())) {
                $vars = $e->getResult()->getVariables();
            }
        } else {
            $vars = $e->getResult();
        }
        /** @var AbstractPostProcessor $postProcessor */
        $postProcessor = $di->get($formatter, []);
        if(!($postProcessor instanceof AbstractPostProcessor)) {
            throw new \Exception('Invalid formatter.');
        }
        $postProcessor->setResponse($response);
        $postProcessor->setVars($vars);
        $postProcessor->process();

        return $postProcessor->getResponse();
    }
}
<?php
/**
 * Class AbstractPostProcessor
 *
 * @author Diego Wagner <desenvolvimento@discoverytecnologia.com.br>
 * http://www.discoverytecnologia.com.br
 */
namespace EnderecoApi\Processor;

use Zend\Http\Response;

abstract class AbstractPostProcessor
{
    /**
     * @var Response
     */
    protected $response;

    /**
     * @var array
     */
    protected $vars;

    /**
     * @return Response
     * @author DiegoWagner <diegowagner4@gmail.com>
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param Response $response
     * @author DiegoWagner <diegowagner4@gmail.com>
     * @return $this
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return array
     * @author DiegoWagner <diegowagner4@gmail.com>
     */
    public function getVars()
    {
        return $this->vars;
    }

    /**
     * @param array $vars
     * @author DiegoWagner <diegowagner4@gmail.com>
     * @return $this
     */
    public function setVars($vars)
    {
        $this->vars = $vars;
        return $this;
    }

    abstract public function process();
} 
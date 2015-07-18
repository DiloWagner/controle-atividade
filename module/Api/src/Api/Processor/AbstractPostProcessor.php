<?php
/**
 * Class AbstractPostProcessor
 */
namespace Api\Processor;

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
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param Response $response
     * @return $this
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return array
     */
    public function getVars()
    {
        return $this->vars;
    }

    /**
     * @param array $vars
     * @return $this
     */
    public function setVars($vars)
    {
        $this->vars = $vars;
        return $this;
    }

    abstract public function process();
} 
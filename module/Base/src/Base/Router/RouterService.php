<?php
/**
 * Class RouterService
 */
namespace Base\Router;

use Zend\Http\Request;
use Zend\Mvc\Router\RouteInterface;

class RouterService
{
    /**
     * @var RouteInterface
     */
    protected $router;

    /**
     * @var Request
     */
    protected $request;

    public function __construct(RouteInterface $router, Request $request)
    {
        $this->router  = $router;
        $this->request = $request;
    }

    /**
     * @param $identify
     * @return mixed
     */
    public function getParam($identify)
    {
        $routeMatch = $this->router->match($this->request);
        return $routeMatch->getParam($identify);
    }
} 
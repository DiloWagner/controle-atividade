<?php
/**
 * Class IndexController
 *
 * @author Diego Wagner <desenvolvimento@discoverytecnologia.com.br>
 * http://www.discoverytecnologia.com.br
 */
namespace EnderecoApi\Controller;

use EnderecoApi\Exception\ParamNotFoundException;
use EnderecoApi\Service\EnderecoApiService;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class BuscaEnderecoController extends AbstractRestfulController
{
    /**
     * @var EnderecoApiService
     */
    private $service;

    /**
     * @param EnderecoApiService $service
     */
    public function __construct(EnderecoApiService $service)
    {
        $this->service = $service;
    }

    /**
     * @param int $id
     * @return mixed|JsonModel
     */
    public function get($id)
    {
        try {
            return $this->service->findEndereco($id);
        } catch(\Exception $e) {
            $this->response->setStatusCode(Response::STATUS_CODE_500);
        }
    }

    /**
     * @return array|mixed
     */
    public function getList()
    {
        $params = $this->params()->fromQuery();
        try {
            return $this->service->findEnderecos($params);
        } catch(ParamNotFoundException $pr) {
            $this->response->setStatusCode(Response::STATUS_CODE_404);
        } catch(\Exception $e) {
            $this->response->setStatusCode(Response::STATUS_CODE_500);
        }
    }
} 
<?php
namespace Api\Controller;

use Api\Exception\ParamNotFoundException;
use Api\Service\ApiService;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class AtividadeApiRestController extends AbstractRestfulController
{
    /**
     * @var ApiService
     */
    private $service;

    /**
     * @param ApiService $service
     */
    public function __construct(ApiService $service)
    {
        $this->service = $service;
    }

    /**
     * @param mixed $id
     * @return mixed|JsonModel
     */
    public function get($id)
    {
        try {
            return $this->service->findAtividade($id);
        } catch(\Exception $e) {
            $this->response->setStatusCode(Response::STATUS_CODE_500);
        }
    }

    /**
     * @return mixed|void
     */
    public function getList()
    {
        $params = $this->params()->fromQuery();
        try {
            return $this->service->findAtividades($params);
        } catch(ParamNotFoundException $pr) {
            $this->response->setStatusCode(Response::STATUS_CODE_404);
        } catch(\Exception $e) {
            $this->response->setStatusCode(Response::STATUS_CODE_500);
        }
    }

    /**
     * @method POST
     * @param mixed $data
     * @return \Api\Entity\Atividade|array
     * @throws \Exception
     * @see \Zend\Mvc\Controller\AbstractRestfulController::create()
     */
    public function create($data)
    {
        try {
            return $this->service->create($data);
        } catch(\Exception $e) {
            $this->response->setStatusCode(Response::STATUS_CODE_500);
        }
    }

    /**
     * @method DELETE
     * @param $id
     * @return int
     * @throws \Exception
     * (non-PHPdoc)
     * @see \Zend\Mvc\Controller\AbstractRestfulController::delete()
     */
    public function delete($id)
    {
        try {
            $atividade = $this->service->findAtividade($id);
            return $this->service->remove($atividade);
        } catch(\Exception $e) {
            $this->response->setStatusCode(Response::STATUS_CODE_500);
        }
    }

    /**
     * @method PUT
     * @param mixed $id
     * @param mixed $data
     * @return \Api\Entity\Atividade
     * (non-PHPdoc)
     * @see \Zend\Mvc\Controller\AbstractRestfulController::update()
     */
    public function update($id, $data)
    {
        try {
            return $this->service->update($id, $data);
        } catch(\Exception $e) {
            $this->response->setStatusCode(Response::STATUS_CODE_500);
        }
    }
} 
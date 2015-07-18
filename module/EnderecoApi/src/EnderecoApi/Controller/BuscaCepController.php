<?php
/**
 * Class CepController
 *
 * @author Diego Wagner <desenvolvimento@discoverytecnologia.com.br>
 * http://www.discoverytecnologia.com.br
 */
namespace EnderecoApi\Controller;

use EnderecoApi\Entity\Endereco;
use EnderecoApi\Service\EnderecoApiService;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Helper\ViewModel;
use Zend\View\Model\JsonModel;

class BuscaCepController extends AbstractRestfulController
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
     * @param string $cep
     * @return mixed|JsonModel
     */
    public function get($cep)
    {
        try {
            /** @var Endereco $endereco */
            return $this->service->findEnderecoByCep($cep);
        } catch(\Exception $e) {
            $this->response->setStatusCode(Response::STATUS_CODE_500);
        }
    }
}

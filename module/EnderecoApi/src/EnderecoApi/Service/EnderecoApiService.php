<?php
/**
 * Class EnderecoApiService
 *
 * @author Diego Wagner <desenvolvimento@discoverytecnologia.com.br>
 * http://www.discoverytecnologia.com.br
 */
namespace EnderecoApi\Service;

use Doctrine\Common\Persistence\ObjectManager;
use EnderecoApi\Collection\DataCollection;
use EnderecoApi\Entity\Bairro;
use EnderecoApi\Entity\Cidade;
use EnderecoApi\Entity\Endereco;
use EnderecoApi\Entity\Uf;
use EnderecoApi\Processor\Filter;

class EnderecoApiService
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param $cep
     * @return mixed
     */
    public function findEnderecoByCep($cep)
    {
        $repository = $this->objectManager->getRepository(Endereco::class);
        $endereco = $repository->findOneBy(['cep' => $cep]);

        return $this->processResult($endereco);
    }

    /**
     * @param $id
     * @return Endereco
     */
    public function findEndereco($id)
    {
        $repository = $this->objectManager->getRepository(Endereco::class);
        $endereco = $repository->findOneBy(['id' => $id]);

        return $this->processResult($endereco);
    }

    /**
     * @param array $params
     * @return array
     */
    public function findEnderecos($params)
    {
        $filter = new Filter(Endereco::class, $params);
        $filter->verify();

        $repository = $this->objectManager->getRepository(Endereco::class);
        $enderecos = $repository->findBy($filter->getFilters());

        return $this->processResult($enderecos);
    }

    /**
     * @param $id
     * @return Bairro
     */
    public function findBairro($id)
    {
        $repository = $this->objectManager->getRepository(Bairro::class);
        $bairro = $repository->findOneBy(['id' => $id]);

        return $this->processResult($bairro);
    }

    /**
     * @param array $params
     * @return array
     */
    public function findBairros($params)
    {
        $filter = new Filter(Bairro::class, $params);
        $filter->verify();

        $repository = $this->objectManager->getRepository(Bairro::class);
        $bairros = $repository->findBy($filter->getFilters());

        return $this->processResult($bairros);
    }

    /**
     * @param $id
     * @return Cidade
     */
    public function findCidade($id)
    {
        $repository = $this->objectManager->getRepository(Cidade::class);
        $cidade = $repository->findOneBy(['id' => $id]);

        return $this->processResult($cidade);
    }

    /**
     * @param array $params
     * @return array
     */
    public function findCidades($params)
    {
        $filter = new Filter(Cidade::class, $params);
        $filter->verify();

        $repository = $this->objectManager->getRepository(Cidade::class);
        $cidades = $repository->findBy($filter->getFilters());

        return $this->processResult($cidades);
    }

    /**
     * @param $id
     * @return Uf
     */
    public function findEstado($id)
    {
        $repository = $this->objectManager->getRepository(Uf::class);
        $estado = $repository->findOneBy(['id' => $id]);

        return $this->processResult($estado);
    }

    /**
     * @param array $params
     * @return array
     */
    public function findEstados($params)
    {
        $filter = new Filter(Uf::class, $params);
        $filter->verify();

        $repository = $this->objectManager->getRepository(Uf::class);
        $estados = $repository->findBy($filter->getFilters());

        return $this->processResult($estados);
    }

    /**
     * @param mixed $result
     * @return mixed
     */
    private function processResult($result)
    {
        $data = new DataCollection($result);
        return $data->getResult();
    }
} 
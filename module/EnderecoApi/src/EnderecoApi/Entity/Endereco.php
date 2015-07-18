<?php
namespace EnderecoApi\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Endereco
 *
 * @ORM\Table(name="endereco")
 * @ORM\Entity()
 */
class Endereco
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="cep", type="string", length=9, nullable=false)
     */
    private $cep;

    /**
     * @var string
     *
     * @ORM\Column(name="logradouro", type="string", length=40, nullable=false)
     */
    private $logradouro;

    /**
     * @var string
     *
     * @ORM\Column(name="endereco", type="string", length=230, nullable=false)
     */
    private $endereco;

    /**
     * @var string
     *
     * @ORM\Column(name="endereco_completo", type="string", length=250, nullable=false)
     */
    private $enderecoCompleto;

    /**
     * @var Bairro
     *
     * @ORM\ManyToOne(targetEntity="Bairro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bairro_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $bairro;

    /**
     * @var Cidade
     *
     * @ORM\ManyToOne(targetEntity="Cidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cidade_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $cidade;

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cep
     *
     * @param string $cep
     * @return Endereco
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get cep
     *
     * @return string 
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set Bairro
     *
     * @param Bairro $bairro
     * @return Endereco
     */
    public function setBairro($bairro = null)
    {
        $this->bairro = $bairro;
        return $this;
    }

    /**
     * Get Bairro
     *
     * @return Bairro
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set Cidade
     *
     * @param Cidade $cidade
     * @return Cidade
     */
    public function setCidade(Cidade $cidade = null)
    {
        $this->cidade = $cidade;
        return $this;
    }

    /**
     * Get Cidade
     *
     * @return Cidade
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set logradouro
     *
     * @param string $logradouro
     * @return Endereco
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    /**
     * Get logradouro
     *
     * @return string 
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * Set endereco
     *
     * @param string $endereco
     * @return Endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get endereco
     *
     * @return string 
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set enderecoCompleto
     *
     * @param string $enderecoCompleto
     * @return Endereco
     */
    public function setEnderecoCompleto($enderecoCompleto)
    {
        $this->enderecoCompleto = $enderecoCompleto;

        return $this;
    }

    /**
     * Get enderecoCompleto
     *
     * @return string 
     */
    public function getEnderecoCompleto()
    {
        return $this->enderecoCompleto;
    }
}

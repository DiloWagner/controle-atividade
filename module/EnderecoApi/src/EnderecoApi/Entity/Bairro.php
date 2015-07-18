<?php
namespace EnderecoApi\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bairro
 *
 * @ORM\Table(name="bairro", indexes={@ORM\Index(name="fk_bairro_cidade", columns={"cidade_id"})})
 * @ORM\Entity()
 */
class Bairro
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
     * @var Cidade
     *
     * @ORM\ManyToOne(targetEntity="Cidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cidade_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $cidade;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100, nullable=false)
     */
    private $nome;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cidade
     *
     * @param integer $cidade
     * @return Bairro
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get cidadeId
     *
     * @return integer 
     */
    public function getCidade()
    {
        return $this->cidadeId;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Bairro
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }
}

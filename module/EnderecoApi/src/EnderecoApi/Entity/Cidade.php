<?php
namespace EnderecoApi\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cidade
 *
 * @ORM\Table(name="cidade", indexes={@ORM\Index(name="fk_cidade_uf", columns={"uf_id"})})
 * @ORM\Entity()
 */
class Cidade
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
     * @ORM\Column(name="nome", type="string", length=70, nullable=false)
     */
    private $nome;

    /**
     * @var Uf
     *
     * @ORM\ManyToOne(targetEntity="Uf")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="uf_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $uf;


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
     * Set nome
     *
     * @param string $nome
     * @return Cidade
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

    /**
     * Set uf
     *
     * @param Uf $uf
     * @return Cidade
     */
    public function setUf(Uf $uf = null)
    {
        $this->uf = $uf;

        return $this;
    }

    /**
     * Get uf
     *
     * @return Uf
     */
    public function getUf()
    {
        return $this->uf;
    }
}

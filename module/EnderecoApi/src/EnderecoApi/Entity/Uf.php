<?php
namespace EnderecoApi\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Uf
 *
 * @ORM\Table(name="uf")
 * @ORM\Entity()
 */
class Uf
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
     * @ORM\Column(name="nome", type="string", length=19, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="uf", type="string", length=2, nullable=false, options={"fixed"=true})
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
     * @return Uf
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
     * @param string $uf
     * @return Uf
     */
    public function setUf($uf)
    {
        $this->uf = $uf;

        return $this;
    }

    /**
     * Get uf
     *
     * @return string 
     */
    public function getUf()
    {
        return $this->uf;
    }
}

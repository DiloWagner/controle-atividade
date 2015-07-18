<?php
namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entidade Atividade
 *
 * @ORM\Table(name="atividade")
 * @ORM\Entity(repositoryClass="Api\Repository\AtividadeRepository")
 */
class Atividade
{
    const ENTITY = 'Api\Entity\Atividade';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=45, nullable=false)
     */
    protected $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text", nullable=false)
     */
    protected $descricao;

    /**
     * @var integer
     *
     * @ORM\Column(name="indice", type="integer", nullable=false)
     */
    protected $indice;

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
     * Set titulo
     *
     * @param string $titulo
     * @return Atividade
     */
    public function setTitulo( $titulo )
    {
        $this->titulo = $titulo;
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     * @return Atividade
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @return int $indice
     */
    public function getIndice()
    {
        return $this->indice;
    }

    /**
     * @param $indice
     * @return $this
     */
    public function setIndice($indice)
    {
        $this->indice = $indice;
        return $this;
    }

    /**
     * Override
     * (non-PHPdoc)
     * @see \Base\Entity\AbstractEntity::toArray()
     */
    public function getArrayCopy() {

        return array(
            'id'        => $this->getId(),
            'titulo'    => $this->getTitulo(),
            'descricao' => $this->getDescricao(),
            'indice'    => $this->getIndice()
        );
    }

    public function exchangeArray($data)
    {
        $this->id     = (!empty($data['id']))           ? $data['id'] : null;
        $this->titulo = (!empty($data['titulo']))       ? $data['titulo'] : null;
        $this->descricao  = (!empty($data['descricao']))? $data['descricao'] : null;
        $this->indice  = (!empty($data['indice']))      ? $data['indice'] : null;
    }
}
<?php
/**
 * Class Filter
 */
namespace Api\Processor;

use Api\Exception\ParamNotFoundException;

/**
 * Responsável por validar se os parâmetros passados na URL realmente estão contidas na entidade
 *
 * Class Filter
 * @package EnderecoApi\Processor
 */
class Filter
{
    /**
     * @var mixed
     */
    private $entity;

    /**
     * @var array
     */
    private $params;

    public function __construct($class, $params)
    {
        $this->entity = new $class;
        $this->params = $params;
    }

    /**
     * Verifica se os parâmetros realmente existem na entidade
     * @throws ParamNotFoundException
     */
    public function verify()
    {
        foreach($this->params as $key => $value) {
            if(!property_exists($this->entity, $key)) {
                throw new ParamNotFoundException;
            }
        }
    }

    /**
     * Retorna os filtros para consulta.
     * @return array
     */
    public function getFilters()
    {
        return $this->params;
    }
} 
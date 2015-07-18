<?php
/**
 * Class Filter
 *
 * @author Diego Wagner <desenvolvimento@discoverytecnologia.com.br>
 * http://www.discoverytecnologia.com.br
 */
namespace EnderecoApi\Processor;

use EnderecoApi\Exception\ParamNotFoundException;

/**
 * Responsável por validar se os parâmetros passados na URL realmente estão contidas na entidade
 *
 * Class Filter
 * @package EnderecoApi\Processor
 *
 * @author DiegoWagner <diegowagner4@gmail.com>
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
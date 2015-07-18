<?php
/**
 * Class DataCollection
 *
 * @author Diego Wagner <desenvolvimento@discoverytecnologia.com.br>
 * http://www.discoverytecnologia.com.br
 */
namespace EnderecoApi\Collection;

class DataCollection
{
    /**
     * @var mixed
     */
    private $elementOrElements;

    /**
     * @var bool
     */
    private $isCollection;

    /**
     * @param mixed $elementOrElements
     */
    public function __construct($elementOrElements)
    {
        $this->isCollection = false;
        if(is_array($elementOrElements)) {
            $this->isCollection = true;
        }
        $this->elementOrElements = $elementOrElements;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        if(!$this->isCollection) {
            return $this->elementOrElements;
        }
        return ['results' => $this->elementOrElements];
    }
} 
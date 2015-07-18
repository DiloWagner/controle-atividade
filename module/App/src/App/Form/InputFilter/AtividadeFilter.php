<?php
namespace App\Form\InputFilter;

use Zend\InputFilter\InputFilter;

class AtividadeFilter extends InputFilter
{
    public function init()
    {
        $this->add(array(
            'name' => 'titulo',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'max'      => 150
                    ),
                ),
                array(
                    'name' => 'NotEmpty'
                )
            )
        ));

        $this->add(array(
            'name' => 'descricao',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty'
                )
            )
        ));
    }
}
<?php
namespace App\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\InputFilter\InputFilterProviderInterface;

class AtividadeFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function init()
    {
        $id = new Hidden('id');
        $this->add ( $id );

        $titulo = new Text( 'titulo' );
        $titulo->setLabel ( 'Título: ' )->setLabelAttributes ( array (
            'class' => 'control-label required'
        ) )->setAttributes ( array (
                'class' => 'tool_tip',
                'data-placement' => 'bottom',
                'placeholder' => 'Título da notícia',
                'title' => 'Título da notícia',
                'id' => 'titulo-noticia',
                'maxlength' => '150'
            ) );
        $this->add ( $titulo );

        $descricao = new Textarea( 'descricao' );
        $descricao->setLabel ( 'Descrição:' )->setLabelAttributes ( array (
            'class' => 'control-label required'
        ) )->setAttributes ( array (
                'placeholder' => 'Descrição',
                'class' => 'jmce tool_tip'
            ) );
        $this->add ( $descricao );
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return array('type' => 'App\Form\InputFilter\AtividadeFilter');
    }
}

<?php
/**
 * Class Json
 *
 * @author Diego Wagner <desenvolvimento@discoverytecnologia.com.br>
 * http://www.discoverytecnologia.com.br
 */
namespace EnderecoApi\Processor;

use JMS\Serializer\SerializerBuilder;

class Xml extends AbstractPostProcessor
{
    const TYPE_XML = 'xml';

    public function process()
    {
        $serializer = SerializerBuilder::create()->build();
        $content = null;
        if (!$content) {
            try {
                $content = $serializer->serialize($this->vars, static::TYPE_XML);
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
        $this->response->setContent($content);
        $headers = $this->response->getHeaders();
        $headers->addHeaderLine('Content-Type', 'application/xml');
        $this->response->setHeaders($headers);
    }
} 
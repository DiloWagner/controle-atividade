<?php
/**
 * Class Json
 */
namespace Api\Processor;

use JMS\Serializer\SerializerBuilder;

class Json extends AbstractPostProcessor
{
    const TYPE_JSON = 'json';

    public function process()
    {
        $serializer = SerializerBuilder::create()->build();
        $content = null;
        if (!$content) {
            try {
                $content = $serializer->serialize($this->vars, static::TYPE_JSON);
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
        $this->response->setContent($content);
        $headers = $this->response->getHeaders();
        $headers->addHeaderLine('Content-Type', 'application/json');
        $this->response->setHeaders($headers);
    }
} 
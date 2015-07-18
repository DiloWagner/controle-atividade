<?php
return array(
    'api' => array(
        'authorization' => true,
        'formatters' => array(
            'default' => 'json',
            'types' => array(
                'json',
                'xml'
            )
        ),
    ),
    'di' => array(
        'instance' => array(
            'alias' => array(
                'json' => 'Api\Processor\Json',
                'xml'  => 'Api\Processor\Xml'
            )
        )
    ),
    'router' => array(
        'routes' => array(
            'api-endereco' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route' => '/api/v1',
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'cidade' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/atividade[.:formatter][/:id]',
                            'constraints' => array(
                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'formatter' => '[a-zA-Z]+',
                                'id'        => '[a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(
                                'controller' => 'api.atividade.rest.controller'
                            )
                        )
                    )
                )
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'api.atividade.rest.controller'      => 'Api\Controller\Factory\AtividadeApiRestControllerFactory'
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'api.service' => 'Api\Service\Factory\ApiServiceFactory',
        )
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy'
        )
    ),
    'doctrine' => array(
        'driver' => array(
            'servidor.driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Api/Entity'
                )
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Api\Entity' => 'servidor.driver'
                )
            )
        )
    ),
);

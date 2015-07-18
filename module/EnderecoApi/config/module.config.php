<?php
return [
    'api' => [
        'authorization' => true,
        'formatters' => [
            'default' => 'json',
            'types' => [
                'json',
                'xml'
            ]
        ],
        'domains' => [
            'http://dev.enderecoapi.com.br',
            'http://dev.odisseiaesportes.com.br'
        ]
    ],
    'di' => [
        'instance' => [
            'alias' => [
                'json' => 'EnderecoApi\Processor\Json',
                'xml'  => 'EnderecoApi\Processor\Xml'
            ]
        ]
    ],
    'router' => [
        'routes' => [
            'api-endereco' => [
                'type'    => 'Literal',
                'options' => [
                    'route' => '/api/address/v1',
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'cep' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/cep[.:formatter][/:id]',
                            'constraints' => [
                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'formatter' => '[a-zA-Z]+',
                                'id'        => '[a-zA-Z0-9_-]*'
                            ],
                            'defaults' => [
                                'controller' => 'api.endereco.controller.cep'
                            ]
                        ]
                    ],
                    'endereco' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/endereco[.:formatter][/:id]',
                            'constraints' => [
                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'formatter' => '[a-zA-Z]+',
                                'id'        => '[a-zA-Z0-9_-]*'
                            ],
                            'defaults' => [
                                'controller' => 'api.endereco.controller.endereco'
                            ]
                        ]
                    ],
                    'bairro' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/bairro[.:formatter][/:id]',
                            'constraints' => [
                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'formatter' => '[a-zA-Z]+',
                                'id'        => '[a-zA-Z0-9_-]*'
                            ],
                            'defaults' => [
                                'controller' => 'api.endereco.controller.bairro'
                            ]
                        ]
                    ],
                    'cidade' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/cidade[.:formatter][/:id]',
                            'constraints' => [
                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'formatter' => '[a-zA-Z]+',
                                'id'        => '[a-zA-Z0-9_-]*'
                            ],
                            'defaults' => [
                                'controller' => 'api.endereco.controller.cidade'
                            ]
                        ]
                    ],
                    'estado' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/estado[.:formatter][/:id]',
                            'constraints' => [
                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'formatter' => '[a-zA-Z]+',
                                'id'        => '[a-zA-Z0-9_-]*'
                            ],
                            'defaults' => [
                                'controller' => 'api.endereco.controller.estado'
                            ]
                        ]
                    ],
                ]
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            'api.endereco.controller.cep'      => 'EnderecoApi\Controller\Factory\BuscaCepControllerFactory',
            'api.endereco.controller.endereco' => 'EnderecoApi\Controller\Factory\BuscaEnderecoControllerFactory',
            'api.endereco.controller.bairro'   => 'EnderecoApi\Controller\Factory\BuscaBairroControllerFactory',
            'api.endereco.controller.cidade'   => 'EnderecoApi\Controller\Factory\BuscaCidadeControllerFactory',
            'api.endereco.controller.estado'   => 'EnderecoApi\Controller\Factory\BuscaEstadoControllerFactory'
        ]
    ],
    'service_manager' => [
        'factories' => [
            'api.endereco.service' => 'EnderecoApi\Service\Factory\EnderecoApiServiceFactory',
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'api.404',
        'exception_template'       => 'api.error',
        'template_map' => [
            'api.layout' => __DIR__ . '/../view/layout/layout.phtml',
            'api.error'  => __DIR__ . '/../view/error/index.phtml',
            'api.404'    => __DIR__ . '/../view/error/404.phtml',
        ],
        'template_path_stack' => [
            'EnderecoApi' => __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy'
        ]
    ],
    'doctrine' => [
        'driver' => [
            'servidor.driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/EnderecoApi/Entity'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'EnderecoApi\Entity' => 'servidor.driver'
                ]
            ]
        ]
    ],
];

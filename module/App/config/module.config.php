<?php
namespace Aplicacao;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'App\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'atividade' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/atividade',
                    'defaults' => array(
                        '__NAMESPACE__' => 'App\Controller',
                        'controller'    => 'Atividade',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/:action[/:id]]',
                            'constraints' => array (
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'defaults' => array (
                                    'controller' => 'Atividade'
                                )
                            )
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'App\Controller\Index'     => 'App\Controller\IndexController',
            'App\Controller\Atividade' => 'App\Controller\AtividadeController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'app/atividade/index' => __DIR__ . '/../view/app/atividade/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
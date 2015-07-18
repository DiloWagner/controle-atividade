<?php
namespace Base;

use Base\Router\Factory\RouterServiceFactory;
use Base\Router\RouterService;
use Base\View\Helper\Factory\AlertMessageFactory;

return array(
    'view_helpers' => array(
        'factories' => array(
            'alertMessage'   => AlertMessageFactory::class
        )
    ),
    /** VIEW MANAGERS **/
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'exception_template'       => 'base/error/index',
        'template_map' => array(
            'layout/base'      => __DIR__ . '/../view/layout/base.phtml',
            'base/error/index' => __DIR__ . '/../view/error/index.phtml',
            'base/partial/upload' => __DIR__ . '/../view/partial/file-upload.phtml'
        ),
        'template_path_stack' => array(
            'base' => __DIR__ . '/../view',
        )
    ),
    /** SERVICE MANAGER */
    'service_manager' => array(
        'factories' => array(
            RouterService::class => RouterServiceFactory::class
        )
    )
);

<?php
namespace Base;

return array(
    'view_helpers' => array(
        'factories' => array(
            'alertMessage'   => 'Base\View\Helper\Factory\AlertMessageFactory'
        )
    ),
    /** SERVICE MANAGER */
    'service_manager' => array(
        'factories' => array(
            'Base\Router\RouterService' => 'Base\Router\Factory\RouterServiceFactory'
        )
    )
);

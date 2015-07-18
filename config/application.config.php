<?php
return [
    'modules' => [
        'EnderecoApi',
        'DoctrineModule',
        'DoctrineORMModule',
        'JMSSerializerModule',
        'ZendDeveloperTools'
    ],
    'module_listener_options' => [
        'config_glob_paths' => [
            'config/autoload/{,*.}{global,local}.php'
        ],
        'module_paths' => [
            './module',
            './vendor',
        ],
        'config_cache_enabled'     => false,
        'module_map_cache_enabled' => false,
        'cache_dir'                => 'data/cache'
    ],
];
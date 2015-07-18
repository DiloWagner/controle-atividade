<?php
return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params'      => array(
                    'host'          => 'localhost',
                    'port'          => '3306',
                    'user'          => 'root',
                    'password'      => '',
                    'dbname'        => 'api_endereco',
                    'driverOptions' => array(
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
                    )
                )
            )
        ),
        'configuration' => array(
            'orm_default' => array(
                'proxy_dir' => 'data/DoctrineORMModule/Proxy',
                'proxy_namespace' => 'DoctrineORMModule\Proxy'
                #'metadata_cache' => 'apc',
                #'query_cache' => 'apc',
                #'result_cache' => 'apc',
                #'generate_proxies' => true,
                #'hydration_cache' => 'apc'
            )
        )
    )
);
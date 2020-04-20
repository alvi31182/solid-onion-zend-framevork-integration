<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    'service_manager' => [
        'factories' => [
            'CustomerTable' => function($sm){
                $factory  = new \App\Persitence\Zend\TableGetaway\TableGatewayFactory();
                $hydrator = new \Zend\Hydrator\ClassMethods();

                return new \App\Persitence\Zend\DataTable\CustomerTable(

                );
            }
        ],
    ]
];
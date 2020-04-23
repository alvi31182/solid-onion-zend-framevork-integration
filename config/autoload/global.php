<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use App\Domain\Entity\Customer;
use App\Domain\Entity\Invoice;
use App\Domain\Entity\Order;
use App\Persitence\Zend\DataTable\CustomerTable;
use App\Persitence\Zend\TableGetaway\TableGatewayFactory;
use Laminas\Hydrator\ClassMethods;

return [
    'service_manager' => [
        'factories' => [
            'Laminas\Db\Adapter\Adapter' => 'Laminas\Db\Adapter\AdapterServiceFactory',

            'CustomerTable' => function($sm) {
                $factory = new TableGatewayFactory();
                $hydrator = new ClassMethods();
                return new CustomerTable(
                    $factory->createGateway(
                        $sm->get('Laminas\Db\Adapter\Adapter'),
                        $hydrator,
                        new Customer(),
                        'customers'
                    ),
                    $hydrator
                );
            },
            'InvoiceTable' => function($sm){
                $factory = new TableGatewayFactory();
                $hydrator = new ClassMethods();
                return new CustomerTable(
                    $factory->createGateway(
                        $sm->get('Laminas\Db\Adapter\Adapter'),
                        $hydrator,
                        new Invoice(),
                        'invoices'
                    ),
                    $hydrator
                );
            },
            'OrderTable' => function($sm){
                $factory = new TableGatewayFactory();
                $hydrator = new ClassMethods();
                return new CustomerTable(
                    $factory->createGateway(
                        $sm->get('Laminas\Db\Adapter\Adapter'),
                        $hydrator,
                        new Order(),
                        'orders'
                    ),
                    $hydrator
                );
            }
        ],
    ],

];

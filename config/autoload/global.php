<?php

use App\Domain\Entity\Customer;
use App\Domain\Entity\Invoice;
use App\Domain\Entity\Order;
use App\Persitence\Zend\DataTable\CustomerTable;
use App\Persitence\Zend\DataTable\OrderTable;
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
                return new OrderTable(
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

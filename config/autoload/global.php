<?php

use App\Domain\Entity\Customer;
use App\Domain\Entity\Invoice;
use App\Domain\Entity\Order;
use App\Persitence\Hydrator\InvoiceHydrator;
use App\Persitence\Hydrator\OrderHydrator;
use App\Persitence\Zend\DataTable\CustomerTable;
use App\Persitence\Zend\DataTable\InvoiceTable;
use App\Persitence\Zend\DataTable\OrderTable;
use App\Persitence\Zend\TableGetaway\TableGatewayFactory;
use Laminas\Hydrator\ClassMethodsHydrator;

return [
    'service_manager' => [
        'factories' => [
            'Laminas\Db\Adapter\Adapter' => 'Laminas\Db\Adapter\AdapterServiceFactory',

            'CustomerTable' => function ($sm) {
                $factory = new TableGatewayFactory();
                $hydrator = new ClassMethodsHydrator();
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

            'InvoiceHydrator' => function ($sm) {
                return new InvoiceHydrator(
                    new ClassMethodsHydrator(),
                    $sm->get('OrderTable')
                );
            },

            'InvoiceTable' => function ($sm) {
                $factory = new TableGatewayFactory();
                $hydrator = $sm->get('InvoiceHydrator');

                return new InvoiceTable(
                    $factory->createGateway(
                        $sm->get('Laminas\Db\Adapter\Adapter'),
                        $hydrator,
                        new Invoice(),
                        'invoices'
                    ),
                    $hydrator
                );
            },
            'OrderHydrator' => function ($sm) {
                return new OrderHydrator(
                    new ClassMethodsHydrator(),
                    $sm->get('CustomerTable')
                );
            },

            'OrderTable' => function ($sm) {
                $factory = new TableGatewayFactory();
                $hydrator = $sm->get('OrderHydrator');

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

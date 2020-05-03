<?php

namespace Application;

use App\Domain\Service\InputFilter\CustomerInputFilter;
use App\Domain\Service\InputFilter\OrderInputFilter;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [

            Controller\IndexController::class => InvokableFactory::class,

            Controller\CustomersController::class => function ($sm) {
                return new Controller\CustomersController(
                    $sm->get('CustomerTable'),
                    new CustomerInputFilter(),
                    new ClassMethodsHydrator()
                );
            },

            Controller\OrdersController::class => function ($sm) {
                return new Controller\OrdersController(
                    $sm->get('OrderTable'),
                    $sm->get('CustomerTable'),
                    new OrderInputFilter(),
                    $sm->get('OrderHydrator')
                );
            },

            Controller\InvoicesController::class => function ($sm) {
                return new Controller\InvoicesController(
                    $sm->get('InvoiceTable'),
                    $sm->get('OrderTable')
                );
            }
        ],
    ],
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'customers' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/customers',
                    'defaults' => [
                        'controller' => Controller\CustomersController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'new' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/new',
                            'constraints' => [
                                'id' => '[0-9]+',
                            ],
                            'defaults' => [
                                'action' => 'new-or-edit',
                            ],
                        ]
                    ],
                    'edit' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/edit/:id',
                            'constraints' => [
                                'id' => '[0-9]+',
                            ],
                            'defaults' => [
                                'action' => 'new-or-edit',
                            ],
                        ]
                    ],
                ],
            ],
            'orders' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/orders[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\OrdersController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'invoices' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/invoices[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\InvoicesController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'application' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_helpers' => [
        'invokables' => [
            'validationErrors' => 'Application\View\Helper\ValidationErrors',
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];

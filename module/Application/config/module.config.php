<?php


declare(strict_types=1);

namespace Application;

use App\Domain\Service\InputFilter\CustomerInputFilter;
use Application\Controller\CustomersController;
use Application\Controller\OrdersController;
use Laminas\Hydrator\ClassMethods;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'customers' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/customers',
                    'defaults' => [
                        'controller' => 'Application\Controller\Customers',
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
                    'route' => '/orders',
                    'defaults' => [
                        'controller' => 'Application\Controller\Orders',
                        'action' => 'index',
                    ],
                ],
            ],
            'invoices' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/invoices',
                    'defaults' => [
                        'controller' => 'Application\Controller\Invoices',
                        'action' => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            'Application\Controller\Index' => 'Application\Controller\IndexController'
        ],
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            'Application\Controller\Customers' => function($sm){
                return new CustomersController(
                    $sm->getServiceLocator()->get('CustomerTable'),
                    new CustomerInputFilter(),
                    new ClassMethods()
                );
            },
            'Application\Controller\Orders' => function($sm){
                return new OrdersController(
                    $sm->getServiceLocator()->get('OrderTable')
                );
            }
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'validationErrors' => 'Application\View\Helper\ValidationErrors',
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];

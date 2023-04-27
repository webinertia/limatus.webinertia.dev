<?php

declare(strict_types=1);

namespace Application;

use Laminas\Mvc\Controller\LazyControllerAbstractFactory as ControllerFactory;
use Laminas\Permissions\Acl\AclInterface;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\View\Helper\Navigation;

return [
    'listeners' => [
        Listener\DevelopmentMode::class,
    ],
    'router'    => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'home',
                    ],
                ],
            ],
            'example' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            //AclInterface::class             => Acl\Factory::class,
            Listener\DevelopmentMode::class => Factory\InvokableFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => ControllerFactory::class,
        ],
    ],
    'form_elements' => [
        'factories' => [
            Form\Grid::class                         => Form\GridFactory::class,
            Form\Fieldset\Grid::class                => Form\Fieldset\GridFactory::class,
            Form\Horizontal::class                   => Form\HorizontalFactory::class,
            Form\Fieldset\HorizontalFieldset::class  => Form\Fieldset\HorizontalFieldsetFactory::class,
            Form\Inline::class                       => InvokableFactory::class,
        ],
    ],
    'navigation_helpers' => [
        // 'delegators' => [
        //     Navigation::class => [
        //         PermissionAclDelegatorFactory::class,
        //         RoleFromAuthenticationIdentityDelegator::class,
        //     ],
        // ],
    ],
    'navigation' => [
        'default' => [
            [
                'label'  => 'Home',
                'route'  => 'home',
                'class'  => 'nav-link',
                'order'  => 1,
                'action' => 'home',
                'liClass' => 'testClass',
            ],
            [
                'label'  => 'Inline',
                'route'  => 'example',
                'class'  => 'nav-link',
                'order'  => 2,
                'action' => 'inline',
                'privilege' => 'view',
                'resource' => 'app',
            ],
            [
                'label'  => 'Grid',
                'route'  => 'example',
                'class'  => 'nav-link',
                'order'  => 3,
                'action' => 'grid',
                'privilege' => 'view',
                'resource' => 'app',
            ],
            [
                'label'  => 'Horizontal',
                'route'  => 'example',
                'class'  => 'nav-link',
                'order'  => 4,
                'action' => 'horizontal',
            ],
            [
                'label'  => 'Laminas',
                'route'  => 'example',
                'class'  => 'nav-link',
                'order'  => 5,
                'action' => 'laminas',
            ],
        ],
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
        'template_path_stack'      => [
            __DIR__ . '/../view',
        ],
        'strategies'               => [
            'ViewJsonStrategy',
        ],
    ],
];

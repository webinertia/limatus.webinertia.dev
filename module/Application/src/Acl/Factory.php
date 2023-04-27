<?php

declare(strict_types=1);

namespace Application\Acl;

use Laminas\Permissions\Acl\Acl;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class Factory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): Acl
    {
        $acl = new Acl();
        $acl->addRole('guest');
        $acl->addResource('app');
        $acl->allow('guest', 'app', ['view']);
        return $acl;
    }
}

<?php

declare(strict_types=1);

namespace Application\Form\Fieldset;

use Application\Form\Fieldset\Grid;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class GridFactory implements FactoryInterface
{
    /** @inheritDoc */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): Grid
    {
        return new $requestedName(options: $options);
    }
}

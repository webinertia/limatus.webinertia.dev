<?php

declare(strict_types=1);

namespace Application\Listener;

use Laminas\EventManager\AbstractListenerAggregate;
use Laminas\EventManager\EventManagerInterface;
use Laminas\Mvc\MvcEvent;

use function file_exists;

class DevelopmentMode extends AbstractListenerAggregate
{
    private const CONFIG_PATH = __DIR__ . '/../../../../config/';

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_ROUTE, [$this, 'setState']);
    }

    public function setState(MvcEvent $event): void
    {
        $isDev = false;

        if (file_exists(self::CONFIG_PATH . 'development.config.php')) {
            $isDev = true;
        }
        $event->getViewModel()->setVariable('devMode', $isDev);
    }
}

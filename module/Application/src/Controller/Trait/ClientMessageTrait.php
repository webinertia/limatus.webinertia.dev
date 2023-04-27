<?php

declare(strict_types=1);

namespace Application\Controller\Trait;

trait ClientMessageTrait
{
    protected function sendMessage(string $type, string $message): void
    {
        $this->headers = $this->response->getHeaders();
        $this->headers->addHeaderLine($type, $message);
    }
}

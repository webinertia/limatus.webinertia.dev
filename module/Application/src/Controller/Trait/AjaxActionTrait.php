<?php

declare(strict_types=1);

namespace Application\Controller\Trait;

use Laminas\View\Model\ViewModel;

trait AjaxActionTrait
{
    protected function ajaxAction(): bool
    {
        if ($this->request->isXmlHttpRequest()) {
            if (isset($this->view) && $this->view instanceof ViewModel) {
                $this->view->setTerminal(true);
            }
            return true;
        } else {
            return false;
        }
    }
}

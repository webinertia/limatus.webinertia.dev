<?php

declare(strict_types=1);

namespace Application\Controller\Trait;

use Laminas\Form\FormInterface;
use Laminas\Mvc\Exception;
use Laminas\View\Model\ModelInterface;
use Laminas\View\Model\ViewModel;

trait ActionHandlerTrait
{
    use AjaxActionTrait;
    use ClientMessageTrait;

    protected static string $exceptionMessage = 'exceptionMessage';
    protected static string $successMessage   = 'successMessage';

    protected function actionHandler(FormInterface|string $form): ModelInterface
    {
        $action = $this->params('action');
        $form   = $form instanceof FormInterface ? $form : $this->formManager->get($form);
        $view = new ViewModel(['form' => $form]);
        try {
            if ($action !== $form->getAttribute('name')) {
                throw new Exception\DomainException('Domain Exception encountered. Site may not function as expected. Please try back later :)');
            }
        } catch (Exception\DomainException $ex) {
           $this->sendMessage(
            static::$exceptionMessage, $ex->getMessage());
        }
        $form->setAttribute(
            'action',
            $this->url()->fromRoute('example', ['action' => $action])
        );

        if ($this->ajaxAction()) {
            $view->setTerminal(true);
        }
        $data = $this->request->getPost()->toArray();
        if ($this->request->isPost()) {
            $form->setData($this->request->getPost()->toArray());
            if ($form->isValid()) {
                $values = $form->getData();
            }
        }
        return $view;
    }
}

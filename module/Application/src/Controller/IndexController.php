<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Controller\Trait;
use Application\Form;
use Laminas\Form\FormElementManager;
use Laminas\Http\Request;
use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\MvcEvent;
use Laminas\View\Model\ModelInterface;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    use Trait\ActionHandlerTrait;

    // protected FormElementManager $formManager;
    /** @var Request $request */
    protected $request;
    /** @var Response $response */
    protected string $action;
    protected $headers;
    protected string $systemMessage = '';

    public function __construct(
       protected FormElementManager $formManager
    ) {
        //$this->formManager = $formManager;
    }

    public function onDispatch(MvcEvent $e)
    {
        // $filter = ['__construct', 'ajaxAction'];
        // $methods = array_diff(get_class_methods($this), get_class_methods(get_parent_class($this)));
        // $linkAble = array_diff($methods, $filter);
        //
        // Set an action variable on the layout model for the active tab
        ($this->layout())->setVariables([
            'action'     => $this->params('action'),
            'headerForm' => $this->formManager->get(Form\Inline::class),
        ]);
        parent::onDispatch($e);
    }

    public function homeAction(): ModelInterface
    {
        $view = new ViewModel();
        if ($this->ajaxAction()) {
            $view->setTerminal(true);
        }
        return $view;
    }

    public function gridAction(): ModelInterface
    {
        return $this->actionHandler(Form\Grid::class);
    }

    public function horizontalAction(): ModelInterface
    {
        return $this->actionHandler(Form\Horizontal::class);
    }

    public function inlineAction(): ModelInterface
    {
        return $this->actionHandler(Form\Inline::class);
    }

    public function laminasAction(): ModelInterface
    {
        return $this->actionHandler(new Form\Laminas());
    }
}

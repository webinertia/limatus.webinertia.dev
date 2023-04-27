<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form;
use Laminas\InputFilter\InputFilterAwareInterface;

class Laminas extends Form\Form implements InputFilterAwareInterface
{
    public function __construct($name = 'laminas', $options = ['fieldset' => false])
    {
        parent::__construct($name, $options);

        $this->add([
            'name' => 'email',
            'type' => Form\Element\Text::class,
            'options' => [
                'label' => 'Email',
            ],
        ]);
        ////////////////
        $this->add([
            'name' => 'save',
            'type' => Form\Element\Submit::class,
            'attributes' => [
                'value' => 'Save',
            ],
        ]);
    }
}

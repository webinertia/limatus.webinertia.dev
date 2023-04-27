<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Filter;
use Laminas\Form\Element\Button;
use Laminas\Form\Element\Submit;
use Laminas\Validator;
use Limatus\Form;
use Limatus\Form\Element;

class Inline extends Form\Form implements InputFilterProviderInterface
{
    protected $attributes = ['method' => 'POST', 'class'  => 'row row-cols-lg-auto g-3 align-items-center'];

    public function __construct($name = null, $options = [])
    {
        parent::__construct(
            $name = 'inline',
            [
                'mode'   => self::INLINE_MODE,

            ]
        );
    }

    public function init(): void
    {

        $this->add([
            'name' => 'username',
            'type' => Element\Text::class,
            'attributes' => [
                'class'            => 'form-control password',
                'placeholder'      => 'Username',
                'aria-describedby' => 'usernameHelp',
            ],
            'options' => [
                'input_group'          => true, // input group flag for wrapping the input
                'input_group_text'     => '@',  // text to be inserted into the input-group div
                'bootstrap_attributes' => [
                    'class' => 'col-12',
                ],
                'label_attributes'     => [
                    'class' => 'visually-hidden',
                ],
            ],
        ]);
        $this->add([
            'name'    => 'remember_me',
            'type'    => Element\Checkbox::class,
            'attributes' => [
                //'value' => '1',
                'class' => 'form-check-input',
            ],
            'options' => [
                'label' => 'Remember Me',
                'use_hidden_element' => false,
                'checked_value' => '1',
                'unchecked_value' => '0',
                'bootstrap_attributes' => [
                    'class' => 'col-12', // used in the outer most wrapper div for checkbox
                ],
                'label_attributes' => [
                    'class' => 'form-check-label',
                ],
                'label_options' => [
                    'label_position' => 'APPEND',
                ],
            ],
        ]);
        // todo: #9 buttons are not currently wrapped, but should be
        $this->add([
            'name' => 'save',
            'type' => Submit::class,
            'attributes' => [
                'class' => 'btn btn-sm btn-secondary',
                'value' => 'Login',
                //'disabled' => true,
            ],
            'bootstrap_attributes' => [
                'class' => 'col-12',
            ],
            //'options' => ['label' => 'Sign In'],
        ]);
    }

    public function getInputFilterSpecification(): array
    {
        return [
            'username'    => [
                'required' => true,
                'filters'  => [
                    ['name' => Filter\StripTags::class],
                    ['name' => Filter\StringTrim::class],
                ],
                'validators' => [
                    [
                        'name'    => Validator\StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ],
                    ],
                ],
            ],
        ];
    }
}

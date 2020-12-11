<?php


namespace App\Views\Forms\Admin;


use Core\Views\Form;

class DiscountForm extends Form
{
    public function __construct($pizza_id = null)
    {
        parent::__construct([
            'attr' => [
                'method' => 'POST'
            ],
            'fields' => [
                'pizza_id' => [
                    'type' => 'select',
                    'options' => $pizza_id,
                    'validators' => [
                        'validate_select'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Pizza name'
                        ]
                    ]
                ],
                'price' => [
                    'label' => 'Price',
                    'type' => 'number',
                    'value' => '',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_is_numeric'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'New Price',
                            'class' => 'input-field'
                        ]
                    ]
                ]
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Submit',
                    'type' => 'submit',
                    'extra' => [
                        'attr' => [
                            'class' => 'btn'
                        ]
                    ]
                ]
            ]
        ]);
    }
}
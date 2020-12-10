<?php


namespace App\Views\Forms\Admin;


use Core\Views\Form;

class OrderForm extends Form
{
    public function __construct($value = null)
    {
        parent::__construct([
            'attr' => [
                'method' => 'POST'
            ],
            'fields' => [
                'id' => [
                    'type' => 'hidden',
                    'value' => 'ORDER'
                ],
                'name' => [
                    'type' => 'hidden',
                    'value' => $value
                ],
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Order',
                    'type' => 'submit',
                    'extra' => [
                        'attr' => [
                            'class' => 'btn'
                        ]
                    ]
                ],
            ]
        ]);
    }
}
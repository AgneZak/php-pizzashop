<?php


namespace App\Views\Forms;


use Core\Views\Form;

class RedirectForm extends Form
{
    public function __construct($redirect = '/', $button_value = null, $fields_value = null)
    {
        parent::__construct([
            'attr' => [
                'action' => $redirect
            ],
            'fields'=> $fields_value,
            'buttons' => [
                'submit' => [
                    'title' => $button_value,
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
<?php

namespace App\Views\Content;

use App\App;
use App\Views\Forms\Admin\DeleteForm;
use App\Views\Forms\Admin\OrderForm;
use App\Views\Forms\RedirectForm;
use Core\Views\Form;

class HomeContent
{
    protected DeleteForm $form;
    protected OrderForm $order;
    protected RedirectForm $redirectForm;

    public function __construct()
    {
        $this->form = new DeleteForm();
        $this->order = new OrderForm();
        $this->redirectForm = new RedirectForm();
    }

    public function content()
    {
        if (Form::action()) {
            if ($this->form->validate()) {
                $clean_inputs = $this->form->values();

                App::$db->deleteRow('pizzas', $clean_inputs['id']);
            }

            if ($this->order->validate()) {
                $clean_inputs = $this->order->values();
                //TODO: Post a message, when order is made
            }
            if ($this->redirectForm->validate()) {

            }
        }


        if (isset($_POST['id'])) {

            if ($_POST['id'] === 'ORDER') {
                $rows = App::$db->getRowsWhere('orders');
                $pizza_id = 1;

                foreach ($rows as $id => $row) {
                    $pizza_id++;
                }

                App::$db->insertRow('orders', [
                    'email' => $_SESSION['email'],
                    'id' => $pizza_id,
                    'status' => 'active',
                    'name' => $_POST['name'],
                    'timestamp' => time()
                ]);
            }

        }

    }

    public function redirect()
    {
        if (!App::$session->getUser()) {
            $this->redirectForm = new RedirectForm('/login', 'Login', [
                'email' => [
                    'type' => 'hidden',
                    'value' => '-'
                ],
                'password' => [
                    'type' => 'hidden',
                    'value' => '-'
                ]
            ]);

            return $this->redirectForm->render();
        } elseif (App::$session->getUser()) {
            if (App::$session->getUser()['role'] === 'admin') {
                $this->redirectForm = new RedirectForm('/add', 'Create', [
                    'name' => [
                        'type' => 'hidden',
                        'value' => ''
                    ],
                    'price' => [
                        'type' => 'hidden',
                        'value' => ''
                    ],
                    'img' => [
                        'type' => 'hidden',
                        'value' => ''
                    ],
                ]);

                return $this->redirectForm->render();
            }
        }
    }


}
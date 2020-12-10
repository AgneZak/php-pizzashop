<?php

namespace App\Views\Content;

use App\App;
use App\Views\Forms\Admin\DeleteForm;
use App\Views\Forms\Admin\OrderForm;
use Core\Views\Form;

class HomeContent
{
    protected DeleteForm $form;
    protected $order;

    public function __construct()
    {
        $this->form = new deleteForm();
        $this->order = new OrderForm();

    }

    public function content()
    {
        // TODO: Implement content() method.

        if (Form::action()) {
            if ($this->form->validate()) {
                $clean_inputs = $this->form->values();

                App::$db->deleteRow('pizzas', $clean_inputs['id']);
            }

//            if ($this->order->validate()) {
//                $clean_inputs = $this->order->values();
//            }
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

}
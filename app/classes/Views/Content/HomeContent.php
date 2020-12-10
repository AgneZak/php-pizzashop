<?php

namespace App\Views\Content;

use App\App;

class HomeContent
{
    public function content()
    {
        if (isset($_POST['id'])) {
            $rows = App::$db->getRowsWhere('orders');
            $pizza_id = 1;
            foreach ($rows as $id => $row) {
                $pizza_id++;
            }

            if ($_POST['id'] === 'ORDER') {
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
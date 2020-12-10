<?php


namespace App\Views\Tables\Admin;


use App\App;
use App\Views\Forms\Admin\StatusForm;
use Core\Views\Table;

class AdminOrderTable extends Table
{
    protected StatusForm $form;

    public function __construct()
    {
        $this->form = new StatusForm();

        $rows = App::$db->getRowsWhere('orders');

        foreach ($rows as $id => &$row) {
            $user = App::$db->getRowWhere('users', ['email' => $row['email']]);
            $row['full_name'] = $user['name'];

            $timeago = date('h:i', (time() - $row['timestamp']));
            $row['timestamp'] = $timeago;

            $statusForm = new StatusForm($row['status'], $id);
            $rows[$id]['role_form'] = $statusForm->render();
            unset($row['email'],$row['status']);
        }

        parent::__construct([
            'headers' => [
                'ID',
                'Pizza Name',
                'Time Ago',
                'User Name',
                'Status'
            ],
            'rows' => $rows
        ]);
    }

}
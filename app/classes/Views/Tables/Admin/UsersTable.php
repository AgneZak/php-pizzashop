<?php


namespace App\Views\Tables\Admin;


use App\App;
use App\Views\Forms\Admin\RoleForm;
use Core\Views\Table;

class UsersTable extends Table
{
    protected RoleForm $form;

    public function __construct()
    {
        $this->form = new RoleForm();

        $rows = App::$db->getRowsWhere('users');

        foreach ($rows as $id => &$row) {
            $row['id'] = $id;
            $row['username'] = $row['name'];

            $roleForm = new RoleForm($row['role'], $row['id']);
            $rows[$id]['role_form'] = $roleForm->render();

            if ($row['email'] === $_SESSION['email']) {
                unset($row['role_form']);
            }

            unset($row['email'], $row['password'], $row['role'], $row['name']);
        }

        parent::__construct([
            'headers' => [
                'ID',
                'Name',
                'Status'
            ],
            'rows' => $rows
        ]);
    }

}
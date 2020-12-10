<?php


namespace App\Controllers\Admin;

use App\App;
use App\Controllers\Base\AuthController;
use App\Views\BasePage;
use App\Views\Forms\Admin\RoleForm;
use App\Views\Tables\Admin\UsersTable;

class UsersController extends AuthController
{
    protected BasePage $page;
    protected RoleForm $form;

    public function __construct()
    {
        parent::__construct();
        $this->page = new BasePage([
            'title' => 'Users',
        ]);
        $this->form = new RoleForm();

    }

    public function index(): ?string
    {
        $rows = App::$db->getRowsWhere('users');

        if ($this->form->validate()) {
            $clean_inputs = $this->form->values();

            foreach ($rows as $id => $row) {

                if ($clean_inputs['id'] == $id) {
                    $row['role'] = $clean_inputs['role'];
                    App::$db->updateRow('users', $id, $row);
                }
            }
        }

        $table = new UsersTable();

        $this->page->setContent($table->render());

        return $this->page->render();
    }
}
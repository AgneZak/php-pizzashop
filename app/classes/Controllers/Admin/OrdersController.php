<?php


namespace App\Controllers\Admin;

use App\App;
use App\Controllers\Base\AuthController;
use App\Views\BasePage;
use App\Views\Forms\Admin\StatusForm;
use App\Views\Tables\Admin\AdminOrderTable;

class OrdersController extends AuthController
{
    protected BasePage $page;
    protected StatusForm $form;

    public function __construct()
    {
        parent::__construct();
        $this->page = new BasePage([
            'title' => 'Orders',
        ]);
        $this->form = new StatusForm();

    }

    public function index(): ?string
    {
        $rows = App::$db->getRowsWhere('orders');

        if ($this->form->validate()) {
            $clean_inputs = $this->form->values();

            foreach ($rows as $id => $row) {
                if ($clean_inputs['id'] == $id) {
                    $row['status'] = $clean_inputs['status'];
                    App::$db->updateRow('orders', $id, $row);
                }
            }
        }

        $table = new AdminOrderTable();

        $this->page->setContent($table->render());

        return $this->page->render();
    }
}
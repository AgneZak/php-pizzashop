<?php


namespace App\Controllers\Admin\Pizza;


use App\App;
use App\Controllers\Base\AuthController;
use App\Views\BasePage;
use App\Views\Content\FormContent;
use App\Views\Forms\Admin\AddForm;
use Core\View;

class EditController extends AuthController
{
    protected AddForm $form;
    protected BasePage $page;
    protected FormContent $form_content;

    public function __construct()
    {
        parent::__construct();
        $this->form = new AddForm();
        $this->page = new BasePage([
            'title' => 'Edit Item',
        ]);
    }

    public function edit(): ?string
    {
        $row_id = $_GET['id'] ?? null;

        if ($row_id === null) {
            header("Location: /index");
            exit();
        }

        $this->form->fill(App::$db->getRowById('pizzas', $row_id));

        if ($this->form->validate()) {
            $clean_inputs = $this->form->values();

            App::$db->updateRow('pizzas', $row_id, $clean_inputs);

            header("Location: /index");
            exit();
        }

        $this->form_content = new FormContent([
            'title' => 'Edit Item',
            'form' => $this->form->render()
        ]);

        $this->page->setContent($this->form_content->render());

        return $this->page->render();
    }

}
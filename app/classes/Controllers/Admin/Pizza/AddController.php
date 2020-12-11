<?php

namespace App\Controllers\Admin\Pizza;

use App\App;
use App\Controllers\Base\AuthController;
use App\Views\BasePage;
use App\Views\Content\FormContent;
use App\Views\Forms\Admin\AddForm;
use Core\View;

class AddController extends AuthController
{
    protected AddForm $form;
    protected BasePage $page;
    protected FormContent $form_content;

    public function __construct()
    {
        parent::__construct();
        $this->form = new AddForm();
        $this->form_content = new FormContent([
            'title' => 'Add',
            'form' => $this->form->render()
        ]);
        $this->page = new BasePage([
            'title' => 'Add Items',
        ]);
    }

    public function add(): ?string
    {
        if ($this->form->validate()) {
            $clean_inputs = $this->form->values();

            App::$db->insertRow('pizzas', $clean_inputs);

            $msg = 'You added an item';
        }

        $this->page->setContent($this->form_content->render());

        return $this->page->render();
    }

}
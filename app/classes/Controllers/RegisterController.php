<?php


namespace App\Controllers;

use App\App;
use App\Controllers\Base\GuestController;
use App\Views\BasePage;
use App\Views\Content\FormContent;
use App\Views\Forms\RegisterForm;
use Core\View;

class RegisterController extends GuestController
{
    protected RegisterForm $form;
    protected BasePage $page;
    protected FormContent $form_content;

    public function __construct()
    {
        parent::__construct();
        $this->form = new RegisterForm();
        $this->form_content = new FormContent([
            'title' => 'Register',
            'form' => $this->form->render()
        ]);
        $this->page = new BasePage([
            'title' => 'Register',
        ]);
    }

    public function register(): ?string
    {
        if ($this->form->validate()) {
            $clean_inputs = $this->form->values();

            unset($clean_inputs['password_repeat']);

            App::$db->insertRow('users', $clean_inputs + ['role' => 'user']);

            header("Location: /login");
        }

        $this->page->setContent($this->form_content->render());

        return $this->page->render();
    }

}
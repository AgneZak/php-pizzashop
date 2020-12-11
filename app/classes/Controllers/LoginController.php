<?php


namespace App\Controllers;


use App\App;
use App\Controllers\Base\GuestController;
use App\Views\BasePage;
use App\Views\Content\FormContent;
use App\Views\Forms\LoginForm;
use Core\View;

class LoginController extends GuestController
{
    protected LoginForm $form;
    protected BasePage $page;
    protected FormContent $form_content;

    public function __construct()
    {
        parent::__construct();
        $this->form = new LoginForm();
        $this->form_content = new FormContent([
            'title' => 'Login',
            'form' => $this->form->render()
        ]);
        $this->page = new BasePage([
            'title' => 'Login',
        ]);
    }

    public function login(): ?string
    {
        if ($this->form->validate()) {
            $clean_inputs = $this->form->values();

            App::$session->login($clean_inputs['email'], $clean_inputs['password']);

            if (App::$session->getUser()) {
                header("Location: index");
                exit();
            }
        }

        $this->page->setContent($this->form_content->render());

        return $this->page->render();
    }

}
<?php


namespace App\Controllers\Admin\Discount;


use App\App;
use App\Controllers\Base\AuthController;
use App\Views\BasePage;
use App\Views\Content\FormContent;
use App\Views\Forms\Admin\DiscountForm;

class AddController extends AuthController
{
    protected DiscountForm $form;
    protected BasePage $page;
    protected FormContent $form_content;

    public function __construct()
    {
        parent::__construct();
        $pizzas = App::$db->getRowsWhere('pizzas');
        foreach ($pizzas as $pizza_id => $pizza){
            $pizza_options[$pizza_id] = $pizza['name'];
        }
        $this->form = new DiscountForm($pizza_options);

        $this->page = new BasePage([
            'title' => 'Add Discount',
        ]);
    }

    public function index(): ?string
    {
        if ($this->form->validate()) {
            $clean_inputs = $this->form->values();

            App::$db->insertRow('discounts', $clean_inputs);

            $msg = 'You added a discount';
        }

        $this->form_content = new FormContent([
            'title' => 'Add',
            'form' => $this->form->render(),
            'message' => $msg ?? null
        ]);

        $this->page->setContent($this->form_content->render());

        return $this->page->render();
    }

}
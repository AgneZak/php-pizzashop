<?php


namespace App\Controllers\Admin\Discount;


use App\App;
use App\Controllers\Base\AuthController;
use App\Views\BasePage;
use App\Views\Content\FormContent;
use App\Views\Forms\Admin\DiscountForm;

class EditController extends AuthController
{
    protected DiscountForm $form;
    protected BasePage $page;
    protected FormContent $form_content;

    public function __construct()
    {
        parent::__construct();

        $pizzas = App::$db->getRowsWhere('pizzas');
        foreach ($pizzas as $pizza_id => $pizza) {
            $pizza_options[$pizza_id] = $pizza['name'];
        }
        $this->form = new DiscountForm($pizza_options);

        $this->page = new BasePage([
            'title' => 'Edit Discount',
        ]);
    }

    public function index(): ?string
    {
        $row_id = $_GET['id'] ?? null;

        if ($row_id === null) {
            header("Location: /admin/discounts");
            exit();
        }

        $this->form->fill(App::$db->getRowById('discounts', $row_id));

        if ($this->form->validate()) {
            $clean_inputs = $this->form->values();

            App::$db->updateRow('discounts', $row_id, $clean_inputs);

            header("Location: /admin/discounts");
            exit();
        }

        $this->form_content = new FormContent([
            'title' => 'Edit Discount',
            'form' => $this->form->render()
        ]);

        $this->page->setContent($this->form_content->render());

        return $this->page->render();
    }


}
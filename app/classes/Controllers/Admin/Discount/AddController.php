<?php


namespace App\Controllers\Admin\Discount;


use App\App;
use App\Controllers\Base\AuthController;
use App\Views\BasePage;
use App\Views\Forms\Admin\DiscountForm;
use Core\View;

class AddController extends AuthController
{
    protected DiscountForm $form;
    protected BasePage $page;

    public function __construct()
    {
        parent::__construct();
        $id_array = [];
        $pizzas = App::$db->getRowsWhere('pizzas');
        foreach ($pizzas as $pizza_id => $pizza){
            $id_array[$pizza_id] = $pizza['name'];
        }

        $this->form = new DiscountForm($id_array);
        $this->page = new BasePage([
            'title' => 'Add Discount',
        ]);
    }

    public function index(): ?string
    {
        if ($this->form->validate()) {
            $clean_inputs = $this->form->values();

            App::$db->insertRow('discounts', $clean_inputs);

            $p = 'You added a discount';
        }

        $content = new View([
            'title' => 'Add',
            'form' => $this->form->render(),
            'message' => $p ?? null
        ]);

        $this->page->setContent($content->render(ROOT . '/app/templates/content/forms.tpl.php'));

        return $this->page->render();
    }

}
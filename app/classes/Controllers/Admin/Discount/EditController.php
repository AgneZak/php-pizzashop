<?php


namespace App\Controllers\Admin\Discount;


use App\App;
use App\Controllers\Base\AuthController;
use App\Views\BasePage;
use App\Views\Forms\Admin\DiscountForm;
use Core\View;

class EditController extends AuthController
{
    protected DiscountForm $form;
    protected BasePage $page;

    public function __construct()
    {
        parent::__construct();

        $pizzas = App::$db->getRowsWhere('pizzas');
        foreach ($pizzas as $pizza_id => $pizza) {
            $id_array[$pizza_id] = $pizza['name'];
        }
        $this->form = new DiscountForm($id_array);

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

            $p = 'You edited the item';

            header("Location: /admin/discounts");
            exit();
        }

        $content = new View([
            'title' => 'Edit Discount',
            'form' => $this->form->render(),
            'message' => $p ?? null
        ]);

        $this->page->setContent($content->render(ROOT . '/app/templates/content/forms.tpl.php'));

        return $this->page->render();
    }


}
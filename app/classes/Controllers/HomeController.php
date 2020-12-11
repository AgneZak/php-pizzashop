<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\App;
use App\Views\BasePage;
use App\Views\Content\HomeContent;
use App\Views\Forms\Admin\DeleteForm;
use App\Views\Forms\Admin\OrderForm;
use Core\View;
use Core\Views\Link;

class HomeController extends Controller
{
    protected BasePage $page;
    protected $link;

    /**
     * Controller constructor.
     *
     * We can write logic common for all
     * other methods
     *
     * For example, create $page object,
     * set it's header/navigation
     * or check if user has a proper role
     *
     * Goal is to prepare $page
     */
    public function __construct()
    {
        $this->page = new BasePage([
            'title' => 'P-00Pica'
        ]);
    }

    /**
     * This method builds or sets
     * current $page content
     * renders it and returns HTML
     *
     * So if we have ex.: ProductsController,
     * it can have methods responsible for
     * index() (main page, usualy a list),
     * view() (preview single),
     * create() (form for creating),
     * edit() (form for editing)
     * delete()
     *
     * These methods can then be called on each page accordingly, ex.:
     * add.php:
     * $controller = new PixelsController();
     * print $controller->add();
     *
     *
     * my.php:
     * $controller = new ProductsController();
     * print $controller->my();
     *
     * @return string|null
     * @throws \Exception
     */
    function index(): ?string
    {
        if (App::$session->getUser()) {
            $h3 = "Sveiki sugrize {$_SESSION['email']}";
        } else {
            $h3 = 'Jus neprisijunges';
        }

        $home_content = new HomeContent();

        $home_content->content();

        $rows = App::$db->getRowsWhere('pizzas');
        $discounts = App::$db->getRowsWhere('discounts');
        $edit_pizza_url = App::$router::getUrl('edit');

        foreach ($rows as $id => &$row) {

            foreach ($discounts as $discount_id => $discount) {
                if ($id == $discount['pizza_id']) {
                    $row['discount'] = true;

                    $row['price_diff'] = number_format($row['price'], 2);
                    $row['price'] = $discount['price'];
                }
            }

            if (App::$session->getUser()) {
                if (App::$session->getUser()['role'] === 'admin') {
                    $this->link = new Link([
                        'link' => "{$edit_pizza_url}?id={$id}",
                        'class' => 'link',
                        'text' => 'Edit'
                    ]);

                    $row['link'] = $this->link->render();

                    $deleteForm = new DeleteForm($id);
                    $row['delete'] = $deleteForm->render();

                } elseif (App::$session->getUser()['role'] === 'user') {

                    $orderForm = new OrderForm($row['name']);
                    $row['order'] = $orderForm->render();
                }
            }

            $price = number_format($row['price'], 2);
            $row['price'] = "{$price} $";
        }

        $content = new View([
            'title' => 'Welcome to Pz-DERIA',
            'heading' => $h3,
            'buttons' => [
                'add_discount' => $home_content->addDiscount(),
                'login_or_create' => $home_content->redirectLink(),
            ],
            'products' => $rows
        ]);

        $this->page->setContent($content->render(ROOT . '/app/templates/content/index.tpl.php'));

        return $this->page->render();
    }
}
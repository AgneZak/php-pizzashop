<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\App;
use App\Views\BasePage;
use App\Views\Content\HomeContent;
use App\Views\Forms\Admin\DeleteForm;
use App\Views\Forms\Admin\OrderForm;
use App\Views\Forms\RedirectForm;
use Core\View;

class HomeController extends Controller
{
    protected BasePage $page;
    protected RedirectForm $redirectForm;

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
        $this->redirectForm = new RedirectForm();
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

        $url = App::$router::getUrl('edit');

        foreach ($rows as $id => &$row) {
            $row['link'] = "{$url}?id={$id}";

            $deleteForm = new DeleteForm($id);
            $row['delete'] = $deleteForm->render();

            $orderForm = new OrderForm($row['name']);
            $row['order'] = $orderForm->render();
        }

        $content = new View([
            'title' => 'Welcome to Pz-DERIA',
            'heading' => $h3,
            'redirect' => $home_content->redirect(),
            'products' => $rows
        ]);

        $this->page->setContent($content->render(ROOT . '/app/templates/content/index.tpl.php'));

        return $this->page->render();
    }
}
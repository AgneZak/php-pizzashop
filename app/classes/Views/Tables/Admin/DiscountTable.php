<?php


namespace App\Views\Tables\Admin;


use App\App;
use App\Views\Forms\Admin\DeleteForm;
use Core\Views\Link;
use Core\Views\Table;

class DiscountTable extends Table
{
    public function __construct()
    {
        $rows = App::$db->getRowsWhere('discounts');
        $url = App::$router::getUrl('admin_discounts_edit');

        $pizzas = App::$db->getRowsWhere('pizzas');
        foreach ($pizzas as $pizza_id => $pizza) {
            $names[$pizza_id] = $pizza['name'];
        }

        foreach ($rows as $id => $row) {
            $rows[$id]['name'] = $names[$id];

            $link = new Link([
                'link' => "{$url}?id={$id}",
                'class' => 'link',
                'text' => 'Edit'
            ]);
            $rows[$id]['link'] = $link->render();

            $deleteForm = new DeleteForm($id);
            $rows[$id]['delete'] = $deleteForm->render();
        }

        parent::__construct([
            'headers' => [
                'ID',
                'Price',
                'Pizza name',
                'Edit',
                'Delete'
            ],
            'rows' => $rows
        ]);
    }

}
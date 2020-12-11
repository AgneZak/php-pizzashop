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
        $discount_id = 0;
        foreach ($rows as $id => $row) {
            $rows[$id]['id'] = ++$discount_id;

            $rows[$id]['name'] = $names[$rows[$id]['pizza_id']];
            $rows[$id]['discount_price'] = $rows[$id]['price'];
            $link = new Link([
                'link' => "{$url}?id={$id}",
                'class' => 'link',
                'text' => 'Edit'
            ]);
            $rows[$id]['link'] = $link->render();

            $deleteForm = new DeleteForm($id);
            $rows[$id]['delete'] = $deleteForm->render();

            unset($rows[$id]['pizza_id']);
            unset($rows[$id]['price']);
        }

        parent::__construct([
            'headers' => [
                'ID',
                'Pizza name',
                'Price',
                'Edit',
                'Delete'
            ],
            'rows' => $rows
        ]);
    }

}
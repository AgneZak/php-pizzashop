<?php


namespace App\Views\Tables\Admin;


use App\App;
use App\Views\Forms\Admin\StatusForm;
use Core\Views\Table;

class AdminOrderTable extends Table
{
    protected StatusForm $form;

    public function __construct()
    {
        $this->form = new StatusForm();

        $rows = App::$db->getRowsWhere('orders');

        foreach ($rows as $id => &$row) {
            $user = App::$db->getRowWhere('users', ['email' => $row['email']]);
            $row['full_name'] = $user['name'];

            $timeStamp = date('Y-m-d H:i:s', $row['timestamp']);
            $difference = abs(strtotime("now") - strtotime($timeStamp));

            $days = floor($difference / (3600*24));
            $hours = floor($difference / 3600);
            $minutes = floor(($difference - ($hours*3600)) / 60);
            $seconds = floor($difference % 60);

            if ($days){
                $hours = $hours - 24;
                $result = "{$days}d {$hours}:{$minutes} H";
            } elseif ($minutes) {
                $result = "{$minutes} min";
            } elseif ($hours) {
                $result = "{$hours}:{$minutes} H";
            } else {
                $result ="{$seconds} seconds";
            }

            $row['timestamp'] = $result;

            $statusForm = new StatusForm($row['status'], $id);
            $rows[$id]['role_form'] = $statusForm->render();
            unset($row['email'], $row['status']);
        }

        parent::__construct([
            'headers' => [
                'ID',
                'Pizza Name',
                'Time Ago',
                'User Name',
                'Status'
            ],
            'rows' => $rows
        ]);
    }

}
<?php

namespace app\models;

use Yii;


class OrderMobile extends \yii\db\ActiveRecord
{

    public $id_tour = 0;
    public $id_owner = 0;
    public $tour_name = ' ';
    public $date_tour;
    public $name;
    public $tel;
    public $count;
    public $email;
    public $info;
    public $date = 0;
    public $status = 0;

    public function add()
    {
        $order = new Order();
        $order->id_tour = $this->id_tour;
        $order->name = $this->name;
        $order->tel= $this->tel;
        $order->count= $this->count;
        $order->email= $this->email;
        $order->info = $this->info;
        $order->date_tour = $this->date_tour;
        $order->date = date('Y-m-d h:m:s');
        $order->status = $this->status;

        $tour = Tour::findOne($this->id_tour);
        $order->id_owner = $tour->id_user;
        $order->tour_name = $tour->name;


        $order->save(false);
        return $order ? $order : null;
    }

}

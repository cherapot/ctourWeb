<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $id_tour
 * @property integer $id_user
 * @property integer $id_owner
 * @property integer $tour_name
 * @property string $name
 * @property string $phone
 * @property integer $count
 * @property string $email
 * @property string $info
 * @property string $date_tour
 * @property string $date
 * @property string $status
 */
class OrderForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $id;
    public $id_tour = 0;
    public $id_user = 0;
    public $id_owner = 0;
    public $tour_name = ' ';
    public $name;
    public $tel;
    public $count;
    public $email;
    public $info;
    public $date = 0;
    public $status = 0;



    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tour',  'name', 'tel', 'count', 'email', 'info', 'date_tour', 'date'], 'required'],
            [['id_tour', 'count'], 'integer'],
            [['info'], 'string'],
            ['email', 'email'],
            [['date_tour', 'date'], 'safe'],
            [['name', 'email'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 24]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_tour' => 'Id Tour',
            'id_user' => 'Id User',
            'id_owner' => 'Id Owner',
            'tour_name' => 'Название тура',
            'name' => 'Имя',
            'tel' => 'Телефон',
            'count' => 'Количество',
            'email' => 'Email',
            'info' => 'Информация',
            'date_tour' => 'Дата',
            'date' => 'Date',
        ];
    }

    public function add($id)
    {
        $order = new Order();
        $order->id_tour = $id;
        $order->id_user = Yii::$app->user->id;
        $order->name = $this->name;
        $order->tel= $this->tel;
        $order->count= $this->count;
        $order->email= $this->email;
        $order->info = $this->info;
        $order->date_tour = $this->date_tour;
        $order->date = date('Y-m-d h:m:s');
        $order->status = $this->status;

        $tour = Tour::findOne($id);
        $order->id_owner = $tour->id_user;
        $order->tour_name = $tour->name;


        $order->save(false);
        return $order ? $order : null;
    }

    public function confirm($id)
    {
        $order = Order::findOne($id);
        $order->status = 1;
        $order->save(false);

        return true;
    }
}

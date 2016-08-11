<?php
/**
 * Created by PhpStorm.
 * User: redmenote
 * Date: 07.01.16
 * Time: 17:22
 */
namespace app\models;

use yii\base\Model;
use Yii;

class AddForm extends Model
{
    public $id_user = 0;
    public $name;
    public $org;
    public $tel;
    public $address;
    public $info;
    public $site;
    public $date = 0;
    public $status = 0;

    public function rules()
    {
        return [
            [['id_user', 'name', 'org', 'tel', 'address', 'info', 'site', 'date', 'status'], 'required'],
            [['id_user', 'status'], 'integer'],
            [['info'], 'string'],
            [['date'], 'safe'],
            [['name', 'org', 'address', 'site'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'name' => 'Название',
            'org' => 'Организация',
            'tel' => 'Телефон',
            'address' => 'Адрес',
            'info' => 'Информация',
            'site' => 'Сайт',
            'date' => 'Дата',
            'status' => 'Status',
            'imageFile' => 'Загрузить изображение'
        ];
    }



    public function add()
    {
        $tour = new Tour();
        $tour->id_user = Yii::$app->user->id;
        $tour->name = $this->name;
        $tour->org = $this->org;
        $tour->tel = $this->tel;
        $tour->address = $this->address;
        $tour->info = $this->info;
        $tour->site = $this->site;
        $tour->date = date('Y-m-d h:m:s');
        $tour->status = 0;

        $tour->save(false);
        return $tour ? $tour : null;
    }

    public function upgrade($id)
    {
        $tour = Tour::findOne($id);
        $tour->name = $this->name;
        $tour->org = $this->org;
        $tour->tel = $this->tel;
        $tour->address = $this->address;
        $tour->info = $this->info;
        $tour->site = $this->site;

        $tour->save(false);
        return $tour ? $tour : null;
    }


}

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
 * @property string $tel
 * @property integer $count
 * @property string $email
 * @property string $info
 * @property string $date_tour
 * @property string $date
 * @property string $status
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['id_tour', 'id_owner', 'tour_name', 'name', 'tel', 'count', 'email', 'info', 'date_tour', 'date'], 'required'],
            [['id_tour', 'count'], 'integer'],
            [['info'], 'string'],
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
            'date_tour' => 'Датаr',
            'date' => 'Date',
            'status' => 'Status'
        ];
    }
}

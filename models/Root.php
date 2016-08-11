<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tour".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $name
 * @property string $org
 * @property string $tel
 * @property string $address
 * @property string $info
 * @property string $site
 * @property string $date
 * @property integer $status
 */
class Root extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tour';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'name', 'org', 'tel', 'address', 'info', 'site', 'date', 'status'], 'required'],
            [['id_user', 'status'], 'integer'],
            [['info'], 'string'],
            [['date'], 'safe'],
            [['name', 'org', 'address', 'site'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 25]
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
            'name' => 'Name',
            'org' => 'Org',
            'tel' => 'Tel',
            'address' => 'Address',
            'info' => 'Info',
            'site' => 'Site',
            'date' => 'Date',
            'status' => 'Status',
        ];
    }

    public function del($id)
    {
        $tour = Tour::findOne($id);

        $tour->delete();
    }
}

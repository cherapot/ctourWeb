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
 * @property string $image
 */
class Tour extends \yii\db\ActiveRecord
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
            [['id_user', 'name', 'org', 'tel', 'address', 'info', 'site', 'date', 'status', 'image'], 'required'],
            [['id_user', 'status'], 'integer'],
            [['info'], 'string'],
            [['date'], 'safe'],
            [['name', 'org', 'address', 'site'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 25],
            ['image', 'file', 'skipOnEmpty' => false, 'extensions'=>'jpg, gif, png, jpeg'],
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
            'image' => 'Image',
        ];
    }

    public function del($id)
    {
        $tour = Tour::findOne($id);

        $tour->delete();
    }

    public function findByDate($day, $month, $year)
    {
        $month = $month+1;
        if($month<10) $month = '0'.$month;
        if($day<10) $day = '0'.$day;
        $date = $year.'-'.$month.'-'.$day;
        //$date = '2016-01-14';
        $query = Tour::find()
            ->orFilterWhere(['like', 'date', $date])
            ->andWhere(['status' => 1]);

        return $query;

    }
}

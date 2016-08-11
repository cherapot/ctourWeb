<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_tour
 * @property string $comment
 * @property string $date
 *
 * @property User $idUser
 * @property Tour $idTour
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_tour', 'comment', 'date'], 'required'],
            [['id_user', 'id_tour'], 'integer'],
            [['comment', 'date'], 'string']
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
            'id_tour' => 'Id Tour',
            'comment' => 'Введите ваш комментарий',
            'date' => 'Дата'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'id_tour']);
    }
}

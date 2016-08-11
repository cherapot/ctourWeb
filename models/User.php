<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $auth_key
 * @property string $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $secret_key
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */


    const STATUS_DELETED = 0;
    const STATUS_NOT_ACTIVE = 1;
    const STATUS_ACTIVE = 10;

    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'authkey'], 'required'],
            [['username', 'email'], 'string', 'max' => 30],
            [['password', 'authkey'], 'string', 'max' => 100],
            ['email' , 'email'],
            ['username', 'unique', 'message' => 'Это имя занято.'],
            ['email', 'unique', 'message' => 'Эта почта уже зарегистрирована.']
        ];
    }

    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    public static function findByUsername($username)
    {
        return static::findOne([
            'username' => $username
        ]);
    }

    public function setPassword($pass)
    {
        $this->password = Yii::$app->security->generatePasswordHash($pass);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function validatePassword($pass)
    {
        return Yii::$app->security->validatePassword($pass, $this->password);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'status' => 'Статус',
            'auth_key' => 'Auth Key',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }



    public static function findIdentity($id)
    {
        return static::findOne([
            'id' => $id
        ]);
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }
    public function getId()
    {
        return $this->id;
    }
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }
}

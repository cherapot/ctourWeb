<?php
/**
 * Created by PhpStorm.
 * User: redmenote
 * Date: 06.01.16
 * Time: 21:24
 */

namespace app\models;
use yii\base\Model;
use Yii;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $status;
    public $_user = false;

    public function rules()
    {
        return [
            // username and password are both required
                [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
                ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
                ['password', 'validatePassword'],
        ];
    }

    public function getUser()
    {
        if ($this->_user === false)
            $this->_user = User::findByUsername($this->username);

        return $this->_user;
    }

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors())
        {
            $user = $this->getUser();
            if  (!$user || !$user->validatePassword($this->password))
                $this->addError($attribute, 'Неправильное имя пользователя или пароль');
        }
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня'
        ];
    }

    public function login()
    {
        if ($this->validate())
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0 );
        else
            return false;
    }

}
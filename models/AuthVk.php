<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 02.04.16
 * Time: 21:12
 */

namespace app\models;
use Yii;
use yii\base\Model;

class AuthVK extends Model {
    const APP_ID = 5393194; //ID приложения
    const APP_SECRET = 'EPKZnGuUM1hkxpiMQe3S'; //Защищенный ключ
    const URL_REDIRECT = 'http://localhost/ctour/web/index.php/site/authvk';
    const URL_AUTHORIZE = 'https://oauth.vk.com/authorize';
    const URL_ACCESS_TOKEN = 'https://oauth.vk.com/access_token';
    const URL_GET_PROFILE = 'https://api.vk.com/method/users.get';
    public $_user = false;
    public $rememberMe = true;

    public function Auth(){
         return (self::URL_AUTHORIZE.
        '?client_id=' . self::APP_ID.
        '&scope=offline'.
        '&redirect_uri='. urlencode(self::URL_CALLBACK).
        '&response_type=code');
    }

    public function getToken($code) {
        $params = array(
            'client_id' => self::APP_ID,
            'client_secret' => self::APP_SECRET,
            'code' => $code,
            'redirect_uri' => self::URL_REDIRECT
        );

        $token = json_decode(file_get_contents(self::URL_ACCESS_TOKEN. '?'
            . urldecode(http_build_query($params))), true);

        if (isset($token['access_token'])) {
            $params = array(
                'uids'         => $token['user_id'],
                'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
                'access_token' => $token['access_token']
            );
            return $params;
        }

        return false;
    }

    public function getUser($params) {

        $userInfo = json_decode(file_get_contents(self::URL_GET_PROFILE . '?'
            . urldecode(http_build_query($params))), true);

        if (isset($userInfo['response'][0]['uid'])) {
            $userInfo = $userInfo['response'][0];

            $username = 'vk'.$userInfo['uid'];

            if($this->findUser($username) == false){
                $this->reg($username);
                $this->login($username);
            }
            else {
                $this->login($username);
            }
            return $userInfo;
        }
        return false;
    }

    public function reg($username)
    {
        $user = new User();
        $user->username = $username;
        $user->email = $username.'@vk.com';
        $user->status = true;
        $user->setPassword('null');
        $user->generateAuthKey();
        $user->save(false);
        return $user ? $user : null;
    }

    public function findUser($username)
    {
        if ($this->_user === false)
            $this->_user = User::findByUsername($username);

        return $this->_user;
    }

    public function login($username)
    {
        if ($this->validate())
            return Yii::$app->user->login($this->findUser($username), $this->rememberMe ? 3600 * 24 * 30 : 0 );
        else
            return false;
    }


}

?>


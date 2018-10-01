<?php
/**
 * Created by PhpStorm.
 * User: stanislav
 * Date: 30.09.2018
 * Time: 13:53
 */

namespace app\models;


use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'validatePassword']
        ];
    }

    public function validatePassword($attribute, $params)
    {
        $user = $this->getUser();

        if (!$user || (!$user->validatePassword($this->password)))
        {
            $this->addError($attribute, 'Invalid username or password');
        }
    }

    private function getUser()
    {
        return User::findOne(['email' => $this->email]);
    }

    public function login()
    {
        if ($this->validate()) {

            $user = $this->getUser();
            if($user->status === User::STATUS_ACTIVE){
                return Yii::$app->user->login($user);
            }
            if($user->status === User::STATUS_WAIT){
                throw new \DomainException('To complete the registration, confirm your email. Check your email.');
            }

        } else {
            return false;
        }
    }
}
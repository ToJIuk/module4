<?php

namespace app\models;


use yii\base\Model;

class Login extends Model
{
    public $name;
    public $password;

    public function rules(){
        return [
            [['name', 'password'], 'required'],
            ['password', 'validatePassword']
        ];
    }

    public function validatePassword($attribute, $params){
        if (!$this->hasErrors()){
            $user = $this->getUser();
            if (!$user or !$user->validatePassw($this->password)){
                $this->addError($attribute, 'Пароль или пользователь введены неверно');
            }
        }

    }
    public function getUser(){
        return Users::findOne(['name'=>$this->name]);
    }
}
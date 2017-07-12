<?php

namespace app\models;


use yii\base\Model;

class Signup extends Model
{
    public $name;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'app\models\Users'],
            ['name', 'unique', 'targetClass' => 'app\models\Users'],
            ['password', 'string', 'min'=>2, 'max'=>20]
        ];
    }
    public function signup(){
        $user = new Users();
        $user->email = $this->email;
        $user->name = $this->name;
        $user->setPassword($this->password);
        return $user->save();
    }

}
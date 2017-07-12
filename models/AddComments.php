<?php
/**
 * Created by PhpStorm.
 * User: ToJIuk
 * Date: 12.07.2017
 * Time: 23:04
 */

namespace app\models;


use yii\base\Model;

class AddComments extends Model
{
    public $username;
    public $text;
    public $count;
    public $subject;

    public function rules()
    {
        return [
            [['text'], 'required'],
        ];
    }
    public function addcomment(){
        $comments = new Comments();
        $comments->username = $this->username;
        $comments->text = $this->text;
        $comments->count = $this->count;
        $comments->subject = $this->subject;

        return $comments->save();
    }



}
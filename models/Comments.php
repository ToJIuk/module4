<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property string $username
 * @property string $text
 * @property integer $count
 * @property string $subject
 * @property string $date
 * @property integer $display
 *
 * @property Users $username0
 * @property News $subject0
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'text', 'subject', 'date'], 'required'],
            [['text'], 'string'],
            [['count', 'display'], 'integer'],
            [['username', 'subject', 'date'], 'string', 'max' => 50],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['username' => 'name']],
            [['subject'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['subject' => 'name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'text' => 'Text',
            'count' => 'Count',
            'subject' => 'Subject',
            'date' => 'Date',
            'display' => 'Display',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsername0()
    {
        return $this->hasOne(Users::className(), ['name' => 'username']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject0()
    {
        return $this->hasOne(News::className(), ['name' => 'subject']);
    }
}

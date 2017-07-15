<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $category
 * @property string $text
 * @property integer $analityc
 * @property string $description
 * @property string $img
 * @property string $name
 * @property string $tags1
 * @property string $tags2
 *
 * @property Comments[] $comments
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'text', 'img', 'name', 'tags1', 'tags2'], 'required'],
            [['text', 'description'], 'string'],
            [['analityc'], 'integer'],
            [['category', 'img', 'name'], 'string', 'max' => 50],
            [['tags1', 'tags2'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'text' => 'Text',
            'analityc' => 'Analityc',
            'description' => 'Description',
            'img' => 'Img',
            'name' => 'Name',
            'tags1' => 'Tags1',
            'tags2' => 'Tags2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['subject' => 'name']);
    }
}

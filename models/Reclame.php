<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reclame".
 *
 * @property integer $id
 * @property string $name
 * @property integer $price
 * @property string $firm
 */
class Reclame extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reclame';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'firm'], 'required'],
            [['price'], 'integer'],
            [['name', 'firm'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'firm' => 'Firm',
        ];
    }
}

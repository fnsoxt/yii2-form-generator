<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%item_field}}".
 *
 * @property integer $id
 * @property integer $item_id
 * @property integer $field_id
 * @property string $value
 *
 * @property Item $item
 * @property Field $field
 */
class _ItemField extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%item_field}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'field_id'], 'required'],
            [['item_id', 'field_id'], 'integer'],
            [['value'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_id' => Yii::t('app', '选项ID'),
            'field_id' => Yii::t('app', '域ID'),
            'value' => Yii::t('app', '值'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getField()
    {
        return $this->hasOne(Field::className(), ['id' => 'field_id']);
    }
}

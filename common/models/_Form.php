<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%form}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property string $template_name
 * @property integer $status
 * @property string $options
 * @property integer $create_at
 *
 * @property Field[] $fields
 * @property Item[] $items
 */
class _Form extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%form}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['desc', 'options'], 'string'],
            [['status', 'create_at'], 'integer'],
            [['name', 'template_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '名称'),
            'desc' => Yii::t('app', '描述'),
            'template_name' => Yii::t('app', '模板名称'),
            'status' => Yii::t('app', '状态'),
            'options' => Yii::t('app', '参数'),
            'create_at' => Yii::t('app', '创建时间'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFields()
    {
        return $this->hasMany(Field::className(), ['form_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['form_id' => 'id']);
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%item}}".
 *
 * @property integer $id
 * @property integer $form_id
 * @property string $name
 * @property string $desc
 * @property string $ip
 * @property integer $create_at
 *
 * @property Form $form
 * @property ItemField[] $itemFields
 */
class _Item extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['form_id', 'ip'], 'required'],
            [['form_id', 'create_at'], 'integer'],
            [['desc', 'ip'], 'string'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'form_id' => Yii::t('app', '表单ID'),
            'name' => Yii::t('app', '名称'),
            'desc' => Yii::t('app', '描述'),
            'ip' => Yii::t('app', 'IP地址'),
            'create_at' => Yii::t('app', '创建时间'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForm()
    {
        return $this->hasOne(Form::className(), ['id' => 'form_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemFields()
    {
        return $this->hasMany(ItemField::className(), ['item_id' => 'id']);
    }
}

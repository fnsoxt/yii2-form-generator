<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%field}}".
 *
 * @property integer $id
 * @property integer $form_id
 * @property string $name
 * @property string $desc
 * @property string $type
 * @property string $default
 * @property string $options
 * @property integer $order
 * @property integer $required
 * @property integer $create_at
 *
 * @property Form $form
 * @property ItemField[] $itemFields
 */
class _Field extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%field}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['form_id', 'name', 'type'], 'required'],
            [['form_id', 'order', 'required', 'create_at'], 'integer'],
            [['name', 'desc', 'type', 'default', 'options'], 'string']
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
            'type' => Yii::t('app', '类型'),
            'default' => Yii::t('app', '默认值'),
            'options' => Yii::t('app', '参数'),
            'order' => Yii::t('app', '顺序'),
            'required' => Yii::t('app', '是否必须'),
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
        return $this->hasMany(ItemField::className(), ['field_id' => 'id']);
    }
}

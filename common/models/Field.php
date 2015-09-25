<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

class Field extends _Field
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_at',
                'updatedAtAttribute' => false,
            ],
        ];
    }

    public function beforeSave($insert) {
        if($insert){
        }
        return parent::beforeSave($insert);
    }

    public function beforeValidate(){
        return parent::beforeValidate();
    }

    public function afterFind(){
        return parent::afterFind();
    }
}

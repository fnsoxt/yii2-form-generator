<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

class Item extends _Item
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

    public function getFields($id)
    {
        return $this->hasMany(ItemField::className(), ['item_id' => 'id'])->where(['field_id'=>$id])->one();
    }
}

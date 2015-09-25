<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

class Form extends _Form
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
}

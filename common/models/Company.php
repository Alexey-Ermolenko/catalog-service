<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

class Company extends base\Company
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            TimestampBehavior::className(),
        ]);
    }
}
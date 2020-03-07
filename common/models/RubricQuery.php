<?php

namespace common\models;

use creocoder\nestedsets\NestedSetsQueryBehavior;

class RubricQuery extends \yii\db\ActiveQuery
{
    public function behaviors()
    {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     * @return Rubric[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Rubric|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
<?php

namespace common\models;

use yii\db\ActiveQuery;

class Rubric extends base\Rubric
{
    /**
     * @return ActiveQuery
     */
    public function getRubricsWithSortByName()
    {
        return $this->hasMany(Rubric::className(), ['parent_id' => 'id'])->orderBy('name');
    }
}
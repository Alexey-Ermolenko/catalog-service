<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "rubric".
 *
 * @property int    $id
 * @property int    $tree
 * @property int    $lft
 * @property int    $rgt
 * @property int    $depth
 * @property int    $position
 * @property string $name
 */
class Rubric extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rubric';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tree', 'lft', 'rgt', 'depth', 'name'], 'required'],
            [['position'], 'default', 'value' => 0],
            [['tree', 'lft', 'rgt', 'depth'], 'default', 'value' => null],
            [['tree', 'lft', 'rgt', 'depth', 'position'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'       => Yii::t('app', 'ID'),
            'tree'     => Yii::t('app', 'Tree'),
            'lft'      => Yii::t('app', 'Lft'),
            'rgt'      => Yii::t('app', 'Rgt'),
            'depth'    => Yii::t('app', 'Depth'),
            'position' => Yii::t('app', 'Position'),
            'name'     => Yii::t('app', 'Name'),
        ];
    }
}

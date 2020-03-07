<?php

namespace api\modules\v1\models\base;

use Yii;

/**
 * This is the model class for table "rubric".
 *
 * @property int $id
 * @property int $tree
 * @property int $lft
 * @property int $rgt
 * @property int $depth
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
            [['tree', 'lft', 'rgt', 'depth'], 'default', 'value' => null],
            [['tree', 'lft', 'rgt', 'depth'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tree' => Yii::t('app', 'Tree'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'depth' => Yii::t('app', 'Depth'),
            'name' => Yii::t('app', 'Name'),
        ];
    }
}

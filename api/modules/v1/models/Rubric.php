<?php

namespace api\modules\v1\models;

use common\models\Rubric as CommonRubricModel;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 * Rubric Model
 *
 */
class Rubric extends CommonRubricModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rubric';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'negotiator' => [
                'class'   => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ]);
    }
}

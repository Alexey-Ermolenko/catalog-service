<?php

namespace api\modules\v1\models;

use common\models\base\Company as CommonCompanyModel;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 * Company Model
 *
 */
class Company extends CommonCompanyModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
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

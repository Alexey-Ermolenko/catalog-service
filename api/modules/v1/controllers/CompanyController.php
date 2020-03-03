<?php

namespace api\modules\v1\controllers;

use api\modules\v1\models\Company;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Company Controller API
 *
 */
class CompanyController extends ActiveController
{
    //public $modelClass = 'api\modules\v1\models\Company';
    public $modelClass = '@app\common\models\Company';

    public function actions()
    {
        $actions                                 = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        unset($actions['update'], $actions['create']);

        return $actions;
    }

    public function prepareDataProvider()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $search                      = new Company();

        return $search->search(\Yii::$app->request->getQueryParams());
    }
}



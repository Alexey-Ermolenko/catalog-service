<?php

namespace api\modules\v1\controllers;


use app\models\RubricSearch;
use common\models\base\Rubric;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Rubric Controller API
 *
 */
class RubricController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Rubric';

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
        $search                      = new $this->modelClass;

        return $search->search(\Yii::$app->request->getQueryParams());
    }
}



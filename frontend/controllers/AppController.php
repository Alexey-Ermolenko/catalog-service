<?php

namespace backend\controllers;

use Yii;
use yii\db\ActiveRecord;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Базовый frontend-контроллер
 *
 * Class AppController
 * @package frontend\controllers
 */
class AppController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'view'  => '/app/error',
            ],
        ];
    }

    /**
     * * Поиск модели указанного класса по id с генерацией исключения в случае, если модель найдена не будет.
     *
     * @param $className string имя класса
     * @param $id        integer id нужной модели
     *
     * @return ActiveRecord
     * @throws NotFoundHttpException
     */
    protected function findModel($className, $id)
    {
        if (($model = $className::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

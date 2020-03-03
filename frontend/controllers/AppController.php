<?php

namespace frontend\controllers;

use yii\web\Controller;

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
}

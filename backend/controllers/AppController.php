<?php

namespace backend\controllers;

use yii\web\Controller;

/**
 * Базовый backend-контроллер
 *
 * Class AppController
 * @package backend\controllers
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

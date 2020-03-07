<?php

namespace frontend\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
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
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['login', 'error'],
//                        'allow'   => true,
//                    ],
//                    [
//                        'actions' => ['logout', 'index', 'view'],
//                        'allow'   => true,
//                        'roles'   => ['@'],
//                    ],
//                    [
//                        'actions' => ['create', 'update', 'delete'],
//                        'allow'   => true,
//                        'roles'   => ['admin'],
//                    ],
//                ],
//            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ]);
    }

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

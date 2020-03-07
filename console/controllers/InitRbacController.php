<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

/**
 * init RBAC php yii init-rbac/init
 */
class InitRbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();

        $admin  = $auth->createRole('admin');
        $editor = $auth->createRole('editor');

        $auth->add($admin);
        $auth->add($editor);

        $viewAdminPage              = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        $updateRubric              = $auth->createPermission('updateRubric');
        $updateRubric->description = 'Редактирование рубрики';

        $updateCompany              = $auth->createPermission('updateCompany');
        $updateCompany->description = 'Редактирование компании';

        $auth->add($viewAdminPage);
        $auth->add($updateRubric);
        $auth->add($updateCompany);

        $auth->addChild($editor, $updateRubric);
        $auth->addChild($editor, $updateCompany);

        $auth->addChild($admin, $editor);
        $auth->addChild($admin, $viewAdminPage);

        $auth->assign($admin, 1);
        $auth->assign($editor, 2);
    }
}

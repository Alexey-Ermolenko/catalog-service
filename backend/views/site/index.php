<?php

/* @var $this yii\web\View */

$this->title = 'Админка';

use yii\bootstrap\Html;


$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'url'   => ['index'],
];

?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Rubric'), ['rubric/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Company'), ['company/index'], ['class' => 'btn btn-success']) ?>
    </p>
</div>

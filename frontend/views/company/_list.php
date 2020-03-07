<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>

<div class="company-item">
    <?= Html::a(Html::encode($model->name), ['view', 'id' => $model->id]); ?>
    <?= HTml::tag('br'); ?>
    <?php foreach ($model->rubrics as $rubric): ?>
        <?= Html::beginTag('small') ?>
        <?= Html::a(Html::encode($rubric->name), ['rubric/view', 'id' => $rubric->id]) ?>
        <?= Html::endTag('small') ?>
    <?php endforeach; ?>
    <?= HTml::tag('hr'); ?>
</div>
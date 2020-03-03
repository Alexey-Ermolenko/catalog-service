<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>

<div class="rubric-item">

        <?= Html::a(Html::encode($model->name), ['view', 'id' => $model->id]); ?>
        <?= HTml::tag('br'); ?>
        <?= Html::beginTag('div', ['style' => 'margin-left: 40px']); ?>
        <?php foreach ($model->rubrics as $rubric): ?>
            <small><?= Html::encode($rubric->name) . ' | ' ?></small>
        <?php endforeach; ?>
        <?= Html::endTag('div'); ?>

</div>
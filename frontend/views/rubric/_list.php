<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>

<div class="rubric-item">

        <?= Html::a(Html::encode($model->name), ['view', 'id' => $model->id]); ?>
        <?= HTml::tag('br'); ?>
</div>
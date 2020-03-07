<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Rubric */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rubric-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tree')->textInput() ?>

    <?= $form->field($model, 'lft')->textInput() ?>

    <?= $form->field($model, 'rgt')->textInput() ?>

    <?= $form->field($model, 'depth')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php ActiveForm::end(); ?>

</div>

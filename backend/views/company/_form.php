<?php

use common\models\Rubric;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'deletion_mark')->checkbox() ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>
    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class='form-group field-attribute-rubrics'>
        <?php
        $rubrics = Rubric::find()->all();
        $items  = ArrayHelper::map($rubrics, 'id', 'name');
        $params = [
            'prompt' => Yii::t('app', 'Select rubric'),
        ];
        ?>
        <?= Html::label(Yii::t('app', 'Rubric'), 'Rubrics', ['class' => 'control-label']); ?>
        <?= $form->field($model, 'rubrics')->dropDownList($items, $params);
        ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Rubric */

$this->title = Yii::t('app', 'Create Rubric');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rubrics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rubric-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

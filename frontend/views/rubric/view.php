<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Rubric */

$this->title                   = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rubrics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rubric-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'tree',
            'lft',
            'rgt',
            'depth',
            'name',
        ],
    ]) ?>

</div>

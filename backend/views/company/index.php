<?php

use common\models\Rubric;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel  \common\models\Company */

$this->title                   = Yii::t('app', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Company'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'layout'       => "{sorter}\n{pager}\n{summary}\n{items}",
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'deletion_mark:boolean',
            'latitude',
            'longitude',
            'created_at',
            'updated_at',
            [
                'attribute' => 'rubrics.name',
                'label'     => Yii::t('app', 'Rubric'),
                'content'   => function ($data) {
                    $rubrics = [];
                    foreach ($data->rubrics as $rubric) {
                        $rubrics[] = $rubric->name;
                    }

                    return implode(', ', $rubrics);
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

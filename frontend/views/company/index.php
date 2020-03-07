<?php

use common\models\Rubric;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\LinkSorter;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\Company */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <?php Pjax::begin(); ?>
                <?= $this->render('_search', ['model' => $searchModel]); ?>
                <br>
                <?= LinkSorter::widget(['sort' => $dataProvider->sort]); ?>
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView'     => '_list',
                    'layout'       => "{summary}\n{items}",
                    'summary'      => 'Показано {count} из {totalCount}',
                ]); ?>
                <?= LinkPager::widget([
                    'pagination' => $dataProvider->pagination,
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
            <div class="col-xs-6 col-md-4">
                <?= Html::a('Все рубрики', ["/company"]) ?>
                <?php
                $rubrics = Rubric::find()->addOrderBy('lft')->all();
                $depth   = 0;

                foreach ($rubrics as $n => $rubric) {
                    if ($rubric->depth == $depth) {
                        echo Html::endTag('li') . "\n";
                    } elseif ($rubric->depth > $depth) {
                        echo Html::beginTag('ul') . "\n";
                    } else {
                        echo Html::endTag('li') . "\n";

                        for ($i = $depth - $rubric->depth; $i; $i--) {
                            echo Html::endTag('ul') . "\n";
                            echo Html::endTag('li') . "\n";
                        }
                    }

                    echo Html::beginTag('li');
                    echo Html::a($rubric->name, ["index?Company[rubric_id]=" . $rubric->id]);
                    $depth = $rubric->depth;
                }

                for ($i = $depth; $i; $i--) {
                    echo Html::endTag('li') . "\n";
                    echo Html::endTag('ul') . "\n";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php

use common\models\Rubric;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\LinkSorter;
use yii\widgets\ListView;
use yii\widgets\Menu;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Companies');
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
                <?= yii\helpers\Html::a('Все рубрики', ["/company"]) ?>
                <?= Menu::widget([
                    'options'         => ['class' => 'clearfix menu', 'id' => 'main-menu'],
                    'encodeLabels'    => false,
                    'activateParents' => true,
                    'activeCssClass'  => 'current-menu-item',
                    'items'           => Rubric::viewMenuItems(),
                ]);
                ?>
            </div>
        </div>
    </div>
</div>

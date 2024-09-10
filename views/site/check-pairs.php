<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Потребление еды в комплексе приматы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'k1_title',
                'label' => 'Вид 1',
            ],

            [
                'attribute' => 'k2_title',
                'label' => 'Вид 2',
            ],
            [

                'attribute' => 'room_title',
                'label' => 'Название помещения ',
            ]
        ]
    ]); ?>

    <?php Pjax::end(); ?>
    <?= Html::a('экспорт', ['site/export-pairs'], ['class' => 'btn  btn-success', 'download' => true]) ?>
</div>
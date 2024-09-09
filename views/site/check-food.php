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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'КОличество еды',
                'value' => 'quantity_of_food',
            ],
            [

                'value' => 'title',
                'label' => 'Комплекс ',
            ]
        ]
    ]); ?>

    <?php Pjax::end(); ?>
    <?= Html::a('экспорт', ['site/export-food'], ['class' => 'btn  btn-success', 'download' => true]) ?>
</div>
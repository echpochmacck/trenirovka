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
                'label' => 'Пары',
                'value' => 'title',
            ],
            [

                'value' => 'room_title',
                'label' => 'Название помещения ',
            ]
        ]
    ]); ?>

    <?php Pjax::end(); ?>
    <?= Html::a('экспорт', ['site/export-pairs'], ['class' => 'btn  btn-success', 'download' => true]) ?>
</div>
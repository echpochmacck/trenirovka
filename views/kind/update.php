<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\kind $model */

$this->title = 'Обновиьь Вид: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Kinds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kind-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

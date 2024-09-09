<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\kind $model */

$this->title = 'Добавить Вид';
$this->params['breadcrumbs'][] = ['label' => 'Kinds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kind-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

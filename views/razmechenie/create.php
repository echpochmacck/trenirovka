<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Razmechenie $model */

$this->title = 'Создаь Размещение';
$this->params['breadcrumbs'][] = ['label' => 'Razmechenies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="razmechenie-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

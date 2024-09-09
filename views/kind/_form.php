<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\kind $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="kind-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'korm_per_day')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'family')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'continent')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Razmechenie $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="razmechenie-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'kind_id')->textInput() ?>

    <?= $form->field($model, 'room_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

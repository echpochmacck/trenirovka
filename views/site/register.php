<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var ActiveForm $form */
?>
<div class="site-register">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'surname')->textInput() ?>
    <?= $form->field($model, 'patronymic')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'login')->textInput() ?>
    <div class="passord-block">
        <?= $form->field($model, 'password')->textInput(['id' => 'registerform-password']) ?>
        <div class="password-info"></div>
    </div>
    <?= $form->field($model, 'phone')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-register -->

<?php $this->registerJsFile('js/script.js', ['depends'=>'yii\bootstrap5\BootstrapAsset'])?>
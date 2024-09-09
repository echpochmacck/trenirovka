<?php

use yii\bootstrap5\Html;

?>

<?php if (Yii::$app->user->isGuest): ?>
    НАдо войти в систему чтобы пользоваться функциями
<?php else: ?>
    <div class='my-2'> <?= Html::a('суточное потребление в комплексе приматы', 'site/check-food', ['class' => 'btn btn-primary']) ?></div>
    <div class='my-2'> <?= Html::a('Случаи карлика без воды', 'site/karlik', ['class' => 'btn btn-primary']) ?></div>
    <div class='my-2'> <?= Html::a('Случаи карлика без воды', 'site/dog', ['class' => 'btn btn-primary']) ?></div>
    <div class='my-2'> <?= Html::a('Посмотреть пары', 'site/pairs', ['class' => 'btn btn-primary']) ?></div>
    <div class="my-3">

        <div class='my-2'> <?= Html::a('Упавление Пользователями', 'user/', ['class' => 'btn btn-primary']) ?></div>
        <div class='my-2'> <?= Html::a('Упавление Размещением', 'razmechenie/', ['class' => 'btn btn-primary']) ?></div>
        <div class='my-2'> <?= Html::a('Упавление Помещениями', 'room/', ['class' => 'btn btn-primary']) ?></div>
        <div class='my-2'> <?= Html::a('Упавление Видами', 'kind/', ['class' => 'btn btn-primary']) ?></div>
    </div>



<?php endif ?>
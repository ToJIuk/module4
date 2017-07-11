<?php

use yii\helpers\Html;

$session = Yii::$app->session;
$session->set('countnow', rand(0, 5));
$session->set('countall', $session['countnow']+$session['countall']);
?>

<?php if (!empty($page)): ?>
        <div class="col-lg-8">
            <h1><?= $page->name ?></h1><hr>
        </div>
        <div class="col-lg-8">
            <p><?= Html::img($page->img) ?></p><br>
            <p><?= $page->text ?></p><hr>
        </div>

        <div class="col-lg-8">
            <?= "Наблюдают: {$session['countnow']} <br> Всего просмотров: {$session['countall']}"?>
         </div>
<?php endif; ?>

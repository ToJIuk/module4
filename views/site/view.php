<?php

use yii\helpers\Html;
use yii\helpers\Url;

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

            <?php if (Yii::$app->user->isGuest && $page->analityc) { ?>
                <p><?= $page->description ?></p><p><b>Для доступа к полному тексту необходима авторизация</b></p><hr>
            <?php }else { ?>
                <p><?= $page->text ?></p><hr>
            <?php } ?>
        </div>

        <div class="col-lg-8">
            Теги:
            <a href="<?=Url::to(['site/list', 'id' => $page->tags1])?>"><?= $page->tags1 ?></a>,
            <a href="<?=Url::to(['site/list', 'id' => $page->tags2])?>"><?= $page->tags2 ?></a>
            <hr>
        </div>

        <div class="col-lg-8">
            <?= "Наблюдают: {$session['countnow']} <br> Всего просмотров: {$session['countall']}"?>
         </div>
<?php endif; ?>

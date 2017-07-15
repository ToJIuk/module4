<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;

$session = Yii::$app->session;
$now = rand(1, 5);
$session->set('countall', $session['countall'] ? $now + $session['countall']: $now);

?>

<div class="row">

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
            <?= "Наблюдают: {$now} <br> Всего просмотров: {$session['countall']} <hr>"?>
         </div>
<?php endif; ?>
</div>
<h2>Комментарии</h2><hr>

<div class="row">
    <div class="col-lg-4">

        <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal',
                 'data' => ['pjax' => true]],]); ?>

        <?= $form->field($model, 'text')->label('Текст сообщения') ?>

        <?php if (!\Yii::$app->user->isGuest){ ?>
            <div class="form-group">
                <?= Html::submitButton('Добавить комментарий', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div> <?php }else {echo "Для добавления комментариев необходима авторизация";} ?>

        <?php ActiveForm::end(); ?>
    <?php if ($page->category == 'Политика'){
        echo "Комментарии будут добавлены после проверки администратором!";
    }?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-8">
        <?php foreach ($comments as $com): ?>
         <?= "{$com->id}.<b>{$com->username}</b>: \"{$com->text}\" __ <sub>{$com->date}</sub>" ?>
            <button>+</button><button>-</button><br>
        <?php endforeach;?>
        <?= LinkPager::widget(['pagination' => $post]) ?>
    </div>
</div>



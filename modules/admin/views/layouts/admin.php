<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use yii\widgets\Pjax;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody(); ?>
<?php Pjax::begin();?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Module4',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            Yii::$app->user->isGuest ? (
                ['label' => 'Вход', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выход (' . Yii::$app->user->identity->name . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();

    ?>
     <div class="container">

        <div class="row">
            <div class="col-lg-2" ">
            <div class="sidebar" id="sidebar">
                <ul class="nav nav-list">
                    <li class="active">
                        <a href="/admin/default"><i class="icon-question"></i>
                        <span class="menu-text">Новости</span></a>
                    </li>
                    <li>
                        <a href="/admin/comments"><i class="icon-question"></i>
                            <span class="menu-text">Комментарии</span></a>
                    </li>
                    <li>
                        <a href="/admin/reclame"><i class="icon-question"></i>
                            <span class="menu-text">Реклама</span></a>
                    </li>
                    <li>
                        <a href="/admin/color/body"><i class="icon-question"></i>
                            <span class="menu-text">Цвет фона</span></a>
                    </li>

                </ul>
            </div>
            </div>

            <div class="col-lg-8"> <?= $content ?> </div>
        </div>
    </div>
</div>
<?php
$this->registerJs("
    window.onbeforeunload = function() {
        return \"Вы действительно хотите покинуть сайт?\";
        };
", \yii\web\View::POS_END); ?>

<?php Pjax::end(); ?>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; by ToJIuk <?= date('Y') ?></p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

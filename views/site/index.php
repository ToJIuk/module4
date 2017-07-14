<?php
use yii\bootstrap\Carousel;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Module4';
?>

    <?php
    echo Carousel::widget([
        'items' => [
            [
                'content' => Html::img($dataanalitic[0]->img),
                'caption' => '<h1>' . $dataanalitic[0]->name . '</h1>',
                'options' => []
            ],
            [
                'content' => Html::img($dataanalitic[1]->img),
                'caption' => '<h1>' . $dataanalitic[1]->name . '</h1>',
                'options' => []
            ],
            [
                'content' => Html::img($dataanalitic[2]->img),
                'caption' => '<h1>' . $dataanalitic[2]->name . '</h1>',
                'options' => []
            ]
        ],
        'options' => [
            'class' => 'col-lg-8',
            'style' => 'auto;' // Задаем ширину контейнера
        ]
    ]);
    ?>


            <div class="col-lg-8">
                <?php if (!empty($datasport)): ?>
                    <h2><a href="<?= Url::to(['site/sport']) ?>">Спорт</a> </h2>

                    <?php foreach ($datasport as $i): ?>
                        <p><a href="<?=Url::to(['site/view', 'id' => $i->id])?>"><?= $i->name ?></a></p>
                    <?php endforeach; ?>
                <?php endif; ?>
                <hr>
            </div>
            <div class="col-lg-8">
                <?php if (!empty($datapolitic)): ?>
                    <h2><a href="<?= Url::to(['site/politic']) ?>">Политика</a> </h2>

                    <?php foreach ($datapolitic as $i): ?>
                        <p><a href="<?=Url::to(['site/view', 'id' => $i->id])?>"><?= $i->name ?></a></p>
                    <?php endforeach; ?>
                <?php endif; ?>
                <hr>

            </div>
            <div class="col-lg-8">
                <?php if (!empty($dataanalitic)): ?>
                    <h2><a href="<?= Url::to(['site/analitic']) ?>">Аналитика</a> </h2>

                    <?php foreach ($dataanalitic as $i): ?>
                        <p><a href="<?=Url::to(['site/view', 'id' => $i->id])?>"><?= $i->name ?></a></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>


            <div class="col-lg-8">
                <hr>
                <h2>Топ 5 комментаторов:</h2>
                <?php foreach ($comments as $com): ?>
                <span><a href="<?=Url::to(['site/commentator', 'id' => $com->username])?>"><?= $com->username?></a></span>
                <?php endforeach; ?>
            </div>

            <div class="col-lg-8">
                <hr>
                <h2>Топ 3 активных темы:</h2>
                <?php foreach ($top3 as $com): ?>
                    <span><a href="<?=Url::to(['site/view', 'id' => $com->subject])?>"><?= $com->subject?></a></span>
                <?php endforeach; ?>
            </div>


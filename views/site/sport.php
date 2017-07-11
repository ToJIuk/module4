<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
    <h1>Спорт</h1>
    <hr>
        <?php foreach ($pages as $p): ?>
            <h4><a href="<?=Url::to(['site/view', 'id' => $p->id])?>"><?= $p->name ?></a></h4>
            <br>
        <?php endforeach; ?>

<?= LinkPager::widget(['pagination' => $post]) ?>
<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
    <h1>Спорт</h1>
    <hr>
        <?php foreach ($pages as $p): ?>
            <h3 class="panel-title"><a href="<?=Url::to(['site/view', 'id' => $p->id])?>"><?= $p->name ?></a></h3>
            <br>
        <?php endforeach; ?>

<?= LinkPager::widget(['pagination' => $post]) ?>
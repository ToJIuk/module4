<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
    <h1>Результат поиска:</h1>
    <hr>
<?php foreach ($page as $p): ?>
    <h4><a href="<?=Url::to(['site/view', 'id' => $p->id])?>"><?= $p->name ?></a></h4>
    <br>
<?php endforeach; ?>

<?= LinkPager::widget(['pagination' => $pages]) ?>
<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
    <h2>Список похожих новостей:</h2><hr>
<?php foreach ($pages as $p): ?>
    <h4><a href="<?=Url::to(['site/view', 'id' => $p->id])?>"><?= $p->name ?></a></h4>
    <br>
<?php endforeach; ?>

<?= LinkPager::widget(['pagination' => $post]) ?>
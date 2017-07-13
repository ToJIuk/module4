<?php
use yii\widgets\LinkPager;
?>
    <h2>Список комментариев пользователя <?= $comments[0]['username']?>:</h2><hr>

<?php foreach ($comments as $com): ?>
    <p><?= "{$com->id}.<b>{$com->username}</b>: \"{$com->text}\" __ <sub>{$com->date}</sub><br>" ?></p>
<?php endforeach;?>
<?= LinkPager::widget(['pagination' => $post]) ?>

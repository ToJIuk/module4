<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $dataProvider1 yii\data\ActiveDataProvider */


$this->title = 'Редактирование комментариев';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Создать комментарий', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'text:ntext',
            'count',
            'subject',
             'date',
             'display',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<hr>
    <h2>Комментарии, ожидающие одобрения</h2>
    <p>Для того, чтобы комментарий отображался на странице необходимо в поле "display" установить 1</p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider1,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'text:ntext',
            'count',
            'subject',
            'date',
            'display',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

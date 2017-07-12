<h1>Регистрация</h1><hr>
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>


<div class="row">
    <div class="col-lg-4">

        <?php $form = ActiveForm::begin(['class' => 'form-horizontal']); ?>

        <?= $form->field($model, 'name')->label('Имя')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'email')->label('Еmail') ?>

        <?= $form->field($model, 'password')->label('Пароль')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

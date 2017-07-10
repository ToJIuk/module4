<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Slider!</h1>
    </div>

    <div class="body-content">


        <?php if (!empty($data)): ?>
            <?php foreach ($data as $i): ?>

        <div class="row">
            <div class="col-lg-8">
                <h2><?= $i->id ?></h2>

            </div>
            <div class="col-lg-8">
                <h2>Heading</h2>

            </div>
            <div class="col-lg-8">
                <h2>Heading</h2>

            </div>

        </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>
</div>

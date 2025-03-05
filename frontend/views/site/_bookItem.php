<?php

/** @var common\models\Book $model */

use yii\helpers\Html;

?>
<div class="book-item">
    <h3><?= Html::encode($model->title) ?></h3>
    <p>Author: <?= Html::encode($model->author) ?></p>
    <p><?= Html::encode($model->description) ?></p>
</div>

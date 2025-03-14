<?php

/** @var common\models\BookCopy $model */

use yii\helpers\Html;
/**use Yii;*/
?>
<div class="listing-item">
    <h3><?= Html::encode($model->book->title) ?></h3>
    <p>
        <img src="<?= Yii::getAlias('@web') . '/' . ($model->image ? $model->image : 'uploads/default.jpg') ?>" class="img-responsive img-fixed-size" alt="<?= Html::encode($model->book->title) ?>">
    </p>
    <p>Author: <?= Html::encode($model->book->author) ?></p>
    <p class="listing-footer">
        <a class="btn btn-default" href="#">View &raquo;</a>
        <span class="price"><?= Html::encode($model->price) ?> BGN</span>
    </p>
</div>

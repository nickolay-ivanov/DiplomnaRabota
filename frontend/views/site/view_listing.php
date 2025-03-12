<?php

/** @var yii\web\View $this */
/** @var common\models\BookCopy $model */

use yii\helpers\Html;

$this->title = $model->book->title;
$this->params['breadcrumbs'][] = ['label' => 'Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-view-listing">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <img src="<?= Html::encode(Yii::getAlias('@web') . '/' . ($model->image ? $model->image : 'uploads/default.jpg')) ?>" class="img-responsive img-fixed-size" alt="<?= Html::encode($model->book->title) ?>">
    </p>
    <p>Author: <?= Html::encode($model->book->author) ?></p>
    <p>Price: <?= Html::encode($model->price) ?> BGN</p>
</div>

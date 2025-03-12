<?php

/** @var yii\web\View $this */
/** @var string $username */
/** @var common\models\BookCopy[] $listings */

use yii\helpers\Html;

$this->title = Html::encode($username) . "'s Listings";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-user-listings">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="latest-listings-box">
        <?php foreach ($listings as $listing): ?>
            <div class="listing-item">
                <h3><?= Html::encode($listing->book->title) ?></h3>
                <p>
                    <img src="<?= Yii::getAlias('@web') . '/' . ($listing->image ? $listing->image : 'uploads/default.jpg') ?>" class="img-responsive img-fixed-size" alt="<?= Html::encode($listing->book->title) ?>">
                </p>
                <p>Author: <?= Html::encode($listing->book->author) ?></p>
                <p class="listing-footer">
                    <a class="btn btn-default" href="#">View &raquo;</a>
                    <span class="price"><?= Html::encode($listing->price) ?> BGN</span>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.latest-listings-box {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: repeat(3, auto);
    gap: 20px;
    border: 1px solid #ddd;
    padding: 15px;
    margin-top: 20px;
    background-color: #f9f9f9;
}

.listing-item {
    border: 1px solid #ddd;
    padding: 10px;
    background-color: #fff;
    text-align: center;
}

.img-fixed-size {
    width: 200px;
    height: 250px;
    object-fit: cover;
}

.listing-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.price {
    font-weight: bold;
    color: #333;
}
</style>

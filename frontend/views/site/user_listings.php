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
            <div class="col-lg-12 col-md-4 col-sm-6">
                <?= $this->render('_listing_item', ['model' => $listing]) ?>
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

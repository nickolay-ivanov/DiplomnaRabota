<?php

/** @var yii\web\View $this */
/** @var frontend\models\SearchForm $searchModel */
/** @var common\models\BookCopy[] $latestListings */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'BookStore';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to BookStore!</h1>
        <p class="lead">Find your favorite books or list your own.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <?php $form = ActiveForm::begin([
                    'action' => ['search'],
                    'method' => 'get',
                ]); ?>

                <?= $form->field($searchModel, 'query')->textInput(['placeholder' => 'Search by author or book name'])->label(false) ?>

                <div class="form-group">
                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h2>Latest Listings</h2>
                <div class="latest-listings-box">
                    <?php foreach ($latestListings as $listing): ?>
                        <div class="col-lg-12 col-md-4 col-sm-6">
                            <?= $this->render('_listing_item', ['model' => $listing]) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

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

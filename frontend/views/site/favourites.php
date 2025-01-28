<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Favourites';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-favourites">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <h2>Favorited Books</h2>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">Book 1</a>
                <a href="#" class="list-group-item list-group-item-action">Book 2</a>
                <a href="#" class="list-group-item list-group-item-action">Book 3</a>
            </div>
        </div>
        <div class="col-lg-6">
            <h2>Favorited Listings</h2>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">Listing 1</a>
                <a href="#" class="list-group-item list-group-item-action">Listing 2</a>
                <a href="#" class="list-group-item list-group-item-action">Listing 3</a>
            </div>
        </div>
    </div>
</div>

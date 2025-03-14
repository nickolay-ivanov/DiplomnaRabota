<?php

/** @var yii\web\View $this */
/** @var common\models\Wishlist[] $listings */

use yii\helpers\Html;

$this->title = 'Favourites';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-favourites">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <?php foreach ($listings as $listing): ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <?= $this->render('_listing_item', ['model' => $listing->bookCopy]) ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

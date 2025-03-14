<?php

/** @var yii\web\View $this */
/** @var common\models\BookCopy[] $listings */

use yii\helpers\Html;

$this->title = 'Admin Panel';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-admin-panel">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php foreach ($listings as $listing): ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <?= $this->render('_listing_item', ['model' => $listing]) ?>
                <div class="admin-actions">
                    <?= Html::a('Edit', ['edit-listing', 'id' => $listing->id], ['class' => 'btn btn-primary btn-sm']) ?>
                    <?= Html::a('Delete', ['delete-listing', 'id' => $listing->id], [
                        'class' => 'btn btn-danger btn-sm',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this listing?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

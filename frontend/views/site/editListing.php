<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\CreateListingForm $model */
/** @var array $categories */
/** @var common\models\BookCopy $listing */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Edit Listing';
$this->params['breadcrumbs'][] = ['label' => 'Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-edit-listing">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Update the form below to edit the listing:</p>

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
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'edit-listing-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                <div class="form-group">
                    <label>Current Image</label>
                    <div>
                        <img src="<?= Yii::getAlias('@web') . '/' . ($listing->image ? $listing->image : 'uploads/default.jpg') ?>" class="img-responsive img-fixed-size" alt="<?= Html::encode($listing->book->title) ?>">
                    </div>
                </div>

                <?= $form->field($model, 'image')->fileInput() ?>

                <?= $form->field($model, 'title')->textInput(['autofocus' => true, 'value' => $listing->book->title]) ?>

                <?= $form->field($model, 'condition')->dropDownList([
                    'new' => 'New',
                    'used' => 'Used',
                ], ['value' => $listing->book_condition]) ?>

                <?= $form->field($model, 'price')->input('number', ['min' => 0, 'step' => '0.01', 'value' => $listing->price]) ?>

                <?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => 'Select Category', 'options' => [$listing->book->category_id => ['Selected' => true]]]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Update Listing', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

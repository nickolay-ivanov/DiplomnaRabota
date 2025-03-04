<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\CreateListingForm $model */
/** @var array $categories */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Create a Listing';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-create-listing">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Fill out the form below to create a new listing:</p>

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
            <?php $form = ActiveForm::begin(['id' => 'create-listing-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'image')->fileInput() ?>

                <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'condition')->dropDownList([
                    'new' => 'New',
                    'used' => 'Used',
                ]) ?>

                <?= $form->field($model, 'price')->input('number', ['min' => 0, 'step' => '0.01']) ?>

                <?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => 'Select Category']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Create Listing', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

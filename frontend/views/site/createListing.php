<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\CreateListingForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Create a Listing';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-create-listing">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Fill out the form below to create a new listing:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'create-listing-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'image')->fileInput() ?>

                <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'condition')->dropDownList([
                    'New' => 'New',
                    'Like New' => 'Like New',
                    'Good' => 'Good',
                    'Fair' => 'Fair',
                    'Poor' => 'Poor',
                ]) ?>

                <?= $form->field($model, 'price')->input('number', ['min' => 0, 'step' => '0.01']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Create Listing', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

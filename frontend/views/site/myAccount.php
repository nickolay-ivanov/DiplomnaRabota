<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\MyAccountForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'My Account';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-my-account">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Update your account details:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'my-account-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'profilePicture')->fileInput() ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email')->input('email') ?>

                <?= $form->field($model, 'name')->textInput() ?>

                <?= $form->field($model, 'bio')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'confirmPassword')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

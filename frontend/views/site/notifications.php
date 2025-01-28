<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Notifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-notifications">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action">You have a new message</a>
        <a href="#" class="list-group-item list-group-item-action">The listing you favourited was sold</a>
        <a href="#" class="list-group-item list-group-item-action">Your profile was updated successfully</a>
    </div>
</div>

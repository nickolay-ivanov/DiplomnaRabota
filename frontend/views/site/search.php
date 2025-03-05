<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var frontend\models\SearchForm $searchModel */

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Search Results';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-search">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_bookItem',
    ]); ?>
</div>

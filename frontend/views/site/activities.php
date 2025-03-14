<?php

/** @var yii\web\View $this */
/** @var common\models\Activity[] $activities */

use yii\helpers\Html;

$this->title = 'Activities';
$this->params['breadcrumbs'][] = $this->title;

function getActivityMessage($activityType) {
    $messages = [
        'message_received' => 'You received a message',
        'listing_removed' => 'You removed a listing successfully',
        'book_added' => 'You added a listing successfully',
        'book_updated' => 'You updated a listing successfully',
        'profile_updated' => 'You updated your profile successfully',
        'profile_verified' => 'You verified your profile successfully',
    ];
    return $messages[$activityType] ?? 'Unknown activity';
}
?>
<div class="site-activities">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="list-group">
        <?php foreach ($activities as $activity): ?>
            <a href="#" class="list-group-item list-group-item-action">
                <?= Html::encode(getActivityMessage($activity->activity_type)) ?> at <?= Html::encode($activity->created_at) ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

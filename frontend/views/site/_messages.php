<?php foreach ($messages as $message): ?>
    <div class="chat-message">
        <strong><?= $message->sender_id == Yii::$app->user->id ? 'You' : Html::encode($message->sender->username) ?>:</strong> <?= Html::encode($message->message) ?>
    </div>
<?php endforeach; ?>

<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;

$this->title = 'Chat Room';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-chat">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-4">
            <div class="list-group">
                <?php foreach ($users as $user): ?>
                    <a href="<?= Url::to(['site/chat', 'receiver_id' => $user->id]) ?>" class="list-group-item list-group-item-action <?= $user->id == $receiver_id ? 'active' : '' ?>">
                        <?= Html::encode($user->username) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <?php if ($receiver): ?>
                        Chat with <?= Html::encode($receiver->username) ?>
                    <?php else: ?>
                        Select a user to start chatting
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="chat-box" id="chat-box">
                        <?php if (empty($messages)): ?>
                            <p>No messages yet</p>
                        <?php else: ?>
                            <?php foreach ($messages as $message): ?>
                                <div class="chat-message">
                                    <strong><?= $message->sender_id == Yii::$app->user->id ? 'You' : Html::encode($message->sender->username) ?>:</strong> <?= Html::encode($message->message) ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($receiver): ?>
                <div class="card-footer">
                    <form id="chat-form">
                        <div class="input-group">
                            <input type="text" class="form-control" id="chat-message" placeholder="Type a message...">
                            <button class="btn btn-primary" type="submit">Send</button>
                        </div>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if ($receiver): ?>
<?php
$sendMessageUrl = Url::to(['site/send-message', 'receiver_id' => $receiver_id]);
$loadMessagesUrl = Url::to(['site/load-messages', 'receiver_id' => $receiver_id]);
$js = <<<JS
$('#chat-form').on('submit', function(e) {
    e.preventDefault();
    var message = $('#chat-message').val();
    $.post('$sendMessageUrl', {message: message}, function(data) {
        $('#chat-message').val('');
        loadMessages();
    });
});

function loadMessages() {
    $.get('$loadMessagesUrl', function(data) {
        $('#chat-box').html(data);
    });
}

setInterval(loadMessages, 5000); // Refresh messages every 5 seconds
JS;
$this->registerJs(new JsExpression($js));
?>
<?php endif; ?>

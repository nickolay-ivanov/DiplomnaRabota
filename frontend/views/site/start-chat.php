<?php

/** @var yii\web\View $this */
/** @var common\models\User $receiver */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Start Chat with ' . Html::encode($receiver->username);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-start-chat">
    <h1><?= Html::encode($this->title) ?></h1>

    <form method="post" action="<?= Url::to(['site/start-chat', 'username' => $receiver->username]) ?>">
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
        <div class="input-group">
            <input type="text" class="form-control" name="message" placeholder="Type your first message...">
            <button class="btn btn-primary" type="submit">Send</button>
        </div>
    </form>
</div>

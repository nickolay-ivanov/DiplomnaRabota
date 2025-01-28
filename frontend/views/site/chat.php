<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Chat Room';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-chat">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-4">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">User 1</a>
                <a href="#" class="list-group-item list-group-item-action">User 2</a>
                <a href="#" class="list-group-item list-group-item-action">User 3</a>
                <a href="#" class="list-group-item list-group-item-action">User 4</a>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    Chat with User 1
                </div>
                <div class="card-body">
                    <div class="chat-box">
                        <div class="chat-message">
                            <strong>User 1:</strong> Hello!
                        </div>
                        <div class="chat-message">
                            <strong>You:</strong> Hi, how are you?
                        </div>
                        <div class="chat-message">
                            <strong>User 1:</strong> I'm good, thanks!
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Type a message...">
                            <button class="btn btn-primary" type="submit">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

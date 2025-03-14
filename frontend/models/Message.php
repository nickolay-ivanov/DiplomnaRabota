<?php
namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\User;

class Message extends ActiveRecord
{
    public static function tableName()
    {
        return 'messages';
    }

    public function rules()
    {
        return [
            [['sender_id', 'receiver_id', 'message'], 'required'],
            [['sender_id', 'receiver_id'], 'integer'],
            [['message'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    public function getSender()
    {
        return $this->hasOne(User::class, ['id' => 'sender_id']);
    }
}

<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\imagine\Image;

class MyAccountForm extends Model
{
    public $profilePicture;
    public $username;
    public $email;
    public $name;

    public function rules()
    {
        return [
            [['username', 'email', 'name'], 'string'],
            [['email'], 'email'],
            [['profilePicture'], 'file', 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function loadUserData($user)
    {
        $this->username = $user->username;
        $this->email = $user->email;
        $this->name = $user->name;
        $this->profilePicture = $user->profile_picture;
    }

    public function save()
    {
        if ($this->validate()) {
            $user = User::findOne(Yii::$app->user->id);
            $user->username = $this->username;
            $user->email = $this->email;
            $user->name = $this->name;

            $this->profilePicture = \yii\web\UploadedFile::getInstance($this, 'profilePicture');
            if ($this->profilePicture) {
                $uploadsDir = Yii::getAlias('@frontend/web/uploads');
                $filePath = $uploadsDir . '/' . uniqid() . '.' . $this->profilePicture->extension;
                if (!$this->profilePicture->saveAs($filePath)) {
                    Yii::$app->session->setFlash('error', 'Failed to upload profile picture.');
                    return false;
                }

                // resize image
                Image::thumbnail($filePath, 100, 100)
                    ->save($filePath, ['quality' => 80]);

                $user->profile_picture = 'uploads/' . basename($filePath);
            } else {
                Yii::info('No profile picture uploaded', __METHOD__);
            }

            return $user->save();
        }

        return false;
    }
}

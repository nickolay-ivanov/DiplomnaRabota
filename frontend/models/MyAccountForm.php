<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

class MyAccountForm extends Model
{
    public $profilePicture;
    public $username;
    public $email;
    public $name;
    public $bio;
    public $password;
    public $confirmPassword;

    public function rules()
    {
        return [
            [['username', 'email', 'name', 'bio'], 'string'],
            [['email'], 'email'],
            [['password', 'confirmPassword'], 'string', 'min' => 6],
            [['confirmPassword'], 'compare', 'compareAttribute' => 'password'],
            [['profilePicture'], 'file', 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            $user = User::findOne(Yii::$app->user->id);
            $user->username = $this->username;
            $user->email = $this->email;
            $user->name = $this->name;
            $user->bio = $this->bio;

            if ($this->password) {
                $user->setPassword($this->password);
            }

            if ($this->profilePicture) {
                $filePath = 'uploads/' . $this->profilePicture->baseName . '.' . $this->profilePicture->extension;
                $this->profilePicture->saveAs($filePath);
                $user->profile_picture = $filePath;
            }

            return $user->save();
        }

        return false;
    }
}

<?php

namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class CreateListingForm extends Model
{
    public $image;
    public $title;
    public $condition;
    public $price;

    public function rules()
    {
        return [
            [['title', 'condition', 'price'], 'required'],
            [['price'], 'number', 'min' => 0],
            [['title'], 'string', 'max' => 255],
            [['condition'], 'in', 'range' => ['New', 'Like New', 'Good', 'Fair', 'Poor']],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            // Save the listing to the database or perform other actions
            return true;
        }
        return false;
    }
}

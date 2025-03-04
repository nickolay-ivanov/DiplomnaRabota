<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Book extends ActiveRecord
{
    public static function tableName()
    {
        return 'books';
    }

    public function rules()
    {
        return [
            [['title', 'author', 'category_id'], 'required'],
            [['title', 'author'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['category_id'], 'integer'],
        ];
    }
}

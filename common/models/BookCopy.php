<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class BookCopy extends ActiveRecord
{
    public static function tableName()
    {
        return 'book_copies';
    }

    public function rules()
    {
        return [
            [['book_id', 'seller_id', 'price'], 'required'],
            [['book_id', 'seller_id'], 'integer'],
            [['price'], 'number'],
            [['book_condition', 'status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * Gets the related Book model.
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }
}

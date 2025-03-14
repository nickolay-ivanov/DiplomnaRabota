<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * wishlist table
 *
 * @property int $id
 * @property int $user_id
 * @property int $book_copy_id
 * @property string $added_at
 *
 * @property BookCopy $bookCopy
 * @property User $user
 */
class Wishlist extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wishlist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'book_copy_id', 'added_at'], 'required'],
            [['user_id', 'book_copy_id'], 'integer'],
            [['added_at'], 'safe'],
            [['book_copy_id'], 'exist', 'skipOnError' => true, 'targetClass' => BookCopy::class, 'targetAttribute' => ['book_copy_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * Gets query for [[BookCopy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookCopy()
    {
        return $this->hasOne(BookCopy::class, ['id' => 'book_copy_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}

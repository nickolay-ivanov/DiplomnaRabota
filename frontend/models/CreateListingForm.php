<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Book;
use common\models\BookCopy;
use common\models\Category;

class CreateListingForm extends Model
{
    public $image;
    public $title;
    public $condition;
    public $price;
    public $category_id;

    public function rules()
    {
        return [
            [['title', 'condition', 'price', 'category_id'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['condition'], 'in', 'range' => ['new', 'used']],
            [['price'], 'number', 'min' => 0],
            [['category_id'], 'integer'],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            // Check if category exists
            $category = Category::findOne($this->category_id);
            if (!$category) {
                Yii::$app->session->setFlash('error', 'Category does not exist.');
                return false;
            }

            // Capitalize each word in title
            $this->title = ucwords(strtolower($this->title));

            // Check if  book already exists
            $book = Book::findOne(['title' => $this->title]);
            if (!$book) {
                $book = new Book();
                $book->title = $this->title;
                $book->author = 'Unknown'; // TBD
                $book->category_id = $category->id;
                if (!$book->save()) {
                    Yii::$app->session->setFlash('error', 'Failed to save book.');
                    return false;
                }
            }

            // Create book copy
            $bookCopy = new BookCopy();
            $bookCopy->book_id = $book->id;
            $bookCopy->seller_id = Yii::$app->user->id;
            $bookCopy->price = $this->price;
            $bookCopy->book_condition = strtolower($this->condition);

            $filePath = null;
            $this->image = \yii\web\UploadedFile::getInstance($this, 'image');
            if ($this->image) {
                $filePath = $uploadsDir . '/' . uniqid() . '.' . $this->image->extension;
                if (!$this->image->saveAs($filePath)) {
                    Yii::$app->session->setFlash('error', 'Failed to upload image.');
                    return false;
                }
                $bookCopy->image = 'uploads/' . basename($filePath);
            } else {
                Yii::info('No image uploaded', __METHOD__);
            }

            if ($bookCopy->save()) {
                return $filePath;
            } else {
                Yii::$app->session->setFlash('error', 'Failed to save book copy.');
            }
        }
        return false;
    }
}

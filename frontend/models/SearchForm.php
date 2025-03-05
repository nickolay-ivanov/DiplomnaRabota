<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Book;

class SearchForm extends Model
{
    public $query;

    public function rules()
    {
        return [
            [['query'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Book::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'title', $this->query])
              ->orFilterWhere(['like', 'author', $this->query]);

        return $dataProvider;
    }
}

<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "activities".
 *
 * @property int $id
 * @property int $user_id
 * @property string $activity_type
 * @property string $created_at
 */
class Activity extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'activity_type'], 'required'],
            [['user_id'], 'integer'],
            [['activity_type'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'activity_type' => 'Activity Type',
            'created_at' => 'Created At',
        ];
    }
}

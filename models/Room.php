<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property int $id
 * @property string $title
 * @property int $number
 * @property int $is_water
 * @property int $is_hot
 *
 * @property Razmechenie[] $razmechenies
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'number', 'is_water', 'is_hot'], 'required'],
            [['number', 'is_water', 'is_hot'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'number' => 'Номер помещения',
            'is_water' => 'Наличие водоема',
            'is_hot' => 'Наличие Тепла',
        ];
    }

    /**
     * Gets query for [[Razmechenies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRazmechenies()
    {
        return $this->hasMany(Razmechenie::class, ['room_id' => 'id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kind".
 *
 * @property int $id
 * @property float $korm_per_day
 * @property string $title
 * @property string $family
 * @property string $continent
 *
 * @property Razmechenie[] $razmechenies
 */
class Kind extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kind';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['korm_per_day', 'title', 'family', 'continent'], 'required'],
            [['korm_per_day'], 'number'],
            [['title', 'family', 'continent'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'korm_per_day' => 'Корм',
            'title' => 'Название',
            'family' => 'Семейство',
            'continent' => 'Континент родина',
        ];
    }

    /**
     * Gets query for [[Razmechenies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRazmechenies()
    {
        return $this->hasMany(Razmechenie::class, ['kind_id' => 'id']);
    }
}

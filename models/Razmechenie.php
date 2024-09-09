<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "razmechenie".
 *
 * @property int $id
 * @property int $quantity
 * @property int $kind_id
 * @property int $room_id
 *
 * @property Kind $kind
 * @property Room $room
 */
class Razmechenie extends \yii\db\ActiveRecord
{

    
    public $kind_title;
    public $room_title;
    public $room_quantity;
    public $is_water;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'razmechenie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantity', 'kind_id', 'room_id'], 'required'],
            [['quantity', 'kind_id', 'room_id'], 'integer'],
            [['kind_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kind::class, 'targetAttribute' => ['kind_id' => 'id']],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::class, 'targetAttribute' => ['room_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'quantity' => 'Количество животных',
            'kind_id' => 'Kind ID',
            'room_id' => 'Room ID',
        ];
    }

    /**
     * Gets query for [[Kind]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKind()
    {
        return $this->hasOne(Kind::class, ['id' => 'kind_id']);
    }

    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::class, ['id' => 'room_id']);
    }

    public static function queryFood()
    {
        $query = (new Query())
            ->from('razmechenie')
            ->select(
                [
                    'sum(korm_per_day * razmechenie.quantity) as quantity_of_food',
                    'room.title as title'
                ]
            )
            ->innerJoin('kind', 'razmechenie.kind_id = kind.id')
            ->innerJoin('room', 'razmechenie.room_id = room.id')
            ->groupBy(['razmechenie.room_id'])
            ->where(['room.title' => 'приматы']);
        return $query;
    }

    public static function queryKarlik()
    {
        $query = (new Query())
            ->from('razmechenie')
            ->select(
                [
                    'kind.title as kind_title',
                    'room.title as room_title',
                    'razmechenie.quantity as room_quantity',
                    'room.is_water as is_water',
                ]
            )
            ->innerJoin('kind', 'razmechenie.kind_id = kind.id')
            ->innerJoin('room', 'razmechenie.room_id = room.id')
            ->where(['room.is_water' => 0])
            ->andwhere(['kind.title' => 'карликовыйгипопатам']);
        return $query;
    }

    public static function queryDOg()
    {
        $query = (new Query())
            ->from('razmechenie')
            ->select(
                [
                    'kind.family as kind_title',
                    'SUM(razmechenie.quantity) as quantity',
                ]
            )
            ->innerJoin('kind', 'razmechenie.kind_id = kind.id')
            ->where(['kind.family' => 'псовые'])
            ->groupBy(['kind.family']);
        return $query;
    }

    public static function queryPairs()
    {
        $query = (new Query())
            ->from('razmechenie')
            ->select(
                [
                    'CONCAT(k1.title, "-", k2.title) as title',
                    'room.title as room_title',
                ]
            )
            ->innerJoin('room', 'razmechenie.room_id = room.id')
            ->innerJoin(['k1' => 'kind'], 'razmechenie.kind_id = k1.id')
            ->innerJoin(['r1' => 'razmechenie'], 'r1.room_id = room.id')
            ->innerJoin(['k2' => 'kind'], 'r1.kind_id = k2.id')
            ->where('k1.id > k2.id')
            ;
        return $query;
    }
}

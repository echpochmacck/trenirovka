<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Razmechenie;

/**
 * RazmechenieSearch represents the model behind the search form of `app\models\Razmechenie`.
 */
class RazmechenieSearch extends Razmechenie
{

    public $kind_title;
    public $room_title;
    public $room_quantity;
    public $is_water;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'quantity', 'kind_id', 'room_id'], 'integer'],
            [['kind_title', 'room_title', 'room_quantity', 'is_water'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Razmechenie::find()
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
            ->andwhere(['kind.title' => 'карликовыйгипопатам']);;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {

            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'quantity' => $this->quantity,
            'kind_id' => $this->kind_id,
            'room_id' => $this->room_id
        ])
        ->andFilterWhere(['like', 'kind.title',  $this->kind_title])
        ->andFilterWhere(['like', 'room.title',  $this->room_title])
        ->andFilterWhere(['like', 'razmechenie.quantity', $this->room_quantity])
        ->andFilterWhere(['like', 'room.is_water', $this->is_water])



        ;

        return $dataProvider;
    }
}

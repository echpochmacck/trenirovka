<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Razmechenie;

/**
 * PairsSearch represents the model behind the search form of `app\models\Razmechenie`.
 */
class PairsSearch extends Razmechenie
{

    public $k1_title;
    public $k2_title;

    public $room_title;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'quantity', 'kind_id', 'room_id'], 'integer'],
            [['k1_title','k2_title', 'room_title'], 'safe'],
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
                'room.title as room_title',
                'k1.title as k1_title',
                'k2.title as k2_title',
            ]
        )
        ->innerJoin('room', 'razmechenie.room_id = room.id')
        ->innerJoin(['k1' => 'kind'], 'razmechenie.kind_id = k1.id')
        ->innerJoin(['r1' => 'razmechenie'], 'r1.room_id = room.id')
        ->innerJoin(['k2' => 'kind'], 'r1.kind_id = k2.id')
        ->where('k1.id > k2.id')
        ;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'quantity' => $this->quantity,
            'kind_id' => $this->kind_id,
            'room_id' => $this->room_id,
        ])
        ->andFilterWhere(['like', 'room.title', $this->room_title])
        ->andFilterWhere(['like', 'k1.title', $this->k1_title])
        ->andFilterWhere(['like', 'k2.title', $this->k2_title])


        ;

        return $dataProvider;
    }
}
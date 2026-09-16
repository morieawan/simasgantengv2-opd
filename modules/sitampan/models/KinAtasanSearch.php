<?php

namespace app\modules\sitampan\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\sitampan\models\KinAtasan;

/**
 * KinAtasanSearch represents the model behind the search form of `app\modules\sitampan\models\KinAtasan`.
 */
class KinAtasanSearch extends KinAtasan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nip', 'nama', 'tablok', 'tablokb', 'nip_atasan', 'nama_atasan', 'tablok_atasan', 'tablokb_atasan', 'updated'], 'safe'],
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
        $query = KinAtasan::find();

        // add conditions that should always apply here

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
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['ilike', 'nip', $this->nip])
            ->andFilterWhere(['ilike', 'nama', $this->nama])
            ->andFilterWhere(['ilike', 'tablok', $this->tablok])
            ->andFilterWhere(['ilike', 'tablokb', $this->tablokb])
            ->andFilterWhere(['ilike', 'nip_atasan', $this->nip_atasan])
            ->andFilterWhere(['ilike', 'nama_atasan', $this->nama_atasan])
            ->andFilterWhere(['ilike', 'tablok_atasan', $this->tablok_atasan])
            ->andFilterWhere(['ilike', 'tablokb_atasan', $this->tablokb_atasan]);

        return $dataProvider;
    }
}

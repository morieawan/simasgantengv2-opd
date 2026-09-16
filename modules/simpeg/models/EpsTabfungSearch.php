<?php

namespace app\modules\simpeg\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\simpeg\models\EpsTabfung;

/**
 * EpsTabfungSearch represents the model behind the search form of `app\modules\simpeg\models\EpsTabfung`.
 */
class EpsTabfungSearch extends EpsTabfung
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['KODE', 'FUNGSI', 'ESEL', 'KGOL'], 'safe'],
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
        $query = EpsTabfung::find();

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
        $query->andFilterWhere(['ilike', 'KODE', $this->KODE])
            ->andFilterWhere(['ilike', 'FUNGSI', $this->FUNGSI])
            ->andFilterWhere(['ilike', 'ESEL', $this->ESEL])
            ->andFilterWhere(['ilike', 'KGOL', $this->KGOL]);

        return $dataProvider;
    }
}

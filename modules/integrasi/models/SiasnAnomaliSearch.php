<?php

namespace app\modules\integrasi\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\integrasi\models\SiasnAnomali;

/**
 * SiasnAnomaliSearch represents the model behind the search form of `app\modules\integrasi\models\SiasnAnomali`.
 */
class SiasnAnomaliSearch extends SiasnAnomali
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nipBaru', 'idPns', 'nama', 'jenisJabatanId', 'jenisJabatan', 'jabatanId', 'jabatanNama', 'unorId', 'unorIndukNama', 'unorNama', 'kedudukanPnsId', 'kedudukanPnsNama', 'simpeg', 'skJabatan', 'skKP', 'updated', 'updateBy', 'verified', 'verifiedBy'], 'safe'],
            [['flag'], 'integer'],
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
        $query = SiasnAnomali::find();

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
            'nipBaru' => $this->nipBaru,
            'updated' => $this->updated,
            'verified' => $this->verified,
            'flag' => $this->flag,
        ]);

        $query
            ->andFilterWhere(['ilike', 'idPns', $this->idPns])
            ->andFilterWhere(['ilike', 'nama', $this->nama])
            ->andFilterWhere(['ilike', 'jenisJabatanId', $this->jenisJabatanId])
            ->andFilterWhere(['ilike', 'jenisJabatan', $this->jenisJabatan])
            ->andFilterWhere(['ilike', 'jabatanId', $this->jabatanId])
            ->andFilterWhere(['ilike', 'jabatanNama', $this->jabatanNama])
            ->andFilterWhere(['ilike', 'unorId', $this->unorId])
            ->andFilterWhere(['ilike', 'unorIndukNama', $this->unorIndukNama])
            ->andFilterWhere(['ilike', 'unorNama', $this->unorNama])
            ->andFilterWhere(['ilike', 'kedudukanPnsId', $this->kedudukanPnsId])
            ->andFilterWhere(['ilike', 'kedudukanPnsNama', $this->kedudukanPnsNama])
            ->andFilterWhere(['ilike', 'simpeg', $this->simpeg])
            ->andFilterWhere(['ilike', 'skJabatan', $this->skJabatan])
            ->andFilterWhere(['ilike', 'skKP', $this->skKP])
            ->andFilterWhere(['ilike', 'updateBy', $this->updateBy])
            ->andFilterWhere(['ilike', 'verifiedBy', $this->verifiedBy]);

        return $dataProvider;
    }
}

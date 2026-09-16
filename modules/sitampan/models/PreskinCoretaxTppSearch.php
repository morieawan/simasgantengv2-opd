<?php

namespace app\modules\sitampan\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\sitampan\models\PreskinCoretaxTpp;

/**
 * PreskinCoretaxTppSearch represents the model behind the search form of `app\modules\sitampan\models\PreskinCoretaxTpp`.
 */
class PreskinCoretaxTppSearch extends PreskinCoretaxTpp
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['masa_pajak', 'tahun_pajak', 'bruto', 'bruto_gaji', 'bruto_tpp', 'pph_gaji', 'pph_tpp', 'pph_total'], 'integer'],
            [['stapeg', 'nik', 'passport', 'status', 'posisi', 'fasilitas', 'kode_op', 'id_tku', 'tgl_potong', 'nip', 'nama', 'tablok'], 'safe'],
            [['tarif'], 'number'],
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
        $query = PreskinCoretaxTpp::find();

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
            'masa_pajak' => $this->masa_pajak,
            'tahun_pajak' => $this->tahun_pajak,
            'bruto' => $this->bruto,
            'tarif' => $this->tarif,
            'tgl_potong' => $this->tgl_potong,
            'bruto_gaji' => $this->bruto_gaji,
            'bruto_tpp' => $this->bruto_tpp,
            'pph_gaji' => $this->pph_gaji,
            'pph_tpp' => $this->pph_tpp,
            'pph_total' => $this->pph_total,
        ]);

        $query->andFilterWhere(['ilike', 'stapeg', $this->stapeg])
            ->andFilterWhere(['ilike', 'nik', $this->nik])
            ->andFilterWhere(['ilike', 'passport', $this->passport])
            ->andFilterWhere(['ilike', 'status', $this->status])
            ->andFilterWhere(['ilike', 'posisi', $this->posisi])
            ->andFilterWhere(['ilike', 'fasilitas', $this->fasilitas])
            ->andFilterWhere(['ilike', 'kode_op', $this->kode_op])
            ->andFilterWhere(['ilike', 'id_tku', $this->id_tku])
            ->andFilterWhere(['ilike', 'nip', $this->nip])
            ->andFilterWhere(['ilike', 'nama', $this->nama])
            ->andFilterWhere(['ilike', 'tablok', $this->tablok]);

        return $dataProvider;
    }
}

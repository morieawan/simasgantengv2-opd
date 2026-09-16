<?php

namespace app\modules\sitampan\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\sitampan\models\PresKet;

/**
 * PresKetSearch represents the model behind the search form of `app\modules\sitampan\models\PresKet`.
 */
class PresKetSearch extends PresKet
{
    public $bulan;
    public $tahun;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'opd', 'no_surat', 'tgl_surat', 'tgl_awal', 'tgl_akhir', 'nip', 'detail', 'updated'], 'safe'],
            [['jenis_ket', 'flag', 'bulan', 'tahun'], 'integer'],
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
        $query = PresKet::find();

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
            'jenis_ket' => $this->jenis_ket,
            'tgl_surat' => $this->tgl_surat,
            // 'tgl_awal' => $this->tgl_awal,
            // 'tgl_akhir' => $this->tgl_akhir,
            'EXTRACT(month FROM tgl_awal::date)' => $this->bulan,
            'EXTRACT(year FROM tgl_awal::date)' => $this->tahun,
            'flag' => $this->flag,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['ilike', 'id', $this->id])
            ->andFilterWhere(['ilike', 'opd', $this->opd])
            ->andFilterWhere(['ilike', 'no_surat', $this->no_surat])
            ->andFilterWhere(['ilike', 'nip', $this->nip])
            ->andFilterWhere(['ilike', 'detail', $this->detail])
            // ->andFilterWhere(['OR', [
            //     'EXTRACT(month FROM tgl_awal::date)' => $this->bulan,
            //     'EXTRACT(year FROM tgl_awal::date)' => $this->tahun,
            // ],[
            //     'EXTRACT(month FROM tgl_akhir::date)' => $this->bulan,
            //     'EXTRACT(year FROM tgl_akhir::date)' => $this->tahun,
            // ]])
            ;

        return $dataProvider;
    }
}

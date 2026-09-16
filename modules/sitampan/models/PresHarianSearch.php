<?php

namespace app\modules\sitampan\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\sitampan\models\PresHarian;

/**
 * PresHarianSearch represents the model behind the search form of `app\modules\sitampan\models\PresHarian`.
 */
class PresHarianSearch extends PresHarian
{
    public $cari_bulan;
    public $cari_tahun;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'tgl', 'idpns', 'nip', 'nama', 'tablokb', 'jd_masuk', 'jd_pulang', 'pr_masuk', 'pr_pulang', 'kd_pr_masuk', 'kd_pr_pulang', 'updated'], 'safe'],
            [['mnt_masuk', 'mnt_pulang', 'flag', 'cari_bulan', 'cari_tahun'], 'integer'],
            [['persen_masuk', 'persen_pulang', 'pot_masuk', 'pot_pulang'], 'number'],
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
        $query = PresHarian::find();

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
            'tgl' => $this->tgl,
            'jd_masuk' => $this->jd_masuk,
            'jd_pulang' => $this->jd_pulang,
            'pr_masuk' => $this->pr_masuk,
            'pr_pulang' => $this->pr_pulang,
            'mnt_masuk' => $this->mnt_masuk,
            'mnt_pulang' => $this->mnt_pulang,
            'persen_masuk' => $this->persen_masuk,
            'persen_pulang' => $this->persen_pulang,
            'pot_masuk' => $this->pot_masuk,
            'pot_pulang' => $this->pot_pulang,
            'flag' => $this->flag,
            'updated' => $this->updated,
            'EXTRACT(month FROM tgl::date)' => $this->cari_bulan,
            'EXTRACT(year FROM tgl::date)' => $this->cari_tahun,
        ]);

        $query->andFilterWhere(['ilike', 'kode', $this->kode])
            ->andFilterWhere(['ilike', 'idpns', $this->idpns])
            ->andFilterWhere(['ilike', 'nip', $this->nip])
            ->andFilterWhere(['ilike', 'nama', $this->nama])
            ->andFilterWhere(['ilike', 'tablokb', $this->tablokb])
            ->andFilterWhere(['ilike', 'kd_pr_masuk', $this->kd_pr_masuk])
            ->andFilterWhere(['ilike', 'kd_pr_pulang', $this->kd_pr_pulang]);

        return $dataProvider;
    }
}

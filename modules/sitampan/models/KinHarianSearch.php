<?php

namespace app\modules\sitampan\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\sitampan\models\KinHarian;

/**
 * KinHarianSearch represents the model behind the search form of `app\modules\sitampan\models\KinHarian`.
 */
class KinHarianSearch extends KinHarian
{
    public $tanggal, $bulan, $tahun;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_pns', 'nip', 'nama', 'tablok', 'tablokb', 'tgl', 'kode_kegiatan_h', 'uraian_keg_h', 'tgl_target', 'target_output_h', 'tgl_real', 'tgl_ok', 'penilai_nip', 'penilai_nama', 'penilai_tablok', 'penilai_tablokb', 'real_output_h', 'ok_output_h'], 'safe'],
            [['target_kuan_h', 'target_waktu_h', 'real_kuan_h', 'real_waktu_h', 'ok_kuan_h', 'ok_waktu_h'], 'number'],
            [['flag', 'tanggal', 'bulan', 'tahun'], 'integer'],
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
        $query = KinHarian::find();

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

        $awal = $this->tahun.'-'.$this->bulan.'-01';
        $akhir = date('Y-m-t', strtotime($awal));

        // grid filtering conditions
        $query->andFilterWhere([
            'tgl' => $this->tgl,
            'tgl_target' => $this->tgl_target,
            'target_kuan_h' => $this->target_kuan_h,
            'target_waktu_h' => $this->target_waktu_h,
            'tgl_real' => $this->tgl_real,
            'real_kuan_h' => $this->real_kuan_h,
            'real_waktu_h' => $this->real_waktu_h,
            'tgl_ok' => $this->tgl_ok,
            'ok_kuan_h' => $this->ok_kuan_h,
            'ok_waktu_h' => $this->ok_waktu_h,
            'penilai_nip' => $this->penilai_nip,
            'flag' => $this->flag,
            // 'EXTRACT(YEAR FROM DATE(tgl))' => $this->tahun,
            // 'EXTRACT(MONTH FROM DATE(tgl))' => $this->bulan,
            'EXTRACT(DAY FROM DATE(tgl))' => $this->tanggal,
        ]);

        $query->andFilterWhere(['ilike', 'id', $this->id])
            ->andFilterWhere(['ilike', 'id_pns', $this->id_pns])
            ->andFilterWhere(['ilike', 'nip', $this->nip])
            ->andFilterWhere(['ilike', 'nama', $this->nama])
            ->andFilterWhere(['ilike', 'tablok', $this->tablok])
            ->andFilterWhere(['ilike', 'tablokb', $this->tablokb])
            ->andFilterWhere(['ilike', 'kode_kegiatan_h', $this->kode_kegiatan_h])
            ->andFilterWhere(['ilike', 'uraian_keg_h', $this->uraian_keg_h])
            ->andFilterWhere(['ilike', 'target_output_h', $this->target_output_h])
            ->andFilterWhere(['ilike', 'real_output_h', $this->real_output_h])
            ->andFilterWhere(['ilike', 'ok_output_h', $this->ok_output_h])
            //->andFilterWhere(['ilike', 'penilai_nip', $this->penilai_nip])
            ->andFilterWhere(['ilike', 'penilai_nama', $this->penilai_nama])
            ->andFilterWhere(['ilike', 'penilai_tablok', $this->penilai_tablok])
            ->andFilterWhere(['ilike', 'penilai_tablokb', $this->penilai_tablokb])
            ->andFilterWhere(['between', 'tgl', $awal, $akhir])
            ;

        return $dataProvider;
    }
}

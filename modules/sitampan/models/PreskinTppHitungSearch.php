<?php

namespace app\modules\sitampan\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\sitampan\models\PreskinTppHitung;

/**
 * PreskinTppHitungSearch represents the model behind the search form of `app\modules\sitampan\models\PreskinTppHitung`.
 */
class PreskinTppHitungSearch extends PreskinTppHitung
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idpns', 'nip', 'nama', 'kode_jab', 'nama_jab', 'tablok', 'nama_opd', 'tablokb', 'nama_unor', 'nama_gol', 'tgl_final', 'final_by', 'updated', 'nama_kelas'], 'safe'],
            [['tahun', 'bulan', 'jtrans', 'jenis_jab', 'kelas_jab_tpp', 'gol', 'pagu', 'persen_tpp_rp', 'beban_jab_rp', 'beban_opd_rp', 'kondisi_jab_rp', 'kondisi_opd_rp', 'pol_jab_rp', 'pol_opd_rp', 'prestasi_jab_rp', 'prestasi_opd_rp', 'tempat_jab_rp', 'tempat_opd_rp', 'profesi_jab_rp', 'pagu_total', 'pagu_tpp', 'beban_kerja', 'produktivitas_kerja', 'kinerja_rp', 'presensi_rp', 'sakip_rp', 'rb_rp', 'tpp_jumlah', 'lhkpn', 'aset', 'cuti_rp', 'hukdis_rp', 'tgr_rp', 'pengurangan', 'tpp_total', 'tj_pph_rp', 'pot_pph_rp', 'tj_bpjs4', 'pot_bpjs4', 'tpp_bruto', 'pot_bpjs1', 'pot_jml', 'tpp_net', 'status'], 'integer'],
            [['persen_tpp', 'beban_jab', 'beban_opd', 'kondisi_jab', 'kondisi_opd', 'pol_jab', 'pol_opd', 'prestasi_jab', 'prestasi_opd', 'tempat_jab', 'tempat_opd', 'profesi_jab', 'kinerja', 'presensi', 'sakip', 'rb', 'cuti', 'hukdis', 'tgr', 'pph'], 'number'],
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
        $query = PreskinTppHitung::find();

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
            'tahun' => $this->tahun,
            'bulan' => $this->bulan,
            'jtrans' => $this->jtrans,
            'jenis_jab' => $this->jenis_jab,
            'kelas_jab_tpp' => $this->kelas_jab_tpp,
            'gol' => $this->gol,
            'pagu' => $this->pagu,
            'persen_tpp' => $this->persen_tpp,
            'beban_jab' => $this->beban_jab,
            'beban_opd' => $this->beban_opd,
            'kondisi_jab' => $this->kondisi_jab,
            'kondisi_opd' => $this->kondisi_opd,
            'pol_jab' => $this->pol_jab,
            'pol_opd' => $this->pol_opd,
            'prestasi_jab' => $this->prestasi_jab,
            'prestasi_opd' => $this->prestasi_opd,
            'tempat_jab' => $this->tempat_jab,
            'tempat_opd' => $this->tempat_opd,
            'profesi_jab' => $this->profesi_jab,
            'persen_tpp_rp' => $this->persen_tpp_rp,
            'beban_jab_rp' => $this->beban_jab_rp,
            'beban_opd_rp' => $this->beban_opd_rp,
            'kondisi_jab_rp' => $this->kondisi_jab_rp,
            'kondisi_opd_rp' => $this->kondisi_opd_rp,
            'pol_jab_rp' => $this->pol_jab_rp,
            'pol_opd_rp' => $this->pol_opd_rp,
            'prestasi_jab_rp' => $this->prestasi_jab_rp,
            'prestasi_opd_rp' => $this->prestasi_opd_rp,
            'tempat_jab_rp' => $this->tempat_jab_rp,
            'tempat_opd_rp' => $this->tempat_opd_rp,
            'profesi_jab_rp' => $this->profesi_jab_rp,
            'pagu_total' => $this->pagu_total,
            'pagu_tpp' => $this->pagu_tpp,
            'beban_kerja' => $this->beban_kerja,
            'produktivitas_kerja' => $this->produktivitas_kerja,
            'kinerja' => $this->kinerja,
            'presensi' => $this->presensi,
            'sakip' => $this->sakip,
            'rb' => $this->rb,
            'kinerja_rp' => $this->kinerja_rp,
            'presensi_rp' => $this->presensi_rp,
            'sakip_rp' => $this->sakip_rp,
            'rb_rp' => $this->rb_rp,
            'tpp_jumlah' => $this->tpp_jumlah,
            'cuti' => $this->cuti,
            'hukdis' => $this->hukdis,
            'tgr' => $this->tgr,
            'lhkpn' => $this->lhkpn,
            'aset' => $this->aset,
            'cuti_rp' => $this->cuti_rp,
            'hukdis_rp' => $this->hukdis_rp,
            'tgr_rp' => $this->tgr_rp,
            'pengurangan' => $this->pengurangan,
            'tpp_total' => $this->tpp_total,
            'pph' => $this->pph,
            'tj_pph_rp' => $this->tj_pph_rp,
            'tj_bpjs4' => $this->tj_bpjs4,
            'tpp_bruto' => $this->tpp_bruto,
            'pot_pph_rp' => $this->pot_pph_rp,
            'pot_bpjs4' => $this->pot_bpjs4,
            'pot_bpjs1' => $this->pot_bpjs1,
            'pot_jml' => $this->pot_jml,
            'tpp_net' => $this->tpp_net,
            'status' => $this->status,
            'tgl_final' => $this->tgl_final,
            'final_by' => $this->final_by,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['ilike', 'id', $this->id])
            ->andFilterWhere(['ilike', 'idpns', $this->idpns])
            ->andFilterWhere(['ilike', 'nip', $this->nip])
            ->andFilterWhere(['ilike', 'nama', $this->nama])
            ->andFilterWhere(['ilike', 'kode_jab', $this->kode_jab])
            ->andFilterWhere(['ilike', 'nama_jab', $this->nama_jab])
            ->andFilterWhere(['ilike', 'tablok', $this->tablok])
            ->andFilterWhere(['ilike', 'nama_opd', $this->nama_opd])
            ->andFilterWhere(['ilike', 'tablokb', $this->tablokb])
            ->andFilterWhere(['ilike', 'nama_kelas', $this->nama_kelas])
            ->andFilterWhere(['ilike', 'nama_unor', $this->nama_unor])
            ->andFilterWhere(['ilike', 'nama_gol', $this->nama_gol]);

        return $dataProvider;
    }
}

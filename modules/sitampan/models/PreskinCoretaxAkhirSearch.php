<?php

namespace app\modules\sitampan\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\sitampan\models\PreskinCoretaxAkhir;

/**
 * PreskinCoretaxAkhirSearch represents the model behind the search form of `app\modules\sitampan\models\PreskinCoretaxAkhir`.
 */
class PreskinCoretaxAkhirSearch extends PreskinCoretaxAkhir
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pemberi_kerja', 'npwp', 'nip', 'status', 'posisi', 'pangkat_gol', 'kd_obj_pajak', 'bupot', 'no_bupot_sebelumnya', 'id_tku', 'tgl_potong', 'nama', 'tablok', 'satker', 'updated'], 'safe'],
            [['masa_awal', 'masa_akhir', 'tahun_pajak', 'jml_bln', 'gaji', 'tunj_istri', 'tunj_anak', 'tpp', 'tunj_jabatan', 'tunj_beras', 'tunj_khusus', 'tunj_lain', 'iuran_pensiun', 'zakat', 'pph_terbayar', 'bruto_gaji', 'jkk', 'jkm', 'bpjs4', 'tjstruk', 'tjfung', 'tjumum', 'tjbulat', 'bruto_total', 'pot_bea_jabatan', 'pot_iuran_pensiun', 'netto', 'ptkp', 'pkp_total', 'pkp5', 'pkp15', 'pkp25', 'pkp30', 'pkp35', 'pph5', 'pph15', 'pph25', 'pph30', 'pph35', 'pph_total', 'pph_gaji_terbayar', 'pph_tpp_terbayar', 'pph_gaji_akhir_masa', 'pph_terhutang', 'jenis', 'flag'], 'integer'],
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
        $query = PreskinCoretaxAkhir::find();

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
            'masa_awal' => $this->masa_awal,
            'masa_akhir' => $this->masa_akhir,
            'tahun_pajak' => $this->tahun_pajak,
            'jml_bln' => $this->jml_bln,
            'gaji' => $this->gaji,
            'tunj_istri' => $this->tunj_istri,
            'tunj_anak' => $this->tunj_anak,
            'tpp' => $this->tpp,
            'tunj_jabatan' => $this->tunj_jabatan,
            'tunj_beras' => $this->tunj_beras,
            'tunj_khusus' => $this->tunj_khusus,
            'tunj_lain' => $this->tunj_lain,
            'iuran_pensiun' => $this->iuran_pensiun,
            'zakat' => $this->zakat,
            'pph_terbayar' => $this->pph_terbayar,
            'tgl_potong' => $this->tgl_potong,
            'bruto_gaji' => $this->bruto_gaji,
            'jkk' => $this->jkk,
            'jkm' => $this->jkm,
            'bpjs4' => $this->bpjs4,
            'tjstruk' => $this->tjstruk,
            'tjfung' => $this->tjfung,
            'tjumum' => $this->tjumum,
            'tjbulat' => $this->tjbulat,
            'bruto_total' => $this->bruto_total,
            'pot_bea_jabatan' => $this->pot_bea_jabatan,
            'pot_iuran_pensiun' => $this->pot_iuran_pensiun,
            'netto' => $this->netto,
            'ptkp' => $this->ptkp,
            'pkp_total' => $this->pkp_total,
            'pkp5' => $this->pkp5,
            'pkp15' => $this->pkp15,
            'pkp25' => $this->pkp25,
            'pkp30' => $this->pkp30,
            'pkp35' => $this->pkp35,
            'pph5' => $this->pph5,
            'pph15' => $this->pph15,
            'pph25' => $this->pph25,
            'pph30' => $this->pph30,
            'pph35' => $this->pph35,
            'pph_total' => $this->pph_total,
            'pph_gaji_terbayar' => $this->pph_gaji_terbayar,
            'pph_tpp_terbayar' => $this->pph_tpp_terbayar,
            'pph_gaji_akhir_masa' => $this->pph_gaji_akhir_masa,
            'pph_terhutang' => $this->pph_terhutang,
            'jenis' => $this->jenis,
            'flag' => $this->flag,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['ilike', 'pemberi_kerja', $this->pemberi_kerja])
            ->andFilterWhere(['ilike', 'npwp', $this->npwp])
            ->andFilterWhere(['ilike', 'nip', $this->nip])
            ->andFilterWhere(['ilike', 'status', $this->status])
            ->andFilterWhere(['ilike', 'posisi', $this->posisi])
            ->andFilterWhere(['ilike', 'pangkat_gol', $this->pangkat_gol])
            ->andFilterWhere(['ilike', 'kd_obj_pajak', $this->kd_obj_pajak])
            ->andFilterWhere(['ilike', 'bupot', $this->bupot])
            ->andFilterWhere(['ilike', 'no_bupot_sebelumnya', $this->no_bupot_sebelumnya])
            ->andFilterWhere(['ilike', 'id_tku', $this->id_tku])
            ->andFilterWhere(['ilike', 'nama', $this->nama])
            ->andFilterWhere(['ilike', 'tablok', $this->tablok])
            ->andFilterWhere(['ilike', 'satker', $this->satker]);

        return $dataProvider;
    }
}

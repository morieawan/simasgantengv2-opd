<?php

namespace app\modules\integrasi\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\integrasi\models\SiasnDataUtama;

/**
 * SiasnDataUtamaSearch represents the model behind the search form of `app\modules\integrasi\models\SiasnDataUtama`.
 */
class SiasnDataUtamaSearch extends SiasnDataUtama
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nipBaru', 'nipLama', 'nama', 'gelarDepan', 'gelarBelakang', 'tempatLahir', 'tempatLahirId', 'tglLahir', 'agama', 'agamaId', 'email', 'emailGov', 'nik', 'alamat', 'noHp', 'noTelp', 'jenisPegawaiId', 'jenisPegawaiNama', 'kedudukanPnsId', 'kedudukanPnsNama', 'statusPegawai', 'jenisKelamin', 'jenisIdDokumenId', 'jenisIdDokumenNama', 'nomorIdDocument', 'noSeriKarpeg', 'tkPendidikanTerakhirId', 'tkPendidikanTerakhir', 'pendidikanTerakhirId', 'pendidikanTerakhirNama', 'tahunLulus', 'tmtPns', 'tglSkPns', 'tmtCpns', 'tglSkCpns', 'tmtPensiun', 'latihanStrukturalNama', 'instansiIndukId', 'instansiIndukNama', 'satuanKerjaIndukId', 'satuanKerjaIndukNama', 'kanregId', 'kanregNama', 'instansiKerjaId', 'instansiKerjaNama', 'instansiKerjaKodeCepat', 'satuanKerjaKerjaId', 'satuanKerjaKerjaNama', 'unorId', 'unorNama', 'unorIndukId', 'unorIndukNama', 'jenisJabatanId', 'jenisJabatan', 'jabatanNama', 'jabatanStrukturalId', 'jabatanStrukturalNama', 'jabatanFungsionalId', 'jabatanFungsionalNama', 'jabatanFungsionalUmumId', 'jabatanFungsionalUmumNama', 'tmtJabatan', 'lokasiKerjaId', 'lokasiKerja', 'golRuangAwalId', 'golRuangAwal', 'golRuangAkhirId', 'golRuangAkhir', 'tmtGolAkhir', 'nomorSptm', 'masaKerja', 'eselon', 'eselonId', 'eselonLevel', 'tmtEselon', 'kpknId', 'kpknNama', 'ktuaId', 'ktuaNama', 'taspenId', 'taspenNama', 'jenisKawinId', 'statusPerkawinan', 'statusHidup', 'tglSuratKeteranganDokter', 'noSuratKeteranganDokter', 'noSuratKeteranganBebasNarkoba', 'tglSuratKeteranganBebasNarkoba', 'skck', 'tglSkck', 'akteKelahiran', 'akteMeninggal', 'tglMeninggal', 'noNpwp', 'tglNpwp', 'noAskes', 'bpjs', 'kodePos', 'noSpmt', 'tglSpmt', 'noTaspen', 'bahasa', 'kppnId', 'kppnNama', 'pangkatAkhir', 'tglSttpl', 'nomorSttpl', 'nomorSkCpns', 'nomorSkPns', 'jenjang', 'jabatanAsn', 'kartuAsn', 'updated', 'validNik'], 'safe'],
            [['bupPensiun', 'gajiPokok', 'jumlahIstriSuami', 'jumlahAnak', 'mkTahun', 'mkBulan', 'flag'], 'integer'],
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
        $query = SiasnDataUtama::find();

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
            'bupPensiun' => $this->bupPensiun,
            'gajiPokok' => $this->gajiPokok,
            'jumlahIstriSuami' => $this->jumlahIstriSuami,
            'jumlahAnak' => $this->jumlahAnak,
            'mkTahun' => $this->mkTahun,
            'mkBulan' => $this->mkBulan,
            'flag' => $this->flag,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['ilike', 'id', $this->id])
            ->andFilterWhere(['ilike', 'nipBaru', $this->nipBaru])
            ->andFilterWhere(['ilike', 'nipLama', $this->nipLama])
            ->andFilterWhere(['ilike', 'nama', $this->nama])
            ->andFilterWhere(['ilike', 'gelarDepan', $this->gelarDepan])
            ->andFilterWhere(['ilike', 'gelarBelakang', $this->gelarBelakang])
            ->andFilterWhere(['ilike', 'tempatLahir', $this->tempatLahir])
            ->andFilterWhere(['ilike', 'tempatLahirId', $this->tempatLahirId])
            ->andFilterWhere(['ilike', 'tglLahir', $this->tglLahir])
            ->andFilterWhere(['ilike', 'agama', $this->agama])
            ->andFilterWhere(['ilike', 'agamaId', $this->agamaId])
            ->andFilterWhere(['ilike', 'email', $this->email])
            ->andFilterWhere(['ilike', 'emailGov', $this->emailGov])
            ->andFilterWhere(['ilike', 'nik', $this->nik])
            ->andFilterWhere(['ilike', 'alamat', $this->alamat])
            ->andFilterWhere(['ilike', 'noHp', $this->noHp])
            ->andFilterWhere(['ilike', 'noTelp', $this->noTelp])
            ->andFilterWhere(['ilike', 'jenisPegawaiId', $this->jenisPegawaiId])
            ->andFilterWhere(['ilike', 'jenisPegawaiNama', $this->jenisPegawaiNama])
            ->andFilterWhere(['ilike', 'kedudukanPnsId', $this->kedudukanPnsId])
            ->andFilterWhere(['ilike', 'kedudukanPnsNama', $this->kedudukanPnsNama])
            ->andFilterWhere(['ilike', 'statusPegawai', $this->statusPegawai])
            ->andFilterWhere(['ilike', 'jenisKelamin', $this->jenisKelamin])
            ->andFilterWhere(['ilike', 'jenisIdDokumenId', $this->jenisIdDokumenId])
            ->andFilterWhere(['ilike', 'jenisIdDokumenNama', $this->jenisIdDokumenNama])
            ->andFilterWhere(['ilike', 'nomorIdDocument', $this->nomorIdDocument])
            ->andFilterWhere(['ilike', 'noSeriKarpeg', $this->noSeriKarpeg])
            ->andFilterWhere(['ilike', 'tkPendidikanTerakhirId', $this->tkPendidikanTerakhirId])
            ->andFilterWhere(['ilike', 'tkPendidikanTerakhir', $this->tkPendidikanTerakhir])
            ->andFilterWhere(['ilike', 'pendidikanTerakhirId', $this->pendidikanTerakhirId])
            ->andFilterWhere(['ilike', 'pendidikanTerakhirNama', $this->pendidikanTerakhirNama])
            ->andFilterWhere(['ilike', 'tahunLulus', $this->tahunLulus])
            ->andFilterWhere(['ilike', 'tmtPns', $this->tmtPns])
            ->andFilterWhere(['ilike', 'tglSkPns', $this->tglSkPns])
            ->andFilterWhere(['ilike', 'tmtCpns', $this->tmtCpns])
            ->andFilterWhere(['ilike', 'tglSkCpns', $this->tglSkCpns])
            ->andFilterWhere(['ilike', 'tmtPensiun', $this->tmtPensiun])
            ->andFilterWhere(['ilike', 'latihanStrukturalNama', $this->latihanStrukturalNama])
            ->andFilterWhere(['ilike', 'instansiIndukId', $this->instansiIndukId])
            ->andFilterWhere(['ilike', 'instansiIndukNama', $this->instansiIndukNama])
            ->andFilterWhere(['ilike', 'satuanKerjaIndukId', $this->satuanKerjaIndukId])
            ->andFilterWhere(['ilike', 'satuanKerjaIndukNama', $this->satuanKerjaIndukNama])
            ->andFilterWhere(['ilike', 'kanregId', $this->kanregId])
            ->andFilterWhere(['ilike', 'kanregNama', $this->kanregNama])
            ->andFilterWhere(['ilike', 'instansiKerjaId', $this->instansiKerjaId])
            ->andFilterWhere(['ilike', 'instansiKerjaNama', $this->instansiKerjaNama])
            ->andFilterWhere(['ilike', 'instansiKerjaKodeCepat', $this->instansiKerjaKodeCepat])
            ->andFilterWhere(['ilike', 'satuanKerjaKerjaId', $this->satuanKerjaKerjaId])
            ->andFilterWhere(['ilike', 'satuanKerjaKerjaNama', $this->satuanKerjaKerjaNama])
            ->andFilterWhere(['ilike', 'unorId', $this->unorId])
            ->andFilterWhere(['ilike', 'unorNama', $this->unorNama])
            ->andFilterWhere(['ilike', 'unorIndukId', $this->unorIndukId])
            ->andFilterWhere(['ilike', 'unorIndukNama', $this->unorIndukNama])
            ->andFilterWhere(['ilike', 'jenisJabatanId', $this->jenisJabatanId])
            ->andFilterWhere(['ilike', 'jenisJabatan', $this->jenisJabatan])
            ->andFilterWhere(['ilike', 'jabatanNama', $this->jabatanNama])
            ->andFilterWhere(['ilike', 'jabatanStrukturalId', $this->jabatanStrukturalId])
            ->andFilterWhere(['ilike', 'jabatanStrukturalNama', $this->jabatanStrukturalNama])
            ->andFilterWhere(['ilike', 'jabatanFungsionalId', $this->jabatanFungsionalId])
            ->andFilterWhere(['ilike', 'jabatanFungsionalNama', $this->jabatanFungsionalNama])
            ->andFilterWhere(['ilike', 'jabatanFungsionalUmumId', $this->jabatanFungsionalUmumId])
            ->andFilterWhere(['ilike', 'jabatanFungsionalUmumNama', $this->jabatanFungsionalUmumNama])
            ->andFilterWhere(['ilike', 'tmtJabatan', $this->tmtJabatan])
            ->andFilterWhere(['ilike', 'lokasiKerjaId', $this->lokasiKerjaId])
            ->andFilterWhere(['ilike', 'lokasiKerja', $this->lokasiKerja])
            ->andFilterWhere(['ilike', 'golRuangAwalId', $this->golRuangAwalId])
            ->andFilterWhere(['ilike', 'golRuangAwal', $this->golRuangAwal])
            ->andFilterWhere(['ilike', 'golRuangAkhirId', $this->golRuangAkhirId])
            ->andFilterWhere(['ilike', 'golRuangAkhir', $this->golRuangAkhir])
            ->andFilterWhere(['ilike', 'tmtGolAkhir', $this->tmtGolAkhir])
            ->andFilterWhere(['ilike', 'nomorSptm', $this->nomorSptm])
            ->andFilterWhere(['ilike', 'masaKerja', $this->masaKerja])
            ->andFilterWhere(['ilike', 'eselon', $this->eselon])
            ->andFilterWhere(['ilike', 'eselonId', $this->eselonId])
            ->andFilterWhere(['ilike', 'eselonLevel', $this->eselonLevel])
            ->andFilterWhere(['ilike', 'tmtEselon', $this->tmtEselon])
            ->andFilterWhere(['ilike', 'kpknId', $this->kpknId])
            ->andFilterWhere(['ilike', 'kpknNama', $this->kpknNama])
            ->andFilterWhere(['ilike', 'ktuaId', $this->ktuaId])
            ->andFilterWhere(['ilike', 'ktuaNama', $this->ktuaNama])
            ->andFilterWhere(['ilike', 'taspenId', $this->taspenId])
            ->andFilterWhere(['ilike', 'taspenNama', $this->taspenNama])
            ->andFilterWhere(['ilike', 'jenisKawinId', $this->jenisKawinId])
            ->andFilterWhere(['ilike', 'statusPerkawinan', $this->statusPerkawinan])
            ->andFilterWhere(['ilike', 'statusHidup', $this->statusHidup])
            ->andFilterWhere(['ilike', 'tglSuratKeteranganDokter', $this->tglSuratKeteranganDokter])
            ->andFilterWhere(['ilike', 'noSuratKeteranganDokter', $this->noSuratKeteranganDokter])
            ->andFilterWhere(['ilike', 'noSuratKeteranganBebasNarkoba', $this->noSuratKeteranganBebasNarkoba])
            ->andFilterWhere(['ilike', 'tglSuratKeteranganBebasNarkoba', $this->tglSuratKeteranganBebasNarkoba])
            ->andFilterWhere(['ilike', 'skck', $this->skck])
            ->andFilterWhere(['ilike', 'tglSkck', $this->tglSkck])
            ->andFilterWhere(['ilike', 'akteKelahiran', $this->akteKelahiran])
            ->andFilterWhere(['ilike', 'akteMeninggal', $this->akteMeninggal])
            ->andFilterWhere(['ilike', 'tglMeninggal', $this->tglMeninggal])
            ->andFilterWhere(['ilike', 'noNpwp', $this->noNpwp])
            ->andFilterWhere(['ilike', 'tglNpwp', $this->tglNpwp])
            ->andFilterWhere(['ilike', 'noAskes', $this->noAskes])
            ->andFilterWhere(['ilike', 'bpjs', $this->bpjs])
            ->andFilterWhere(['ilike', 'kodePos', $this->kodePos])
            ->andFilterWhere(['ilike', 'noSpmt', $this->noSpmt])
            ->andFilterWhere(['ilike', 'tglSpmt', $this->tglSpmt])
            ->andFilterWhere(['ilike', 'noTaspen', $this->noTaspen])
            ->andFilterWhere(['ilike', 'bahasa', $this->bahasa])
            ->andFilterWhere(['ilike', 'kppnId', $this->kppnId])
            ->andFilterWhere(['ilike', 'kppnNama', $this->kppnNama])
            ->andFilterWhere(['ilike', 'pangkatAkhir', $this->pangkatAkhir])
            ->andFilterWhere(['ilike', 'tglSttpl', $this->tglSttpl])
            ->andFilterWhere(['ilike', 'nomorSttpl', $this->nomorSttpl])
            ->andFilterWhere(['ilike', 'nomorSkCpns', $this->nomorSkCpns])
            ->andFilterWhere(['ilike', 'nomorSkPns', $this->nomorSkPns])
            ->andFilterWhere(['ilike', 'jenjang', $this->jenjang])
            ->andFilterWhere(['ilike', 'jabatanAsn', $this->jabatanAsn])
            ->andFilterWhere(['ilike', 'kartuAsn', $this->kartuAsn])
            ->andFilterWhere(['ilike', 'validNik', $this->validNik]);

        return $dataProvider;
    }
}

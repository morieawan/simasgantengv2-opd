<?php

namespace app\modules\integrasi\models;

use Yii;

/**
 * This is the model class for table "siasn_rw_skp".
 *
 * @property string $id
 * @property string|null $tahun
 * @property float|null $nilaiSkp
 * @property float|null $orientasiPelayanan
 * @property float|null $integritas
 * @property float|null $komitmen
 * @property float|null $disiplin
 * @property float|null $kerjasama
 * @property float|null $nilaiPerilakuKerja
 * @property float|null $nilaiPrestasiKerja
 * @property float|null $kepemimpinan
 * @property float|null $jumlah
 * @property float|null $nilairatarata
 * @property string|null $atasanPejabatPenilai
 * @property string|null $pejabatPenilai
 * @property string|null $pns
 * @property string|null $atasanNonPns
 * @property string|null $penilaiNonPns
 * @property string|null $penilaiNipNrp
 * @property string|null $atasanPenilaiNipNrp
 * @property string|null $penilaiNama
 * @property string|null $atasanPenilaiNama
 * @property string|null $penilaiUnorNama
 * @property string|null $atasanPenilaiUnorNama
 * @property string|null $penilaiJabatan
 * @property string|null $atasanPenilaiJabatan
 * @property string|null $penilaiGolongan
 * @property string|null $atasanPenilaiGolongan
 * @property string|null $penilaiTmtGolongan
 * @property string|null $atasanPenilaiTmtGolongan
 * @property string|null $statusPenilai
 * @property string|null $statusAtasanPenilai
 * @property string|null $jenisJabatan
 * @property string|null $updated
 * @property string|null $jenisPeraturanKinerjaKd
 * @property float|null $inisiatifKerja
 * @property float|null $konversiNilai
 * @property float|null $nilaiIntegrasi
 */
class SiasnRwSkp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siasn_rw_skp';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['nilaiSkp', 'orientasiPelayanan', 'integritas', 'komitmen', 'disiplin', 'kerjasama', 'nilaiPerilakuKerja', 'nilaiPrestasiKerja', 'kepemimpinan', 'jumlah', 'nilairatarata', 'inisiatifKerja', 'konversiNilai', 'nilaiIntegrasi'], 'number'],
            [['updated'], 'safe'],
            [['id', 'pns'], 'string', 'max' => 128],
            [['tahun'], 'string', 'max' => 4],
            [['atasanPejabatPenilai', 'pejabatPenilai', 'atasanNonPns', 'penilaiNonPns', 'penilaiUnorNama', 'atasanPenilaiUnorNama', 'penilaiJabatan', 'atasanPenilaiJabatan'], 'string', 'max' => 250],
            [['penilaiNipNrp', 'atasanPenilaiNipNrp', 'penilaiNama', 'atasanPenilaiNama', 'jenisPeraturanKinerjaKd'], 'string', 'max' => 100],
            [['penilaiGolongan', 'atasanPenilaiGolongan', 'statusPenilai', 'statusAtasanPenilai', 'jenisJabatan'], 'string', 'max' => 20],
            [['penilaiTmtGolongan', 'atasanPenilaiTmtGolongan'], 'string', 'max' => 10],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tahun' => 'Tahun',
            'nilaiSkp' => 'Nilai Skp',
            'orientasiPelayanan' => 'Orientasi Pelayanan',
            'integritas' => 'Integritas',
            'komitmen' => 'Komitmen',
            'disiplin' => 'Disiplin',
            'kerjasama' => 'Kerjasama',
            'nilaiPerilakuKerja' => 'Nilai Perilaku Kerja',
            'nilaiPrestasiKerja' => 'Nilai Prestasi Kerja',
            'kepemimpinan' => 'Kepemimpinan',
            'jumlah' => 'Jumlah',
            'nilairatarata' => 'Nilairatarata',
            'atasanPejabatPenilai' => 'Atasan Pejabat Penilai',
            'pejabatPenilai' => 'Pejabat Penilai',
            'pns' => 'Pns',
            'atasanNonPns' => 'Atasan Non Pns',
            'penilaiNonPns' => 'Penilai Non Pns',
            'penilaiNipNrp' => 'Penilai Nip Nrp',
            'atasanPenilaiNipNrp' => 'Atasan Penilai Nip Nrp',
            'penilaiNama' => 'Penilai Nama',
            'atasanPenilaiNama' => 'Atasan Penilai Nama',
            'penilaiUnorNama' => 'Penilai Unor Nama',
            'atasanPenilaiUnorNama' => 'Atasan Penilai Unor Nama',
            'penilaiJabatan' => 'Penilai Jabatan',
            'atasanPenilaiJabatan' => 'Atasan Penilai Jabatan',
            'penilaiGolongan' => 'Penilai Golongan',
            'atasanPenilaiGolongan' => 'Atasan Penilai Golongan',
            'penilaiTmtGolongan' => 'Penilai Tmt Golongan',
            'atasanPenilaiTmtGolongan' => 'Atasan Penilai Tmt Golongan',
            'statusPenilai' => 'Status Penilai',
            'statusAtasanPenilai' => 'Status Atasan Penilai',
            'jenisJabatan' => 'Jenis Jabatan',
            'updated' => 'Updated',
            'jenisPeraturanKinerjaKd' => 'Jenis Peraturan Kinerja Kd',
            'inisiatifKerja' => 'Inisiatif Kerja',
            'konversiNilai' => 'Konversi Nilai',
            'nilaiIntegrasi' => 'Nilai Integrasi',
        ];
    }
}

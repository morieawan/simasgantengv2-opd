<?php

namespace app\modules\integrasi\models;

use Yii;

/**
 * This is the model class for table "siasn_rw_hukdis".
 *
 * @property string $id
 * @property string|null $rwHukumanDisiplin
 * @property string|null $golongan kode_gol
 * @property string|null $kedudukanHukum
 * @property string|null $jenisHukuman
 * @property string $pnsOrang id_pns pada sapk
 * @property string|null $skNomor
 * @property string|null $skTanggal
 * @property string|null $hukumanTanggal
 * @property string|null $masaTahun
 * @property string|null $masaBulan
 * @property string|null $akhirHukumTanggal
 * @property string|null $nomorPp
 * @property string|null $golonganLama
 * @property string|null $skPembatalanNomor
 * @property string|null $skPembatalanTanggal
 * @property string|null $alasanHukumanDisiplin
 * @property string|null $jenisHukumanNama
 */
class SiasnRwHukdis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siasn_rw_hukdis';
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
            [['id', 'pnsOrang'], 'required'],
            [['skTanggal', 'hukumanTanggal', 'akhirHukumTanggal', 'skPembatalanTanggal'], 'safe'],
            [['id', 'pnsOrang'], 'string', 'max' => 32],
            [['rwHukumanDisiplin'], 'string', 'max' => 255],
            [['golongan', 'kedudukanHukum', 'jenisHukuman', 'masaTahun', 'masaBulan', 'golonganLama'], 'string', 'max' => 2],
            [['skNomor', 'skPembatalanNomor'], 'string', 'max' => 100],
            [['nomorPp'], 'string', 'max' => 50],
            [['alasanHukumanDisiplin', 'jenisHukumanNama'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rwHukumanDisiplin' => 'Rw Hukuman Disiplin',
            'golongan' => 'Golongan',
            'kedudukanHukum' => 'Kedudukan Hukum',
            'jenisHukuman' => 'Jenis Hukuman',
            'pnsOrang' => 'Pns Orang',
            'skNomor' => 'Sk Nomor',
            'skTanggal' => 'Sk Tanggal',
            'hukumanTanggal' => 'Hukuman Tanggal',
            'masaTahun' => 'Masa Tahun',
            'masaBulan' => 'Masa Bulan',
            'akhirHukumTanggal' => 'Akhir Hukum Tanggal',
            'nomorPp' => 'Nomor Pp',
            'golonganLama' => 'Golongan Lama',
            'skPembatalanNomor' => 'Sk Pembatalan Nomor',
            'skPembatalanTanggal' => 'Sk Pembatalan Tanggal',
            'alasanHukumanDisiplin' => 'Alasan Hukuman Disiplin',
            'jenisHukumanNama' => 'Jenis Hukuman Nama',
        ];
    }
}

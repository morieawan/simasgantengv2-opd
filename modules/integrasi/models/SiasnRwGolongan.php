<?php

namespace app\modules\integrasi\models;

use Yii;

/**
 * This is the model class for table "siasn_rw_golongan".
 *
 * @property string $id
 * @property string|null $idPns
 * @property string|null $nipBaru
 * @property string|null $nipLama
 * @property string|null $golonganId
 * @property string|null $golongan
 * @property string|null $skNomor
 * @property string|null $skTanggal
 * @property string|null $tmtGolongan
 * @property string|null $noPertekBkn
 * @property string|null $tglPertekBkn
 * @property float|null $jumlahKreditUtama
 * @property string|null $jumlahKreditTambahan
 * @property string|null $jenisKPId
 * @property string|null $jenisKPNama
 * @property int|null $masaKerjaGolonganTahun
 * @property int|null $masaKerjaGolonganBulan
 * @property string|null $updated
 */
class SiasnRwGolongan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siasn_rw_golongan';
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
            [['tmtGolongan', 'updated'], 'safe'],
            [['jumlahKreditUtama'], 'number'],
            [['masaKerjaGolonganTahun', 'masaKerjaGolonganBulan'], 'default', 'value' => null],
            [['masaKerjaGolonganTahun', 'masaKerjaGolonganBulan'], 'integer'],
            [['id', 'idPns'], 'string', 'max' => 128],
            [['nipBaru'], 'string', 'max' => 18],
            [['nipLama'], 'string', 'max' => 9],
            [['golonganId'], 'string', 'max' => 2],
            [['golongan'], 'string', 'max' => 5],
            [['skNomor', 'noPertekBkn'], 'string', 'max' => 50],
            [['skTanggal', 'tglPertekBkn'], 'string', 'max' => 10],
            [['jumlahKreditTambahan'], 'string', 'max' => 7],
            [['jenisKPId'], 'string', 'max' => 3],
            [['jenisKPNama'], 'string', 'max' => 60],
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
            'idPns' => 'Id Pns',
            'nipBaru' => 'Nip Baru',
            'nipLama' => 'Nip Lama',
            'golonganId' => 'Golongan ID',
            'golongan' => 'Golongan',
            'skNomor' => 'Sk Nomor',
            'skTanggal' => 'Sk Tanggal',
            'tmtGolongan' => 'Tmt Golongan',
            'noPertekBkn' => 'No Pertek Bkn',
            'tglPertekBkn' => 'Tgl Pertek Bkn',
            'jumlahKreditUtama' => 'Jumlah Kredit Utama',
            'jumlahKreditTambahan' => 'Jumlah Kredit Tambahan',
            'jenisKPId' => 'Jenis Kp ID',
            'jenisKPNama' => 'Jenis Kp Nama',
            'masaKerjaGolonganTahun' => 'Masa Kerja Golongan Tahun',
            'masaKerjaGolonganBulan' => 'Masa Kerja Golongan Bulan',
            'updated' => 'Updated',
        ];
    }
}

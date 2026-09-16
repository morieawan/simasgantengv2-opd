<?php

namespace app\modules\integrasi\models;

use Yii;

/**
 * This is the model class for table "siasn_rw_angkakredit".
 *
 * @property string $id
 * @property string|null $pns
 * @property string|null $nomorSk
 * @property string|null $tanggalSk
 * @property string|null $bulanMulaiPenailan
 * @property string|null $tahunMulaiPenailan
 * @property string|null $bulanSelesaiPenailan
 * @property string|null $tahunSelesaiPenailan
 * @property float|null $kreditUtamaBaru
 * @property float|null $kreditPenunjangBaru
 * @property float|null $kreditBaruTotal
 * @property string|null $rwJabatan
 * @property string|null $namaJabatan
 * @property string|null $isAngkaKreditPertama
 * @property string|null $updated
 */
class SiasnRwAngkakredit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siasn_rw_angkakredit';
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
            [['tanggalSk', 'updated'], 'safe'],
            [['kreditUtamaBaru', 'kreditPenunjangBaru', 'kreditBaruTotal'], 'number'],
            [['id', 'pns', 'rwJabatan'], 'string', 'max' => 32],
            [['nomorSk', 'namaJabatan'], 'string', 'max' => 100],
            [['bulanMulaiPenailan', 'bulanSelesaiPenailan'], 'string', 'max' => 2],
            [['tahunMulaiPenailan', 'tahunSelesaiPenailan'], 'string', 'max' => 4],
            [['isAngkaKreditPertama'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pns' => 'Pns',
            'nomorSk' => 'Nomor Sk',
            'tanggalSk' => 'Tanggal Sk',
            'bulanMulaiPenailan' => 'Bulan Mulai Penailan',
            'tahunMulaiPenailan' => 'Tahun Mulai Penailan',
            'bulanSelesaiPenailan' => 'Bulan Selesai Penailan',
            'tahunSelesaiPenailan' => 'Tahun Selesai Penailan',
            'kreditUtamaBaru' => 'Kredit Utama Baru',
            'kreditPenunjangBaru' => 'Kredit Penunjang Baru',
            'kreditBaruTotal' => 'Kredit Baru Total',
            'rwJabatan' => 'Rw Jabatan',
            'namaJabatan' => 'Nama Jabatan',
            'isAngkaKreditPertama' => 'Is Angka Kredit Pertama',
            'updated' => 'Updated',
        ];
    }
}

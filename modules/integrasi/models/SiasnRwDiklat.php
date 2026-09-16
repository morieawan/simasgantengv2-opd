<?php

namespace app\modules\integrasi\models;

use Yii;

/**
 * This is the model class for table "siasn_rw_diklat".
 *
 * @property string $id
 * @property string|null $idPns
 * @property string|null $nipBaru
 * @property string|null $nipLama
 * @property string|null $latihanStrukturalId
 * @property string|null $latihanStrukturalNama
 * @property string|null $nomor
 * @property string|null $tanggal
 * @property string|null $tahun
 * @property string|null $updated
 * @property string|null $tanggalSelesai
 * @property int|null $jumlahJam
 * @property string|null $institusiPenyelenggara
 */
class SiasnRwDiklat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siasn_rw_diklat';
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
            [['updated'], 'safe'],
            [['jumlahJam'], 'default', 'value' => null],
            [['jumlahJam'], 'integer'],
            [['id', 'idPns'], 'string', 'max' => 128],
            [['nipBaru'], 'string', 'max' => 18],
            [['nipLama'], 'string', 'max' => 9],
            [['latihanStrukturalId'], 'string', 'max' => 1],
            [['latihanStrukturalNama'], 'string', 'max' => 40],
            [['nomor'], 'string', 'max' => 100],
            [['tanggal', 'tanggalSelesai'], 'string', 'max' => 10],
            [['tahun'], 'string', 'max' => 4],
            [['institusiPenyelenggara'], 'string', 'max' => 200],
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
            'latihanStrukturalId' => 'Latihan Struktural ID',
            'latihanStrukturalNama' => 'Latihan Struktural Nama',
            'nomor' => 'Nomor',
            'tanggal' => 'Tanggal',
            'tahun' => 'Tahun',
            'updated' => 'Updated',
            'tanggalSelesai' => 'Tanggal Selesai',
            'jumlahJam' => 'Jumlah Jam',
            'institusiPenyelenggara' => 'Institusi Penyelenggara',
        ];
    }
}

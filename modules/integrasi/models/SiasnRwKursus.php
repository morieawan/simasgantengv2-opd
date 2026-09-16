<?php

namespace app\modules\integrasi\models;

use Yii;

/**
 * This is the model class for table "siasn_rw_kursus".
 *
 * @property string $id
 * @property string|null $idPns
 * @property string|null $nipBaru
 * @property string|null $nipLama
 * @property string|null $jenisKursusNama
 * @property string|null $jenisKursusSertifikat
 * @property string|null $institusiPenyelenggara
 * @property string|null $jenisKursusId
 * @property int|null $jumlahJam
 * @property string|null $namaKursus
 * @property string|null $noSertipikat
 * @property string|null $tahunKursus
 * @property string|null $tanggalKursus
 * @property string|null $jenisDiklatId
 * @property string|null $tglSelesaiKursus
 * @property string $updated
 */
class SiasnRwKursus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siasn_rw_kursus';
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
            [['jumlahJam'], 'default', 'value' => null],
            [['jumlahJam'], 'integer'],
            [['updated'], 'safe'],
            [['id', 'idPns', 'jenisKursusId'], 'string', 'max' => 128],
            [['nipBaru'], 'string', 'max' => 18],
            [['nipLama'], 'string', 'max' => 9],
            [['jenisKursusNama', 'jenisKursusSertifikat'], 'string', 'max' => 150],
            [['institusiPenyelenggara'], 'string', 'max' => 200],
            [['namaKursus', 'noSertipikat'], 'string', 'max' => 250],
            [['tahunKursus'], 'string', 'max' => 4],
            [['tanggalKursus', 'tanggalSelesaiKursus'], 'string', 'max' => 15],
            [['jenisDiklatId'], 'string', 'max' => 5],
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
            'jenisKursusNama' => 'Jenis Kursus Nama',
            'jenisKursusSertifikat' => 'Jenis Kursus Sertifikat',
            'institusiPenyelenggara' => 'Institusi Penyelenggara',
            'jenisKursusId' => 'Jenis Kursus ID',
            'jumlahJam' => 'Jumlah Jam',
            'namaKursus' => 'Nama Kursus',
            'noSertipikat' => 'No Sertipikat',
            'tahunKursus' => 'Tahun Kursus',
            'tanggalKursus' => 'Tanggal Kursus',
            'jenisDiklatId' => 'Jenis Diklat ID',
            'tanggalSelesaiKursus' => 'Tgl Selesai Kursus',
            'updated' => 'Updated',
        ];
    }
}

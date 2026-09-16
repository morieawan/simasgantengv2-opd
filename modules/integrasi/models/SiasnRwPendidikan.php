<?php

namespace app\modules\integrasi\models;

use Yii;

/**
 * This is the model class for table "siasn_rw_pendidikan".
 *
 * @property string $id
 * @property string|null $idPns
 * @property string|null $nipBaru
 * @property string|null $nipLama
 * @property string|null $pendidikanId
 * @property string|null $pendidikanNama
 * @property string|null $tkPendidikanId
 * @property string|null $tkPendidikanNama
 * @property string|null $tahunLulus
 * @property string|null $tglLulus
 * @property string|null $isPendidikanPertama
 * @property string|null $nomorIjasah
 * @property string|null $namaSekolah
 * @property string|null $gelarDepan
 * @property string|null $gelarBelakang
 * @property string|null $updated
 */
class SiasnRwPendidikan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siasn_rw_pendidikan';
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
            [['id', 'idPns', 'pendidikanId'], 'string', 'max' => 128],
            [['nipBaru'], 'string', 'max' => 18],
            [['nipLama'], 'string', 'max' => 9],
            [['pendidikanNama', 'tkPendidikanNama', 'nomorIjasah'], 'string', 'max' => 100],
            [['tkPendidikanId'], 'string', 'max' => 3],
            [['tahunLulus'], 'string', 'max' => 4],
            [['tglLulus'], 'string', 'max' => 10],
            [['isPendidikanPertama'], 'string', 'max' => 1],
            [['namaSekolah'], 'string', 'max' => 150],
            [['gelarDepan', 'gelarBelakang'], 'string', 'max' => 50],
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
            'pendidikanId' => 'Pendidikan ID',
            'pendidikanNama' => 'Pendidikan Nama',
            'tkPendidikanId' => 'Tk Pendidikan ID',
            'tkPendidikanNama' => 'Tk Pendidikan Nama',
            'tahunLulus' => 'Tahun Lulus',
            'tglLulus' => 'Tgl Lulus',
            'isPendidikanPertama' => 'Is Pendidikan Pertama',
            'nomorIjasah' => 'Nomor Ijasah',
            'namaSekolah' => 'Nama Sekolah',
            'gelarDepan' => 'Gelar Depan',
            'gelarBelakang' => 'Gelar Belakang',
            'updated' => 'Updated',
        ];
    }
}

<?php

namespace app\modules\integrasi\models;

use Yii;

/**
 * This is the model class for table "siasn_rw_jabatan".
 *
 * @property string $id
 * @property string|null $idPns
 * @property string|null $nipBaru
 * @property string|null $nipLama
 * @property string|null $jenisJabatan
 * @property string|null $instansiKerjaId
 * @property string|null $instansiKerjaNama
 * @property string|null $satuanKerjaId
 * @property string|null $satuanKerjaNama
 * @property string|null $unorId
 * @property string|null $unorNama
 * @property string|null $unorIndukId
 * @property string|null $unorIndukNama
 * @property string|null $eselon
 * @property string|null $eselonId
 * @property string|null $jabatanFungsionalId
 * @property string|null $jabatanFungsionalNama
 * @property string|null $jabatanFungsionalUmumId
 * @property string|null $jabatanFungsionalUmumNama
 * @property string|null $tmtJabatan
 * @property string|null $nomorSk
 * @property string|null $tanggalSk
 * @property string|null $namaUnor
 * @property string|null $namaJabatan
 * @property string|null $tmtPelantikan
 * @property string $updated
 * @property int|null $flag
 * @property string|null $by
 */
class SiasnRwJabatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siasn_rw_jabatan';
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
            [['flag'], 'default', 'value' => null],
            [['flag'], 'integer'],
            [['id', 'idPns', 'instansiKerjaId', 'satuanKerjaId', 'unorId', 'unorIndukId', 'jabatanFungsionalId', 'jabatanFungsionalUmumId'], 'string', 'max' => 128],
            [['nipBaru'], 'string', 'max' => 18],
            [['nipLama'], 'string', 'max' => 9],
            [['jenisJabatan', 'nomorSk'], 'string', 'max' => 50],
            [['instansiKerjaNama', 'satuanKerjaNama', 'unorNama', 'unorIndukNama', 'jabatanFungsionalNama', 'jabatanFungsionalUmumNama', 'namaUnor', 'namaJabatan'], 'string', 'max' => 150],
            [['eselon', 'tmtJabatan', 'tanggalSk', 'tmtPelantikan'], 'string', 'max' => 10],
            [['eselonId'], 'string', 'max' => 3],
            [['by'], 'string', 'max' => 255],
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
            'jenisJabatan' => 'Jenis Jabatan',
            'instansiKerjaId' => 'Instansi Kerja ID',
            'instansiKerjaNama' => 'Instansi Kerja Nama',
            'satuanKerjaId' => 'Satuan Kerja ID',
            'satuanKerjaNama' => 'Satuan Kerja Nama',
            'unorId' => 'Unor ID',
            'unorNama' => 'Unor Nama',
            'unorIndukId' => 'Unor Induk ID',
            'unorIndukNama' => 'Unor Induk Nama',
            'eselon' => 'Eselon',
            'eselonId' => 'Eselon ID',
            'jabatanFungsionalId' => 'Jabatan Fungsional ID',
            'jabatanFungsionalNama' => 'Jabatan Fungsional Nama',
            'jabatanFungsionalUmumId' => 'Jabatan Fungsional Umum ID',
            'jabatanFungsionalUmumNama' => 'Jabatan Fungsional Umum Nama',
            'tmtJabatan' => 'Tmt Jabatan',
            'nomorSk' => 'Nomor Sk',
            'tanggalSk' => 'Tanggal Sk',
            'namaUnor' => 'Nama Unor',
            'namaJabatan' => 'Nama Jabatan',
            'tmtPelantikan' => 'Tmt Pelantikan',
            'updated' => 'Updated',
            'flag' => 'Flag',
            'by' => 'By',
        ];
    }
}

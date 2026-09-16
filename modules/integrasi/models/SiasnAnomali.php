<?php

namespace app\modules\integrasi\models;

use Yii;

/**
 * This is the model class for table "siasn_anomali".
 *
 * @property string $nipBaru
 * @property string|null $idPns
 * @property string|null $nama
 * @property string|null $jenisJabatanId
 * @property string|null $jenisJabatan
 * @property string|null $jabatanId
 * @property string|null $jabatanNama
 * @property string|null $unorId
 * @property string|null $unorIndukNama
 * @property string|null $unorNama
 * @property string|null $kedudukanPnsId
 * @property string|null $kedudukanPnsNama
 * @property string|null $simpeg
 * @property string|null $skJabatan
 * @property string|null $skKP
 * @property string|null $updated
 * @property string|null $updateBy
 * @property string|null $verified
 * @property string|null $verifiedBy
 * @property int $flag
 */
class SiasnAnomali extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siasn_anomali';
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
            [['nipBaru'], 'required'],
            [['updated', 'verified'], 'safe'],
            [['flag'], 'default', 'value' => 0],
            [['flag'], 'integer'],
            [['nipBaru'], 'string', 'max' => 21],
            [['idPns', 'jenisJabatanId', 'jabatanId', 'unorId', 'kedudukanPnsId'], 'string', 'max' => 128],
            [['nama'], 'string', 'max' => 150],
            [['jenisJabatan'], 'string', 'max' => 50],
            [['jabatanNama', 'unorIndukNama', 'unorNama', 'kedudukanPnsNama', 'skJabatan', 'skKP', 'updateBy', 'verifiedBy'], 'string', 'max' => 200],
            [['simpeg'], 'string', 'max' => 10],
            [['simpeg'], 'default', 'value' => ''],
            [['comment'], 'string'],
            [['nipBaru'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nipBaru' => 'NIP',
            'idPns' => 'Id Pns',
            'nama' => 'Nama',
            'jenisJabatanId' => 'Jenis Jabatan ID',
            'jenisJabatan' => 'Jenis Jabatan',
            'jabatanId' => 'Jabatan ID',
            'jabatanNama' => 'Jabatan',
            'unorId' => 'Unor ID',
            'unorIndukNama' => 'Unor Induk',
            'unorNama' => 'Unor',
            'kedudukanPnsId' => 'Kedudukan Pns ID',
            'kedudukanPnsNama' => 'Kedudukan ASN',
            'simpeg' => 'Simpeg',
            'skJabatan' => 'SK Jabatan Terakhir',
            'skKP' => 'SK KP Terakhir',
            'updated' => 'Updated',
            'updateBy' => 'Update By',
            'verified' => 'Verified',
            'verifiedBy' => 'Verified By',
            'flag' => 'Flag',
            'comment' => 'Pesan', 
        ];
    }
}

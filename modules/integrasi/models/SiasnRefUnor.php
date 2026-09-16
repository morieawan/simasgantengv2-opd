<?php

namespace app\modules\integrasi\models;

use Yii;

/**
 * This is the model class for table "siasn_ref_unor".
 *
 * @property string $id
 * @property string $instansiId
 * @property string $diatasanId
 * @property int $eselonId
 * @property string $namaUnor
 * @property string $namaJabatan
 * @property string $aktif
 * @property string|null $cepatKode
 * @property string|null $simpeg
 * @property string|null $pembacaan
 * @property string $updated
 */
class SiasnRefUnor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siasn_ref_unor';
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
            [['id', 'instansiId', 'diatasanId', 'eselonId', 'namaUnor', 'namaJabatan'], 'required'],
            [['eselonId'], 'default', 'value' => null],
            [['eselonId'], 'integer'],
            [['updated'], 'safe'],
            [['id', 'instansiId', 'diatasanId'], 'string', 'max' => 100],
            [['namaUnor', 'namaJabatan', 'pembacaan'], 'string', 'max' => 255],
            [['aktif'], 'string', 'max' => 1],
            [['cepatKode'], 'string', 'max' => 20],
            [['simpeg'], 'string', 'max' => 10],
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
            'instansiId' => 'Instansi ID',
            'diatasanId' => 'Diatasan ID',
            'eselonId' => 'Eselon ID',
            'namaUnor' => 'Nama Unor',
            'namaJabatan' => 'Nama Jabatan',
            'aktif' => 'Aktif',
            'cepatKode' => 'Cepat Kode',
            'simpeg' => 'Simpeg',
            'pembacaan' => 'Pembacaan',
            'updated' => 'Updated',
        ];
    }
}

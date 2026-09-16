<?php

namespace app\modules\integrasi\models;

use Yii;

/**
 * This is the model class for table "siasn_rw_pnsunor".
 *
 * @property string $id
 * @property string|null $unorBaru
 * @property string|null $pnsOrang
 * @property string|null $skNomor
 * @property string|null $skTanggal
 * @property string|null $namaUnorBaru
 * @property string|null $asalId
 * @property string|null $asalNama
 * @property string|null $instansi
 * @property string|null $asalNamaLabel
 * @property string|null $updated
 */
class SiasnRwPnsunor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siasn_rw_pnsunor';
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
            [['skTanggal', 'updated'], 'safe'],
            [['id', 'unorBaru', 'pnsOrang', 'asalId', 'instansi'], 'string', 'max' => 32],
            [['skNomor', 'namaUnorBaru', 'asalNama', 'asalNamaLabel'], 'string', 'max' => 100],
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
            'unorBaru' => 'Unor Baru',
            'pnsOrang' => 'Pns Orang',
            'skNomor' => 'Sk Nomor',
            'skTanggal' => 'Sk Tanggal',
            'namaUnorBaru' => 'Nama Unor Baru',
            'asalId' => 'Asal ID',
            'asalNama' => 'Asal Nama',
            'instansi' => 'Instansi',
            'asalNamaLabel' => 'Asal Nama Label',
            'updated' => 'Updated',
        ];
    }
}

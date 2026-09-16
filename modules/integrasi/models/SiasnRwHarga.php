<?php

namespace app\modules\integrasi\models;

use Yii;

/**
 * This is the model class for table "siasn_rw_harga".
 *
 * @property string $ID
 * @property int|null $tahun
 * @property string|null $skNomor
 * @property string|null $skDate
 * @property string|null $hargaNama
 * @property string|null $hargaId
 * @property string|null $pnsOrangId
 * @property string|null $nip
 * @property string $updated
 */
class SiasnRwHarga extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siasn_rw_harga';
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
            [['ID'], 'required'],
            [['tahun'], 'default', 'value' => null],
            [['tahun'], 'integer'],
            [['updated'], 'safe'],
            [['ID', 'pnsOrangId'], 'string', 'max' => 128],
            [['skNomor'], 'string', 'max' => 100],
            [['skDate'], 'string', 'max' => 15],
            [['hargaNama'], 'string', 'max' => 150],
            [['hargaId'], 'string', 'max' => 5],
            [['nip'], 'string', 'max' => 21],
            [['ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'tahun' => 'Tahun',
            'skNomor' => 'Nomor SK',
            'skDate' => 'Tgl SK',
            'hargaNama' => 'Nama Penghargaan',
            'hargaId' => 'Harga ID',
            'pnsOrangId' => 'Pns Orang ID',
            'nip' => 'NIP',
            'updated' => 'Updated',
        ];
    }
}

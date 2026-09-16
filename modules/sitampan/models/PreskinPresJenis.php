<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "preskin_pres_jenis".
 *
 * @property string $kd_presensi
 * @property string $keterangan
 * @property int|null $selisih_waktu
 * @property float|null $persen_pot
 * @property string $updated
 */
class PreskinPresJenis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preskin_pres_jenis';
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
            [['kd_presensi', 'keterangan'], 'required'],
            [['selisih_waktu'], 'default', 'value' => null],
            [['selisih_waktu'], 'integer'],
            [['persen_pot'], 'number'],
            [['updated'], 'safe'],
            [['kd_presensi'], 'string', 'max' => 5],
            [['keterangan'], 'string', 'max' => 100],
            [['kd_presensi'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kd_presensi' => 'Kd Presensi',
            'keterangan' => 'Keterangan',
            'selisih_waktu' => 'Selisih Waktu',
            'persen_pot' => 'Persen Pot',
            'updated' => 'Updated',
        ];
    }
}

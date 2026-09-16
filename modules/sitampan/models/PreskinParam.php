<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "preskin_param".
 *
 * @property int $id
 * @property int $menit_pres
 * @property int $menit_kin
 * @property int $batas_pres
 * @property int $batas_kin1
 * @property int $batas_kin2
 * @property int $batas_kin_nilai
 * @property string $updated
 */
class PreskinParam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preskin_param';
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
            [['id', 'menit_pres', 'menit_kin', 'batas_pres', 'batas_kin1', 'batas_kin2', 'batas_kin_nilai'], 'default', 'value' => 0],
            [['id', 'menit_pres', 'menit_kin', 'batas_pres', 'batas_kin1', 'batas_kin2', 'batas_kin_nilai'], 'integer'],
            [['updated'], 'safe'],
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
            'menit_pres' => 'Menit Presensi',
            'menit_kin' => 'Menit Kinerja',
            'batas_pres' => 'Batas Pengisian Keterangan Presensi',
            'batas_kin1' => 'Batas Pengisian Kinerja 1',
            'batas_kin2' => 'Batas Pengisian Kinerja 2',
            'batas_kin_nilai' => 'Batas Penilaian Kinerja',
            'updated' => 'Updated',
        ];
    }
}

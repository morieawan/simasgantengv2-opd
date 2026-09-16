<?php

namespace app\modules\gaji\models;

use Yii;

/**
 * This is the model class for table "gaji_satker_tbl".
 *
 * @property string $KDSATKER
 * @property string $KDSSBP
 * @property string $KDSKPD
 * @property string $TMTSTOP
 * @property string|null $NMSATKER
 * @property string|null $KDDATI1
 * @property string|null $KDDATI2
 * @property string|null $KDDATI3
 * @property string|null $KDDATI4
 * @property string|null $KDCABTASPEN
 * @property string|null $NMKEPALA
 * @property string|null $NIPKEPALA
 * @property string|null $NMBENDAHARA
 * @property string|null $NIPBENDAHARA
 * @property string|null $NMPEMBUATDAFTAR
 * @property string|null $NIPPEMBUATDAFTAR
 * @property string|null $NOREK
 * @property string|null $ALAMAT
 * @property string|null $NOTELP
 * @property string|null $KOTA
 * @property string|null $NPWP
 * @property string|null $JAB_KEPALA
 * @property string|null $JAB_BENDAHARA
 * @property string|null $JAB_PEMBUATDAFTAR
 * @property string|null $subskpd
 * @property string|null $id_satker
 */
class SimasGajiSatkerTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gaji_satker_tbl';
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
            [['KDSATKER', 'KDSSBP', 'KDSKPD', 'TMTSTOP'], 'required'],
            [['TMTSTOP'], 'safe'],
            [['KDSATKER', 'NMKEPALA', 'ALAMAT', 'NOTELP', 'id_satker'], 'string', 'max' => 20],
            [['KDSSBP', 'KDSKPD', 'KDDATI4', 'KDCABTASPEN', 'subskpd'], 'string', 'max' => 3],
            [['NMSATKER'], 'string', 'max' => 75],
            [['KDDATI1', 'KDDATI2', 'KDDATI3'], 'string', 'max' => 2],
            [['NIPKEPALA', 'NIPBENDAHARA', 'NIPPEMBUATDAFTAR'], 'string', 'max' => 18],
            [['NMBENDAHARA', 'NMPEMBUATDAFTAR'], 'string', 'max' => 50],
            [['NOREK', 'KOTA', 'NPWP'], 'string', 'max' => 30],
            [['JAB_KEPALA', 'JAB_BENDAHARA', 'JAB_PEMBUATDAFTAR'], 'string', 'max' => 60],
            [['KDSATKER', 'KDSSBP', 'KDSKPD'], 'unique', 'targetAttribute' => ['KDSATKER', 'KDSSBP', 'KDSKPD']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KDSATKER' => 'Kdsatker',
            'KDSSBP' => 'Kdssbp',
            'KDSKPD' => 'Kdskpd',
            'TMTSTOP' => 'Tmtstop',
            'NMSATKER' => 'Nmsatker',
            'KDDATI1' => 'Kddati1',
            'KDDATI2' => 'Kddati2',
            'KDDATI3' => 'Kddati3',
            'KDDATI4' => 'Kddati4',
            'KDCABTASPEN' => 'Kdcabtaspen',
            'NMKEPALA' => 'Nmkepala',
            'NIPKEPALA' => 'Nipkepala',
            'NMBENDAHARA' => 'Nmbendahara',
            'NIPBENDAHARA' => 'Nipbendahara',
            'NMPEMBUATDAFTAR' => 'Nmpembuatdaftar',
            'NIPPEMBUATDAFTAR' => 'Nippembuatdaftar',
            'NOREK' => 'Norek',
            'ALAMAT' => 'Alamat',
            'NOTELP' => 'Notelp',
            'KOTA' => 'Kota',
            'NPWP' => 'Npwp',
            'JAB_KEPALA' => 'Jab Kepala',
            'JAB_BENDAHARA' => 'Jab Bendahara',
            'JAB_PEMBUATDAFTAR' => 'Jab Pembuatdaftar',
            'subskpd' => 'Subskpd',
            'id_satker' => 'Id Satker',
        ];
    }
}

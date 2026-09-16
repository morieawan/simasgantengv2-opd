<?php

namespace app\modules\gaji\models;

use Yii;

/**
 * This is the model class for table "skpd_tbl".
 *
 * @property string $KdDati1
 * @property string $KdDati2
 * @property string $KDSKPD
 * @property string $KDSSBP
 * @property string|null $TMTSTOP
 * @property string|null $NMSKPD
 * @property string|null $NMKEPALA
 * @property string|null $NIPKEPALA
 * @property string|null $NMBENDAHARA
 * @property string|null $NIPBENDAHARA
 * @property string|null $NMPEMBUATDAFTAR
 * @property string|null $NIPPEMBUATDAFTAR
 * @property string|null $NOREK
 * @property string|null $NPWP
 * @property string|null $KOTA
 * @property string|null $JAB_KEPALA
 * @property string|null $JAB_BENDAHARA
 * @property string|null $JAB_PEMBUATDAFTAR
 * @property string|null $NMPPTK Pejabat Pelaksana Teknis Kegiatan
 * @property string|null $NIPPPTK
 * @property string|null $JABPPTK
 * @property string|null $NOTELP
 * @property string|null $alamat
 * @property string|null $bank_prsp
 */
class DbgajidoSkpdTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'skpd_tbl';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db5');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['KdDati1', 'KdDati2', 'KDSKPD', 'KDSSBP'], 'required'],
            [['TMTSTOP'], 'safe'],
            [['KdDati1', 'KdDati2'], 'string', 'max' => 2],
            [['KDSKPD', 'KDSSBP'], 'string', 'max' => 3],
            [['NMSKPD'], 'string', 'max' => 70],
            [['NMKEPALA', 'NMBENDAHARA', 'NMPEMBUATDAFTAR'], 'string', 'max' => 50],
            [['NIPKEPALA', 'NIPBENDAHARA', 'NIPPEMBUATDAFTAR', 'NIPPPTK'], 'string', 'max' => 18],
            [['NOREK'], 'string', 'max' => 20],
            [['NPWP'], 'string', 'max' => 25],
            [['KOTA', 'NOTELP'], 'string', 'max' => 30],
            [['JAB_KEPALA', 'JAB_BENDAHARA', 'JAB_PEMBUATDAFTAR', 'alamat'], 'string', 'max' => 60],
            [['NMPPTK', 'JABPPTK', 'bank_prsp'], 'string', 'max' => 100],
            [['KdDati1', 'KdDati2', 'KDSKPD', 'KDSSBP'], 'unique', 'targetAttribute' => ['KdDati1', 'KdDati2', 'KDSKPD', 'KDSSBP']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KdDati1' => 'Kd Dati1',
            'KdDati2' => 'Kd Dati2',
            'KDSKPD' => 'Kdskpd',
            'KDSSBP' => 'Kdssbp',
            'TMTSTOP' => 'Tmtstop',
            'NMSKPD' => 'Nmskpd',
            'NMKEPALA' => 'Nmkepala',
            'NIPKEPALA' => 'Nipkepala',
            'NMBENDAHARA' => 'Nmbendahara',
            'NIPBENDAHARA' => 'Nipbendahara',
            'NMPEMBUATDAFTAR' => 'Nmpembuatdaftar',
            'NIPPEMBUATDAFTAR' => 'Nippembuatdaftar',
            'NOREK' => 'Norek',
            'NPWP' => 'Npwp',
            'KOTA' => 'Kota',
            'JAB_KEPALA' => 'Jab Kepala',
            'JAB_BENDAHARA' => 'Jab Bendahara',
            'JAB_PEMBUATDAFTAR' => 'Jab Pembuatdaftar',
            'NMPPTK' => 'Nmpptk',
            'NIPPPTK' => 'Nippptk',
            'JABPPTK' => 'Jabpptk',
            'NOTELP' => 'Notelp',
            'alamat' => 'Alamat',
            'bank_prsp' => 'Bank Prsp',
        ];
    }
}

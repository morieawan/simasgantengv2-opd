<?php

namespace app\modules\gaji\models;

use Yii;

/**
 * This is the model class for table "gaji_stapeg_tbl".
 *
 * @property int $KDSTAPEG
 * @property string|null $NMSTAPEG
 * @property int|null $kd_jns_peg
 * @property int|null $aktif
 */
class SimasGajiStapegTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gaji_stapeg_tbl';
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
            [['KDSTAPEG'], 'required'],
            [['KDSTAPEG', 'kd_jns_peg', 'aktif'], 'default', 'value' => null],
            [['KDSTAPEG', 'kd_jns_peg', 'aktif'], 'integer'],
            [['NMSTAPEG'], 'string', 'max' => 150],
            [['KDSTAPEG'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KDSTAPEG' => 'Kdstapeg',
            'NMSTAPEG' => 'Nmstapeg',
            'kd_jns_peg' => 'Kd Jns Peg',
            'aktif' => 'Aktif',
        ];
    }
}

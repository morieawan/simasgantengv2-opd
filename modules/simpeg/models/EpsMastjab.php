<?php

namespace app\modules\simpeg\models;

use Yii;

/**
 * This is the model class for table "eps_mastjab".
 *
 * @property int $ID
 * @property string $B_02
 * @property string $A_01
 * @property int $A_02
 * @property string $A_03
 * @property string $A_04
 * @property string $A_05
 * @property int $POS
 * @property string $A_06
 */
class EpsMastjab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eps_mastjab';
    }

    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    public $jab;
    public $subBidang;
    public $bidang;
    public $jabportal;
    public $ttjab;
    public $unor;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['B_02', 'A_04', 'A_05'], 'required'],
            [['A_02', 'POS', 'jab'], 'integer'],
            [['A_04', 'A_05'], 'safe'],
            [['B_02'], 'string', 'max' => 18],
            [['A_01', 'A_06'], 'string', 'max' => 255],
            [['A_03'], 'string', 'max' => 80],
            [['jabportal'], 'string', 'max' => 10],
            [['siasn'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'B_02' => 'NIP',
            'A_01' => 'Nama Jabatan',
            'A_02' => 'Eselon',
            'A_03' => 'No SK Jabatan',
            'A_04' => 'Tgl SK Jabatan',
            'A_05' => 'TMT Jabatan',
            'POS' => 'Pos',
            'A_06' => 'Instansi',
            'unor' => 'Unor',
            'siasn' => 'ID SIASN',
        ];
    }

    public static function Primarykey()
    {
        return ['ID'];
    }

    public function getMasjabEsel()
    {
        return $this->hasOne(EpsTesel::className(), ['KODE' => 'A_02']);
    }
}

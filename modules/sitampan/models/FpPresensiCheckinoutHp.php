<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "presensi_checkinout_hp".
 *
 * @property string|null $kode
 * @property string|null $nip
 * @property string|null $checktime
 * @property string|null $sn
 * @property string|null $light
 */
class FpPresensiCheckinoutHp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'presensi_checkinout_hp';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db7');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['checktime'], 'safe'],
            [['kode'], 'string', 'max' => 100],
            [['nip'], 'string', 'max' => 20],
            [['sn'], 'string', 'max' => 255],
            [['light'], 'string', 'max' => 10],
            [['flag'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'nip' => 'NIP',
            'checktime' => 'Checktime',
            'sn' => 'SN',
            'light' => 'Light',
            'flag' => 'Flag',
        ];
    }

    public static function primaryKey()
    {
        return ["nip", "checktime"];
    }

    public function getPresAsn()  
    {  
        return $this->hasOne(PreskinAsn::className(), ['nip' => 'nip']);  
    }

}

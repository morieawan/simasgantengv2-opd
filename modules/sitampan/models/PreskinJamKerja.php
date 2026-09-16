<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "preskin_jam_kerja".
 *
 * @property int $id
 * @property int $jenis_hari_kerja
 * @property int|null $hari
 * @property string|null $jam_masuk
 * @property string|null $jam_pulang
 * @property string $updated
 */
class PreskinJamKerja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preskin_jam_kerja';
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
            [['id', 'jenis_hari_kerja'], 'required'],
            [['id', 'jenis_hari_kerja', 'hari'], 'default', 'value' => null],
            [['id', 'jenis_hari_kerja', 'hari'], 'integer'],
            [['jam_masuk', 'jam_pulang', 'updated'], 'safe'],
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
            'jenis_hari_kerja' => 'Jenis Hari Kerja',
            'hari' => 'Hari',
            'jam_masuk' => 'Jam Masuk',
            'jam_pulang' => 'Jam Pulang',
            'updated' => 'Updated',
        ];
    }
    public function getJamHariKerja()  
    {  
        return $this->hasOne(PreskinHariKerja::className(), ['id' => 'jenis_hari_kerja']);  
    }
}

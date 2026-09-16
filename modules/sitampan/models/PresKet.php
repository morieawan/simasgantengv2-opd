<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "pres_ket".
 *
 * @property string $id kode opd group + datetime(int)
 * @property string|null $opd opd group user
 * @property int $jenis_ket
 * @property string $no_surat
 * @property string $tgl_surat
 * @property string $tgl_awal
 * @property string $tgl_akhir
 * @property string|null $nip
 * @property string|null $detail
 * @property int $flag
 * @property string $updated
 */
class PresKet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pres_ket';
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
            [['id', 'jenis_ket', 'no_surat', 'tgl_surat', 'tgl_awal', 'tgl_akhir'], 'required'],
            [['jenis_ket', 'flag'], 'default', 'value' => 0],
            [['jenis_ket', 'flag'], 'integer'],
            [['tgl_surat', 'tgl_awal', 'tgl_akhir', 'updated', 'nip'], 'safe'],
            [['detail'], 'string'],
            [['id'], 'string', 'max' => 50],
            [['opd'], 'string', 'max' => 10],
            [['no_surat'], 'string', 'max' => 30],
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
            'opd' => 'Opd',
            'jenis_ket' => 'Jenis Ket',
            'no_surat' => 'No Surat',
            'tgl_surat' => 'Tgl Surat',
            'tgl_awal' => 'Tgl Awal',
            'tgl_akhir' => 'Tgl Akhir',
            'nip' => 'NIP',
            'detail' => 'Detail',
            'flag' => 'Flag',
            'updated' => 'Updated',
        ];
    }

    public function getJenisSuket()  
    {  
        return $this->hasOne(PresKetJenis::className(), ['id' => 'jenis_ket']);  
    }  

    public static function primaryKey()  
    {  
        return ["id"];  
    } 
}

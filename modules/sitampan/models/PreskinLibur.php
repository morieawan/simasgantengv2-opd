<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "preskin_libur".
 *
 * @property string $tanggal
 * @property int $ket_libur
 * @property string|null $detail
 * @property string $updated
 */
class PreskinLibur extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preskin_libur';
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
            [['tanggal', 'ket_libur'], 'required'],
            [['tanggal', 'updated'], 'safe'],
            [['ket_libur'], 'default', 'value' => null],
            [['ket_libur'], 'integer'],
            [['detail'], 'string', 'max' => 100],
            [['tanggal'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tanggal' => 'Tanggal',
            'ket_libur' => 'Ket Libur',
            'detail' => 'Detail',
            'updated' => 'Updated',
        ];
    }

    public function getLiburKet()  
    {  
        return $this->hasOne(PreskinLiburJenis::className(), ['id' => 'ket_libur']);  
    }
}

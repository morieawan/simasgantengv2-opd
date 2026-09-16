<?php

namespace app\modules\simpeg\models;

use Yii;

/**
 * This is the model class for table "eps_tablokb".
 *
 * @property string $KOLOK
 * @property int $ESEL
 * @property string $NALOK
 */
class EpsTablokb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eps_tablokb';
    }

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
            [['ESEL', 'flag'], 'integer'],
            [['NALOK'], 'string', 'max' => 255],
            [['KOLOK', 'NALOK'], 'string', 'max' => 10],
            [['flag'], 'default', 'value' => 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KOLOK' => 'KODE UNOR',
            'ESEL' => 'ESELON',
            'NALOK' => 'NAMA UNOR',
            'INDUK' => 'INDUK',
            'KELOMPOK' => 'KELOMPOK',
            'flag' => 'Flag',
        ];
    }

    public function getTablok() 
    { 
       return $this->hasOne(EpsTablok::className(), ['LEFT(KD,2)' => 'LEFT(KOLOK,2)']); 
    }

    public function getTablokEsel()
    {
        return $this->hasOne(EpsTesel::className(), ['KODE' => 'ESEL']);
    }

    public function getTbjab() 
    { 
       return $this->hasOne(EpsTbjab::className(), ['KOJAB' => 'KOLOK']); 
    }

    public function getOpd($id) 
    { 
        if(
            $id == '51'
            || $id == '52'
            || $id == '53'
            || $id == '54'
            || $id == '55'
            || $id == '56'
            || $id == '57'
            || $id == '58'
            || $id == '59'
            || $id == '60'
            || $id == '61'
            || $id == '62'
            || $id == '63'
            || $id == '64'
            || $id == '65'
            || $id == '66'
            || $id == '67'
        ) $opd = '50000000'; 
        else $opd = $id.'000000'; 
        
        //return $opd;
        return EpsTablokb::findOne($opd)['NALOK'];
    }

    public function getUnor($id) 
    { 
        if(EpsTablokb::findOne($id) === null) return $id;
        else return EpsTablokb::findOne($id)['NALOK'];
    }

    public static function primaryKey()
    {
        return ["KOLOK"];
    }

}

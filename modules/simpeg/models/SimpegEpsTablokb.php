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
class SimpegEpsTablokb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eps_tablokb';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db3');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ESEL'], 'integer'],
            [['KOLOK', 'NALOK'], 'string', 'max' => 255],
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
}

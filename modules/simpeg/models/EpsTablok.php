<?php

namespace app\modules\simpeg\models;

use Yii;

/**
 * This is the model class for table "eps_tablok".
 *
 * @property string $KD
 * @property string $NM
 */
class EpsTablok extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eps_tablok';
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
            [['KD', 'NM'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KD' => 'KODE OPD',
            'NM' => 'NAMA OPD',
        ];
    }

    public static function Primarykey()
    {
        return ['KD'];
    }

    public function getTablokNamaUnor() 
   { 
       return $this->hasMany(\app\models\SapkUnor::className(), ['namaunor' => 'NM']); 
   }
}

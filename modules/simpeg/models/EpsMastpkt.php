<?php

namespace app\modules\simpeg\models;

use Yii;

/**
 * This is the model class for table "eps_mastpkt".
 *
 * @property int $ID
 * @property int $A_01
 * @property string $A_02
 * @property string $A_03
 * @property string $A_04
 * @property string $B_02
 * @property int $POS
 */
class EpsMastpkt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eps_mastpkt';
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
            [['A_01', 'POS'], 'integer'],
            [['A_03', 'A_04', 'B_02'], 'required'],
            [['A_03', 'A_04'], 'safe'],
            [['A_02'], 'string', 'max' => 50],
            [['B_02'], 'string', 'max' => 18],
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
            'A_01' => 'Pangkat/ Gol. Ruang',
            'A_02' => 'No. SK',
            'A_03' => 'Tgl SK',
            'A_04' => 'TMT',
            'B_02' => 'NIP',
            'POS' => 'Pos',
            'siasn' => 'ID SIASN',
        ];
    }

    public static function Primarykey()
    {
        return ['ID'];
    }

    public function getMaspktTgol()
    {
        return $this->hasOne(EpsTgolru::className(), ['KODE' => 'A_01']);
    }

    public static function mastpktData($id)
    {
        $simpeg = EpsMastpkt::find()->where(['B_02' => $id])->asArray()->one();
        $simpeg_attr = EpsMastpkt::getTableSchema()->getColumnNames();

        foreach($simpeg_attr as $atts => $vas){
            if(EpsMastfip::getTableSchema()->getColumn($vas)->type == 'date') $simpeg["$vas"] = fungsi::tgldmy($simpeg["$vas"]);
        }

        return $simpeg;
    }
}

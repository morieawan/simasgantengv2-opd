<?php

namespace app\modules\simpeg\models;

use Yii;

/**
 * This is the model class for table "eps_tgolru".
 *
 * @property int $KODE
 * @property string $NAMA
 * @property string $PANJANG
 */
class SimpegEpsTgolru extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eps_tgolru';
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
            [['KODE'], 'required'],
            [['KODE'], 'integer'],
            [['NAMA'], 'string', 'max' => 6],
            [['PANJANG'], 'string', 'max' => 100],
            [['KODE'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KODE' => 'Kode',
            'NAMA' => 'Nama',
            'PANJANG' => 'Panjang',
        ];
    }
}

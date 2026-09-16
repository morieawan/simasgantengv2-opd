<?php

namespace app\modules\simpeg\models;

use Yii;

/**
 * This is the model class for table "eps_konstan_statuskepegawaian".
 *
 * @property int $kode
 * @property string $nama
 */
class SimpegEpsKonstanStatuskepegawaian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eps_konstan_statuskepegawaian';
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
            [['kode', 'nama'], 'required'],
            [['kode'], 'integer'],
            [['nama'], 'string', 'max' => 100],
            [['kode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'nama' => 'Nama',
        ];
    }
}

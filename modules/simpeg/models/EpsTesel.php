<?php

namespace app\modules\simpeg\models;

use Yii;

/**
 * This is the model class for table "eps_tesel".
 *
 * @property int $KODE
 * @property string $NAMA
 */
class EpsTesel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eps_tesel';
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
            [['KODE'], 'required'],
            [['KODE'], 'integer'],
            [['NAMA'], 'string', 'max' => 6],
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
        ];
    }
}

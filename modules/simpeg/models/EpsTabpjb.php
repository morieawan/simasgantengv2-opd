<?php

namespace app\modules\simpeg\models;

use Yii;

/**
 * This is the model class for table "eps_tabpjb".
 *
 * @property int $KODE
 * @property string $NAMA
 */
class EpsTabpjb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eps_tabpjb';
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
            [['NAMA'], 'required'],
            [['NAMA'], 'string', 'max' => 255],
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

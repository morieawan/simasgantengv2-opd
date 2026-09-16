<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "pres_ket_jenis".
 *
 * @property int $id
 * @property string|null $jenis_ket
 * @property string|null $kode
 */
class PresKetJenis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pres_ket_jenis';
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
            [['id'], 'required'],
            [['id'], 'default', 'value' => null],
            [['id'], 'integer'],
            [['jenis_ket'], 'string', 'max' => 100],
            [['kode'], 'string', 'max' => 10],
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
            'jenis_ket' => 'Jenis Ket',
            'kode' => 'Kode',
        ];
    }
}

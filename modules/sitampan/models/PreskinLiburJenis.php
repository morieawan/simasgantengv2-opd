<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "preskin_libur_jenis".
 *
 * @property int $id
 * @property string|null $ket_libur
 * @property string $updated
 */
class PreskinLiburJenis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preskin_libur_jenis';
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
            [['updated'], 'safe'],
            [['ket_libur'], 'string', 'max' => 50],
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
            'ket_libur' => 'Ket Libur',
            'updated' => 'Updated',
        ];
    }
}

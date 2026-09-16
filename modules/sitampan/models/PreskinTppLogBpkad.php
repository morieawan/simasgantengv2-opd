<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "preskin_tpp_log_bpkad".
 *
 * @property string $id timestamp-nip
 * @property string|null $nama
 * @property string|null $tgl_final
 */
class PreskinTppLogBpkad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preskin_tpp_log_bpkad';
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
            [['tgl_final'], 'safe'],
            [['id'], 'string', 'max' => 50],
            [['nama'], 'string', 'max' => 150],
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
            'nama' => 'Nama',
            'tgl_final' => 'Tgl Final',
        ];
    }
}

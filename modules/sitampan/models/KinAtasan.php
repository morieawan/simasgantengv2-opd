<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "kin_atasan".
 *
 * @property string $nip
 * @property string|null $nama
 * @property string|null $tablok
 * @property string|null $tablokb
 * @property string|null $nip_atasan
 * @property string|null $nama_atasan
 * @property string|null $tablok_atasan
 * @property string|null $tablokb_atasan
 * @property string $updated
 */
class KinAtasan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kin_atasan';
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
            [['nip'], 'required'],
            [['updated'], 'safe'],
            [['nip', 'nip_atasan'], 'string', 'max' => 21],
            [['nama', 'nama_atasan'], 'string', 'max' => 100],
            [['tablok', 'tablokb', 'tablok_atasan', 'tablokb_atasan'], 'string', 'max' => 10],
            [['nip'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nip' => 'NIP',
            'nama' => 'Nama',
            'tablok' => 'Unit Kerja',
            'tablokb' => 'Unit Organisasi',
            'nip_atasan' => 'NIP Atasan',
            'nama_atasan' => 'Nama Atasan',
            'tablok_atasan' => 'Tablok Atasan',
            'tablokb_atasan' => 'Tablokb Atasan',
            'updated' => 'Updated',
        ];
    }
}

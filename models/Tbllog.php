<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbllog".
 *
 * @property string $tgl
 * @property string $idpns
 * @property string $data
 * @property string $aksi
 * @property string $oleh
 */
class Tbllog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbllog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl', 'id', 'data', 'aksi', 'oleh'], 'required'],
            [['tgl'], 'safe'],
            [['id'], 'string', 'max' => 100],
            [['data', 'aksi', 'oleh'], 'string', 'max' => 150],
            [['tgl', 'id'], 'unique', 'targetAttribute' => ['tgl', 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tgl' => 'Tgl',
            'id' => 'Id',
            'data' => 'Data',
            'aksi' => 'Aksi',
            'oleh' => 'Oleh',
        ];
    }
}

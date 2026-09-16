<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "preskin_wfh".
 *
 * @property string $id_wfh
 * @property string|null $nip
 * @property string|null $tgl
 */
class PreskinWfh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preskin_wfh';
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
            [['id_wfh', 'nip', 'tgl'], 'required'],
            [['tgl'], 'safe'],
            [['id_wfh'], 'string', 'max' => 50],
            [['nip'], 'safe'],
            [['id_wfh'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_wfh' => 'Id Wfh',
            'nip' => 'NIP',
            'tgl' => 'Tgl',
        ];
    }
}

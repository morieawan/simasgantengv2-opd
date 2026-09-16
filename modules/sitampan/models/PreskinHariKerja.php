<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "preskin_hari_kerja".
 *
 * @property int $id
 * @property string|null $jenis
 * @property string $updated
 */
class PreskinHariKerja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preskin_hari_kerja';
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
            [['id'], 'default', 'value' => 0],
            [['id'], 'integer'],
            [['updated'], 'safe'],
            [['jenis'], 'string', 'max' => 50],
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
            'jenis' => 'Jenis',
            'updated' => 'Updated',
        ];
    }
    
}

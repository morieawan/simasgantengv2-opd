<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "kin_jenis_output".
 *
 * @property int $id
 * @property string $jenis_output
 */
class KinJenisOutput extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kin_jenis_output';
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
            [['id', 'jenis_output'], 'required'],
            [['id'], 'default', 'value' => null],
            [['id'], 'integer'],
            [['jenis_output'], 'string', 'max' => 50],
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
            'jenis_output' => 'Jenis Output',
        ];
    }
}

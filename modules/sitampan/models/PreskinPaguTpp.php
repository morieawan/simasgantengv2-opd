<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "preskin_pagu_tpp".
 *
 * @property int $id
 * @property string $kelas
 * @property int $pagu
 * @property string|null $ket
 * @property int $flag
 * @property string $updated
 */
class PreskinPaguTpp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preskin_pagu_tpp';
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
            [['id', 'kelas', 'flag'], 'required'],
            [['id', 'pagu', 'flag'], 'default', 'value' => 0],
            [['id', 'pagu', 'flag'], 'integer'],
            [['ket'], 'string'],
            [['updated'], 'safe'],
            [['kelas'], 'string', 'max' => 50],
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
            'kelas' => 'Kelas',
            'pagu' => 'Pagu',
            'ket' => 'Ket',
            'flag' => 'Flag',
            'updated' => 'Updated',
        ];
    }
}

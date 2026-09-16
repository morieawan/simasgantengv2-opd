<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "preskin_group_cetak".
 *
 * @property string $unor
 * @property string|null $cetak_group
 * @property string|null $opd_group
 * @property string|null $opd
 * @property int $flag
 * @property string $updated
 */
class PreskinGroupCetak extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preskin_group_cetak';
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
            [['unor'], 'required'],
            [['flag'], 'default', 'value' => null],
            [['flag'], 'integer'],
            [['updated'], 'safe'],
            [['unor', 'cetak_group', 'opd_group'], 'string', 'max' => 10],
            [['opd'], 'string', 'max' => 255],
            [['unor'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'unor' => 'Unor',
            'cetak_group' => 'Cetak Group',
            'opd_group' => 'Opd Group',
            'opd' => 'Opd',
            'flag' => 'Flag',
            'updated' => 'Updated',
        ];
    }
}

<?php

namespace app\modules\simpeg\models;

use Yii;

/**
 * This is the model class for table "eps_tbjab".
 *
 * @property string $KOJAB
 * @property string $ESEL
 * @property string $NAJAB
 */
class SimpegEpsTbjab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eps_tbjab';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db3');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['KOJAB', 'ESEL', 'NAJAB'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KOJAB' => 'Kojab',
            'ESEL' => 'Esel',
            'NAJAB' => 'Najab',
        ];
    }
}

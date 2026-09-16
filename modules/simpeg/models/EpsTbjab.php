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
class EpsTbjab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eps_tbjab';
    }

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

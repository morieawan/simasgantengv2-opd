<?php

namespace app\modules\simpeg\models;

use Yii;

/**
 * This is the model class for table "eps_tabstaf".
 *
 * @property string $KOJAB
 * @property string $NAJAB
 * @property int $ESEL
 */
class SimpegEpsTabstaf extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eps_tabstaf';
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
            [['KOJAB', 'NAJAB', 'ESEL'], 'required'],
            [['ESEL'], 'integer'],
            [['KOJAB'], 'string', 'max' => 6],
            [['NAJAB'], 'string', 'max' => 100],
            [['KOJAB'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KOJAB' => 'Kojab',
            'NAJAB' => 'Najab',
            'ESEL' => 'Esel',
        ];
    }
}

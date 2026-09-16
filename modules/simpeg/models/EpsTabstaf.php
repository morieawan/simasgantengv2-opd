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
class EpsTabstaf extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eps_tabstaf';
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

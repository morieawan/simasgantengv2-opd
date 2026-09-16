<?php

namespace app\modules\simpeg\models;

use Yii;

/**
 * This is the model class for table "eps_tabstru".
 *
 * @property int $KOD
 * @property string $KET
 */
class SimpegEpsTabstru extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eps_tabstru';
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
            [['KOD'], 'required'],
            [['KOD'], 'integer'],
            [['KET'], 'string', 'max' => 50],
            [['KOD'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KOD' => 'Kod',
            'KET' => 'Ket',
        ];
    }
}

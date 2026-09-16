<?php

namespace app\modules\simpeg\models;

use Yii;

/**
 * This is the model class for table "eps_tabstru".
 *
 * @property int $KOD
 * @property string $KET
 */
class EpsTabstru extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eps_tabstru';
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

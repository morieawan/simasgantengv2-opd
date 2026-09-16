<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipes".
 *
 * @property int $tipe
 * @property string|null $namatipe
 */
class Tipes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbltipes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'namatipe'], 'required'],
            [['namatipe'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Tipe',
            'namatipe' => 'Role User',
        ];
    }
}

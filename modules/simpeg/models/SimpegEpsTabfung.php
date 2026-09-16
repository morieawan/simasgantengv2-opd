<?php

namespace app\modules\simpeg\models;

use Yii;

/**
 * This is the model class for table "eps_tabfung".
 *
 * @property string|null $KODE
 * @property string|null $FUNGSI
 * @property string|null $ESEL
 * @property string|null $KGOL
 */
class SimpegEpsTabfung extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eps_tabfung';
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
            [['KODE'], 'string', 'max' => 6],
            [['FUNGSI'], 'string', 'max' => 100],
            [['ESEL', 'KGOL'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KODE' => 'Kode',
            'FUNGSI' => 'Fungsi',
            'ESEL' => 'Esel',
            'KGOL' => 'Kgol',
        ];
    }

    public static function primaryKey()
    {
        return ["KODE"];
    }
}

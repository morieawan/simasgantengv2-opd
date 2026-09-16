<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "preskin_sakip_rb".
 *
 * @property string $id tahun-tablok
 * @property int $tahun
 * @property string $opd
 * @property string $exp
 * @property string|null $sakip
 * @property float $sakip_persen
 * @property string|null $rb
 * @property float $rb_persen
 * @property int $flag
 * @property string $updated
 */
class PreskinSakipRb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preskin_sakip_rb';
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
            [['id', 'tahun', 'opd', 'exp'], 'required'],
            [['tahun', 'flag'], 'default', 'value' => null],
            [['tahun', 'flag'], 'integer'],
            [['exp', 'updated'], 'safe'],
            [['sakip_persen', 'rb_persen'], 'number'],
            [['id'], 'string', 'max' => 20],
            [['opd'], 'string', 'max' => 10],
            [['sakip', 'rb'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tahun' => 'Tahun',
            'opd' => 'Opd',
            'exp' => 'Exp',
            'sakip' => 'Sakip',
            'sakip_persen' => 'Sakip Persen',
            'rb' => 'Rb',
            'rb_persen' => 'Rb Persen',
            'flag' => 'Flag',
            'updated' => 'Updated',
        ];
    }
}

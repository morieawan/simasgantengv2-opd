<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblrule".
 *
 * @property string $id
 * @property int $role
 * @property int $action_id
 * @property int $flag
 * @property string $updated
 */
class Tblrule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblrule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['role', 'action_id', 'flag'], 'default', 'value' => null],
            [['role', 'action_id', 'flag'], 'integer'],
            [['updated'], 'safe'],
            [['id'], 'string', 'max' => 10],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role' => 'Role',
            'action_id' => 'Action ID',
            'flag' => 'Flag',
            'updated' => 'Updated',
        ];
    }

    public function getRoleAction() 
    { 
       return $this->hasOne(Tblaction::className(), ['id' => 'action_id']); 
    }
}

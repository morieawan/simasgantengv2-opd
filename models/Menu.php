<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property string $nama_menu
 * @property string $link
 * @property string|null $icon
 * @property int|null $urutan
 * @property int $tipe
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblmenu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_menu', 'link'], 'required'],
            [['id', 'urutan', 'tipe', 'flag'], 'integer'],
            [['nama_menu', 'link', 'icon'], 'string', 'max' => 50],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id Menu',
            'nama_menu' => 'Nama Menu',
            'link' => 'Link',
            'icon' => 'Icon',
            'urutan' => 'Urutan',
            'tipe' => 'Tipe',
        ];
    }

   public function getMenuTipe() 
   { 
       return $this->hasOne(Tipes::className(), ['id' => 'tipe']); 
   }          

   public function getMenuIcon() 
   { 
       return $this->hasOne(Tblicon::className(), ['id' => 'icon']); 
   }
}

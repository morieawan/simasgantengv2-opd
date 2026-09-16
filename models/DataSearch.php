<?php

namespace app\modules\integrasi\models;

use Yii;

class Search extends \yii\db\ActiveRecord
{
    public $nip, $mode, $path;
    public function rules()
    {
        return [
            [['nip', 'mode', 'path'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nip' => 'NIP',
            'mode' => 'Mode',
            'path' => 'Path',
        ];
    }
}

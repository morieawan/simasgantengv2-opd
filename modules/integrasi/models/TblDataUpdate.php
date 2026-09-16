<?php

namespace app\modules\integrasi\models;

use Yii;

/**
 * This is the model class for table "tbl_data_update".
 *
 * @property string $id
 * @property string $nipBaru
 * @property string|null $dataUtama
 * @property string|null $rwJabatan
 * @property string|null $rwGol
 * @property string|null $rwDiklat
 * @property string|null $rwPendidikan
 * @property string|null $rwSkp
 * @property string|null $rwAngkakredit
 * @property string|null $rwPwk
 * @property string|null $rwPnsunor
 * @property string|null $rwKursus
 * @property string|null $rwPemberhentian
 * @property string|null $rwPenghargaan
 * @property string|null $rwMasakerja
 * @property string|null $rwHukdis
 * @property string|null $rwDp3
 * @property string|null $rwCltn
 * @property string|null $rwPindahinstansi
 * @property string|null $rwskp22
 * @property int $flag
 */
class TblDataUpdate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_data_update';
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
            [['id', 'nipBaru'], 'required'],
            [['dataUtama', 'rwJabatan', 'rwGol', 'rwDiklat', 'rwPendidikan', 'rwSkp', 'rwAngkakredit', 'rwPwk', 'rwPnsunor', 'rwKursus', 'rwPemberhentian', 'rwPenghargaan', 'rwMasakerja', 'rwHukdis', 'rwDp3', 'rwCltn', 'rwPindahinstansi', 'rwskp22'], 'safe'],
            [['flag'], 'default', 'value' => null],
            [['flag'], 'integer'],
            [['id'], 'string', 'max' => 128],
            [['nipBaru'], 'string', 'max' => 18],
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
            'nipBaru' => 'Nip Baru',
            'dataUtama' => 'Data Utama',
            'rwJabatan' => 'Rw Jabatan',
            'rwGol' => 'Rw Gol',
            'rwDiklat' => 'Rw Diklat',
            'rwPendidikan' => 'Rw Pendidikan',
            'rwSkp' => 'Rw Skp',
            'rwAngkakredit' => 'Rw Angkakredit',
            'rwPwk' => 'Rw Pwk',
            'rwPnsunor' => 'Rw Pnsunor',
            'rwKursus' => 'Rw Kursus',
            'rwPemberhentian' => 'Rw Pemberhentian',
            'rwPenghargaan' => 'Rw Penghargaan',
            'rwMasakerja' => 'Rw Masakerja',
            'rwHukdis' => 'Rw Hukdis',
            'rwDp3' => 'Rw Dp3',
            'rwCltn' => 'Rw Cltn',
            'rwPindahinstansi' => 'Rw Pindahinstansi',
            'rwskp22' => 'Rwskp22',
            'flag' => 'Flag',
        ];
    }
}

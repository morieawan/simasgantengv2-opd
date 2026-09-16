<?php

namespace app\modules\integrasi\models;

use Yii;

/**
 * This is the model class for table "siasn_rw_skp22".
 *
 * @property string $id
 * @property int|null $tahun
 * @property string|null $pnsDinilaiId
 * @property string|null $statusPenilai
 * @property string|null $namaPenilai
 * @property string|null $nipNrpPenilai
 * @property string|null $penilaiGolonganId
 * @property string|null $penilaiJabatanNm
 * @property string|null $penilaiUnorNm
 * @property string|null $hasilKinerja
 * @property float|null $hasilKinerjaNilai
 * @property string|null $perilakuKerja
 * @property float|null $PerilakuKerjaNilai
 * @property string|null $kuadranKinerja
 * @property float|null $KuadranKinerjaNilai
 * @property string $updated
 */
class SiasnRwSkp22 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siasn_rw_skp22';
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
            [['id'], 'required'],
            [['tahun'], 'default', 'value' => null],
            [['tahun'], 'integer'],
            [['hasilKinerjaNilai', 'PerilakuKerjaNilai', 'KuadranKinerjaNilai'], 'number'],
            [['updated'], 'safe'],
            [['id', 'pnsDinilaiId'], 'string', 'max' => 128],
            [['statusPenilai'], 'string', 'max' => 10],
            [['namaPenilai', 'hasilKinerja', 'perilakuKerja', 'kuadranKinerja'], 'string', 'max' => 100],
            [['nipNrpPenilai'], 'string', 'max' => 18],
            [['penilaiGolonganId'], 'string', 'max' => 2],
            [['penilaiJabatanNm', 'penilaiUnorNm'], 'string', 'max' => 200],
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
            'tahun' => 'Tahun',
            'pnsDinilaiId' => 'Pns Dinilai ID',
            'statusPenilai' => 'Status Penilai',
            'namaPenilai' => 'Nama Penilai',
            'nipNrpPenilai' => 'Nip Nrp Penilai',
            'penilaiGolonganId' => 'Penilai Golongan ID',
            'penilaiJabatanNm' => 'Penilai Jabatan Nm',
            'penilaiUnorNm' => 'Penilai Unor Nm',
            'hasilKinerja' => 'Hasil Kinerja',
            'hasilKinerjaNilai' => 'Hasil Kinerja Nilai',
            'perilakuKerja' => 'Perilaku Kerja',
            'PerilakuKerjaNilai' => 'Perilaku Kerja Nilai',
            'kuadranKinerja' => 'Kuadran Kinerja',
            'KuadranKinerjaNilai' => 'Kuadran Kinerja Nilai',
            'updated' => 'Updated',
        ];
    }
}

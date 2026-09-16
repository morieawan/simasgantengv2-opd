<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "kin_harian".
 *
 * @property string $id nip.timestamp_create
 * @property string $id_pns
 * @property string $nip
 * @property string|null $nama
 * @property string|null $tablok
 * @property string|null $tablokb
 * @property string|null $tgl
 * @property string|null $kode_kegiatan_h
 * @property string $uraian_keg_h
 * @property string|null $tgl_target timestamp create & update
 * @property float $target_kuan_h
 * @property string $target_output_h
 * @property float $target_waktu_h
 * @property string|null $tgl_real
 * @property float|null $real_kuan_h
 * @property int|null $real_output_h
 * @property float|null $real_waktu_h
 * @property string|null $tgl_ok
 * @property float|null $ok_kuan_h
 * @property int|null $ok_output_h
 * @property float|null $ok_waktu_h
 * @property string|null $penilai_nip
 * @property string|null $penilai_nama
 * @property string|null $penilai_tablok
 * @property string|null $penilai_tablokb
 * @property int|null $flag
 */
class KinHarian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kin_harian';
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
            [['id', 'id_pns', 'nip', 'uraian_keg_h', 'target_kuan_h', 'target_output_h', 'target_waktu_h', 'tgl'], 'required'],
            [['tgl', 'tgl_target', 'tgl_real', 'tgl_ok'], 'safe'],
            [['uraian_keg_h', 'penilaian'], 'string'],
            [['target_kuan_h', 'target_waktu_h', 'real_kuan_h', 'real_waktu_h', 'ok_kuan_h', 'ok_waktu_h'], 'number'],
            [['penilaian'], 'default', 'value' => ''],
            [['flag'], 'default', 'value' => 0],
            [['flag'], 'integer'],
            [['id'], 'string', 'max' => 150],
            [['id_pns'], 'string', 'max' => 128],
            [['nip', 'penilai_nip'], 'string', 'max' => 21],
            [['nama', 'penilai_nama'], 'string', 'max' => 100],
            [['tablok', 'tablokb', 'kode_kegiatan_h', 'penilai_tablok', 'penilai_tablokb'], 'string', 'max' => 10],
            [['target_output_h', 'real_output_h', 'ok_output_h'], 'string', 'max' => 30],
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
            'id_pns' => 'Id Pns',
            'nip' => 'Nip',
            'nama' => 'Nama',
            'tablok' => 'Tablok',
            'tablokb' => 'Tablokb',
            'tgl' => 'Tgl',
            'kode_kegiatan_h' => 'Kode Kegiatan',
            'uraian_keg_h' => 'Uraian Kegiatan',
            'tgl_target' => 'Tgl Target',
            'target_kuan_h' => 'Target',
            'target_output_h' => 'Target Output H',
            'target_waktu_h' => 'Waktu',
            'tgl_real' => 'Tgl Real',
            'real_kuan_h' => 'Realisasi',
            'real_output_h' => 'Real Output H',
            'real_waktu_h' => 'Realisasi Waktu',
            'tgl_ok' => 'Tgl Ok',
            'ok_kuan_h' => 'Ok Kuan H',
            'ok_output_h' => 'Ok Output H',
            'ok_waktu_h' => 'Penilaian Waktu',
            'penilai_nip' => 'Penilai Nip',
            'penilai_nama' => 'Penilai Nama',
            'penilai_tablok' => 'Penilai Tablok',
            'penilai_tablokb' => 'Penilai Tablokb',
            'penilaian' => 'Uraian Penilaian',
            'flag' => 'Flag',
        ];
    }
    
    public static function getCountKin($nip, $tahun, $bulan){
        $kin = KinHarian::find()->select(['nip', 'tgl'])
        ->where([
            'nip' => $nip,
            'EXTRACT(YEAR FROM tgl::date)' => $tahun,
            'EXTRACT(MONTH FROM tgl::date)' => $bulan,
        ])->count();

        return $kin;
    }
}

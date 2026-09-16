<?php

namespace app\modules\sitampan\models;

use Yii;
use app\modules\gaji\models\SimasGajiSkpdTbl;

/**
 * This is the model class for table "preskin_coretax_tpp".
 *
 * @property int $masa_pajak
 * @property int $tahun_pajak
 * @property string $stapeg
 * @property string $nik
 * @property string $passport
 * @property string|null $status
 * @property string|null $posisi
 * @property string $fasilitas
 * @property string $kode_op
 * @property int $bruto
 * @property float $tarif
 * @property string|null $id_tku
 * @property string|null $tgl_potong
 * @property string $nip
 * @property string $nama
 * @property string|null $tablok
 * @property int|null $bruto_gaji
 * @property int|null $bruto_tpp
 * @property int|null $pph_gaji
 * @property int|null $pph_tpp
 * @property int|null $pph_total
 */
class PreskinCoretaxTpp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preskin_coretax_tpp';
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
            [['masa_pajak', 'tahun_pajak', 'nip'], 'required'],
            [['masa_pajak', 'tahun_pajak', 'bruto', 'bruto_gaji', 'bruto_tpp', 'pph_gaji', 'pph_tpp', 'pph_total'], 'default', 'value' => null],
            [['masa_pajak', 'tahun_pajak', 'bruto', 'bruto_gaji', 'bruto_tpp', 'pph_gaji', 'pph_tpp', 'pph_total'], 'integer'],
            [['tarif'], 'number'],
            [['tgl_potong'], 'safe'],
            [['stapeg', 'nik', 'passport', 'id_tku'], 'string', 'max' => 30],
            [['status', 'fasilitas', 'tablok'], 'string', 'max' => 10],
            [['posisi'], 'string', 'max' => 250],
            [['kode_op', 'nip'], 'string', 'max' => 20],
            [['nama'], 'string', 'max' => 100],
            [['masa_pajak', 'tahun_pajak', 'nip'], 'unique', 'targetAttribute' => ['masa_pajak', 'tahun_pajak', 'nip']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'masa_pajak' => 'Masa Pajak',
            'tahun_pajak' => 'Tahun Pajak',
            'stapeg' => 'Stapeg',
            'nik' => 'NIK',
            'passport' => 'Passport',
            'status' => 'Status',
            'posisi' => 'Posisi',
            'fasilitas' => 'Fasilitas',
            'kode_op' => 'Kode Op',
            'bruto' => 'Bruto',
            'tarif' => 'Tarif',
            'id_tku' => 'Id Tku',
            'tgl_potong' => 'Tgl Potong',
            'nip' => 'NIP',
            'nama' => 'Nama',
            'tablok' => 'OPD',
            'bruto_gaji' => 'Bruto Gaji',
            'bruto_tpp' => 'Bruto TPP',
            'pph_gaji' => 'Pph Gaji',
            'pph_tpp' => 'Pph TPP',
            'pph_total' => 'Pph Total',
        ];
    }

    public function getCoretaxSkpd()  
    {  
        return $this->hasOne(SimasGajiSkpdTbl::className(), ['KDSKPD' => 'tablok']);  
    }

    public function getBulan($x)
    {
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $bulan[(int)$x] ?? null; // null jika tidak valid
    }

    public function getMasaPajak()
    {
        return $this->getBulan($this->masa_pajak);
    }
}

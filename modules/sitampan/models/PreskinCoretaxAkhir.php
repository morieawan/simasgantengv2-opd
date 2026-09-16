<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "preskin_coretax_akhir".
 *
 * @property string $pemberi_kerja
 * @property int $masa_awal
 * @property int $masa_akhir
 * @property int $tahun_pajak
 * @property string|null $npwp
 * @property string $nip
 * @property string|null $status
 * @property string $posisi
 * @property string|null $pangkat_gol
 * @property string $kd_obj_pajak
 * @property string $bupot
 * @property int $jml_bln
 * @property int $gaji
 * @property int $tunj_istri
 * @property int $tunj_anak
 * @property int $tpp
 * @property int $tunj_jabatan
 * @property int $tunj_beras
 * @property int $tunj_khusus
 * @property int $tunj_lain
 * @property int $iuran_pensiun
 * @property int $zakat
 * @property string|null $no_bupot_sebelumnya
 * @property int|null $pph_terbayar
 * @property string|null $id_tku
 * @property string|null $tgl_potong
 * @property string|null $nama
 * @property string|null $tablok
 * @property string|null $satker
 * @property int $bruto_gaji
 * @property int $jkk
 * @property int $jkm
 * @property int $bpjs4
 * @property int $tjstruk
 * @property int $tjfung
 * @property int $tjumum
 * @property int $tjbulat
 * @property int $bruto_total
 * @property int $pot_bea_jabatan
 * @property int $pot_iuran_pensiun
 * @property int $netto
 * @property int $ptkp
 * @property int $pkp_total
 * @property int $pkp5
 * @property int $pkp15
 * @property int $pkp25
 * @property int $pkp30
 * @property int $pkp35
 * @property int $pph5
 * @property int $pph15
 * @property int $pph25
 * @property int $pph30
 * @property int $pph35
 * @property int $pph_total
 * @property int $pph_gaji_terbayar
 * @property int $pph_tpp_terbayar
 * @property int $pph_gaji_akhir_masa
 * @property int $pph_terhutang
 * @property int $jenis
 * @property int $flag
 * @property string $updated
 */
class PreskinCoretaxAkhir extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preskin_coretax_akhir';
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
            [['masa_awal', 'masa_akhir', 'tahun_pajak', 'jml_bln', 'gaji', 'tunj_istri', 'tunj_anak', 'tpp', 'tunj_jabatan', 'tunj_beras', 'tunj_khusus', 'tunj_lain', 'iuran_pensiun', 'zakat', 'pph_terbayar', 'bruto_gaji', 'jkk', 'jkm', 'bpjs4', 'tjstruk', 'tjfung', 'tjumum', 'tjbulat', 'bruto_total', 'pot_bea_jabatan', 'pot_iuran_pensiun', 'netto', 'ptkp', 'pkp_total', 'pkp5', 'pkp15', 'pkp25', 'pkp30', 'pkp35', 'pph5', 'pph15', 'pph25', 'pph30', 'pph35', 'pph_total', 'pph_gaji_terbayar', 'pph_tpp_terbayar', 'pph_gaji_akhir_masa', 'pph_terhutang', 'jenis', 'flag', 'pph_ter'], 'default', 'value' => 0],
            [['masa_awal', 'masa_akhir', 'tahun_pajak', 'jml_bln', 'gaji', 'tunj_istri', 'tunj_anak', 'tpp', 'tunj_jabatan', 'tunj_beras', 'tunj_khusus', 'tunj_lain', 'iuran_pensiun', 'zakat', 'pph_terbayar', 'bruto_gaji', 'jkk', 'jkm', 'bpjs4', 'tjstruk', 'tjfung', 'tjumum', 'tjbulat', 'bruto_total', 'pot_bea_jabatan', 'pot_iuran_pensiun', 'netto', 'ptkp', 'pkp_total', 'pkp5', 'pkp15', 'pkp25', 'pkp30', 'pkp35', 'pph5', 'pph15', 'pph25', 'pph30', 'pph35', 'pph_total', 'pph_gaji_terbayar', 'pph_tpp_terbayar', 'pph_gaji_akhir_masa', 'pph_terhutang', 'jenis', 'flag', 'pph_ter'], 'integer'],
            [['tahun_pajak', 'nip', 'jenis'], 'required'],
            [['tgl_potong', 'updated'], 'safe'],
            [['pemberi_kerja', 'pangkat_gol', 'tablok'], 'string', 'max' => 10],
            [['npwp', 'nip', 'posisi', 'kd_obj_pajak'], 'string', 'max' => 20],
            [['status'], 'string', 'max' => 5],
            [['bupot', 'id_tku'], 'string', 'max' => 100],
            [['no_bupot_sebelumnya', 'nama'], 'string', 'max' => 150],
            [['satker'], 'string', 'max' => 250],
            [['tahun_pajak', 'nip', 'jenis'], 'unique', 'targetAttribute' => ['tahun_pajak', 'nip', 'jenis']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pemberi_kerja' => 'Pemberi Kerja',
            'masa_awal' => 'Masa Awal',
            'masa_akhir' => 'Masa Akhir',
            'tahun_pajak' => 'Tahun Pajak',
            'npwp' => 'Npwp',
            'nip' => 'Nip',
            'status' => 'Status',
            'posisi' => 'Posisi',
            'pangkat_gol' => 'Pangkat Gol',
            'kd_obj_pajak' => 'Kd Obj Pajak',
            'bupot' => 'Bupot',
            'jml_bln' => 'Jml Bln',
            'gaji' => 'Gaji',
            'tunj_istri' => 'Tunj Istri',
            'tunj_anak' => 'Tunj Anak',
            'tpp' => 'Tpp',
            'tunj_jabatan' => 'Tunj Jabatan',
            'tunj_beras' => 'Tunj Beras',
            'tunj_khusus' => 'Tunj Khusus',
            'tunj_lain' => 'Tunj Lain',
            'iuran_pensiun' => 'Iuran Pensiun',
            'zakat' => 'Zakat',
            'no_bupot_sebelumnya' => 'No Bupot Sebelumnya',
            'pph_terbayar' => 'Pph Terbayar',
            'id_tku' => 'Id Tku',
            'tgl_potong' => 'Tgl Potong',
            'nama' => 'Nama',
            'tablok' => 'Tablok',
            'satker' => 'Satker',
            'bruto_gaji' => 'Bruto Gaji',
            'jkk' => 'Jkk',
            'jkm' => 'Jkm',
            'bpjs4' => 'Bpjs4',
            'tjstruk' => 'Tjstruk',
            'tjfung' => 'Tjfung',
            'tjumum' => 'Tjumum',
            'tjbulat' => 'Tjbulat',
            'bruto_total' => 'Bruto Total',
            'pot_bea_jabatan' => 'Pot Bea Jabatan',
            'pot_iuran_pensiun' => 'Pot Iuran Pensiun',
            'netto' => 'Netto',
            'ptkp' => 'Ptkp',
            'pkp_total' => 'Pkp Total',
            'pkp5' => 'Pkp5',
            'pkp15' => 'Pkp15',
            'pkp25' => 'Pkp25',
            'pkp30' => 'Pkp30',
            'pkp35' => 'Pkp35',
            'pph5' => 'Pph5',
            'pph15' => 'Pph15',
            'pph25' => 'Pph25',
            'pph30' => 'Pph30',
            'pph35' => 'Pph35',
            'pph_total' => 'Pph Total',
            'pph_gaji_terbayar' => 'Pph Gaji Terbayar',
            'pph_tpp_terbayar' => 'Pph Tpp Terbayar',
            'pph_gaji_akhir_masa' => 'Pph Gaji Akhir Masa',
            'pph_terhutang' => 'Pph Terhutang',
            'pph_ter' => 'Pph TER terbayar',
            'jenis' => 'Jenis',
            'flag' => 'Flag',
            'updated' => 'Updated',
        ];
    }
}

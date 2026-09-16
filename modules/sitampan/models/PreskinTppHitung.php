<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "preskin_tpp_hitung".
 *
 * @property string $id tahun-bulan-jtrans-nip
 * @property int $tahun
 * @property int $bulan
 * @property int $jtrans reguler, plt, susulan, kekurangan
 * @property string|null $idpns
 * @property string $nip
 * @property string|null $nama
 * @property int|null $jenis_jab
 * @property string|null $kode_jab
 * @property string|null $nama_jab
 * @property int|null $kelas_jab_tpp
 * @property string|null $tablok
 * @property string|null $nama_opd
 * @property string|null $tablokb
 * @property string|null $nama_unor
 * @property int|null $gol
 * @property string|null $nama_gol
 * @property int $pagu
 * @property float $persen_tpp total_persen_tpp_dari_pagu
 * @property float $beban_jab
 * @property float $beban_opd
 * @property float $kondisi_jab
 * @property float $kondisi_opd
 * @property float $pol_jab
 * @property float $pol_opd
 * @property float $prestasi_jab
 * @property float $prestasi_opd
 * @property float $tempat_jab
 * @property float $tempat_opd
 * @property float $profesi_jab
 * @property int $persen_tpp_rp
 * @property int $beban_jab_rp
 * @property int $beban_opd_rp
 * @property int $kondisi_jab_rp
 * @property int $kondisi_opd_rp
 * @property int $pol_jab_rp
 * @property int $pol_opd_rp
 * @property int $prestasi_jab_rp
 * @property int $prestasi_opd_rp
 * @property int $tempat_jab_rp
 * @property int $tempat_opd_rp
 * @property int $profesi_jab_rp
 * @property int $pagu_total
 * @property int $pagu_tpp
 * @property int $beban_kerja
 * @property int $produktivitas_kerja
 * @property float $kinerja
 * @property float $presensi
 * @property float $sakip
 * @property float $rb
 * @property int $kinerja_rp
 * @property int $presensi_rp
 * @property int $sakip_rp
 * @property int $rb_rp
 * @property int $tpp_jumlah
 * @property float $cuti
 * @property float $hukdis
 * @property float $tgr
 * @property int $lhkpn
 * @property int $aset
 * @property int $cuti_rp
 * @property int $hukdis_rp
 * @property int $tgr_rp
 * @property int $pengurangan
 * @property int $tpp_total
 * @property float $pph
 * @property int $pph_rp
 * @property int $bpjs4
 * @property int $tpp_bruto
 * @property int $bpjs1
 * @property int $pot_jml
 * @property int $tpp_net
 * @property int $status
 * @property string|null $tgl_final
 * @property string $updated
 */
class PreskinTppHitung extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preskin_tpp_hitung';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    public $jml_cuti, $jml_hrkerja;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tahun', 'bulan', 'nip'], 'required'],
            [['tahun', 'bulan', 'jtrans', 'jenis_jab', 'kelas_jab_tpp', 'gol', 'pagu', 'persen_tpp_rp', 'beban_jab_rp', 'beban_opd_rp', 'kondisi_jab_rp', 'kondisi_opd_rp', 'pol_jab_rp', 'pol_opd_rp', 'prestasi_jab_rp', 'prestasi_opd_rp', 'tempat_jab_rp', 'tempat_opd_rp', 'profesi_jab_rp', 'pagu_total', 'pagu_tpp', 'beban_kerja', 'produktivitas_kerja', 'kinerja_rp', 'presensi_rp', 'sakip_rp', 'rb_rp', 'tpp_jumlah', 'lhkpn', 'aset', 'cuti_rp', 'hukdis_rp', 'tgr_rp', 'pengurangan', 'tpp_total', 'tj_pph_rp', 'tj_bpjs4', 'tpp_bruto', 'pot_bpjs1', 'pot_pph_rp', 'pot_bpjs4', 'pot_jml', 'tpp_net', 'status'], 'default', 'value' => 0],
            [['tahun', 'bulan', 'jtrans', 'jenis_jab', 'kelas_jab_tpp', 'gol', 'pagu', 'persen_tpp_rp', 'beban_jab_rp', 'beban_opd_rp', 'kondisi_jab_rp', 'kondisi_opd_rp', 'pol_jab_rp', 'pol_opd_rp', 'prestasi_jab_rp', 'prestasi_opd_rp', 'tempat_jab_rp', 'tempat_opd_rp', 'profesi_jab_rp', 'pagu_total', 'pagu_tpp', 'beban_kerja', 'produktivitas_kerja', 'kinerja_rp', 'presensi_rp', 'sakip_rp', 'rb_rp', 'tpp_jumlah', 'lhkpn', 'aset', 'cuti_rp', 'hukdis_rp', 'tgr_rp', 'pengurangan', 'tpp_total', 'tj_pph_rp', 'tj_bpjs4', 'tpp_bruto', 'pot_bpjs1', 'pot_pph_rp', 'pot_bpjs4', 'pot_jml', 'tpp_net', 'status', 'jml_cuti', 'jml_hrkerja'], 'integer'],
            [['persen_tpp', 'beban_jab', 'beban_opd', 'kondisi_jab', 'kondisi_opd', 'pol_jab', 'pol_opd', 'prestasi_jab', 'prestasi_opd', 'tempat_jab', 'tempat_opd', 'profesi_jab', 'kinerja', 'presensi', 'sakip', 'rb', 'cuti', 'hukdis', 'tgr', 'pph'], 'number'],
            [['tgl_final', 'updated'], 'safe'],
            [['id', 'nip'], 'string', 'max' => 50],
            [['idpns', 'nama_gol'], 'string', 'max' => 100],
            [['nama', 'final_by'], 'string', 'max' => 150],
            [['kode_jab', 'tablok', 'tablokb'], 'string', 'max' => 10],
            [['nama_jab', 'nama_opd', 'nama_unor', 'nama_kelas'], 'string', 'max' => 255],
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
            'bulan' => 'Bulan',
            'jtrans' => 'Jenis TPP',
            'idpns' => 'Idpns',
            'nip' => 'NIP',
            'nama' => 'Nama',
            'jenis_jab' => 'Jenis Jab',
            'kode_jab' => 'Kode Jab',
            'nama_jab' => 'Nama Jab',
            'kelas_jab_tpp' => 'Kelas Jab TPP',
            'nama_kelas' => 'Nama Kelas',
            'tablok' => 'Tablok',
            'nama_opd' => 'Nama OPD',
            'tablokb' => 'Tablokb',
            'nama_unor' => 'Nama Unor',
            'gol' => 'Gol',
            'nama_gol' => 'Nama Gol',
            'pagu' => 'Pagu',
            'persen_tpp' => 'Persen TPP',
            'beban_jab' => 'Beban Jab',
            'beban_opd' => 'Beban Opd',
            'kondisi_jab' => 'Kondisi Jab',
            'kondisi_opd' => 'Kondisi Opd',
            'pol_jab' => 'Pol Jab',
            'pol_opd' => 'Pol Opd',
            'prestasi_jab' => 'Prestasi Jab',
            'prestasi_opd' => 'Prestasi Opd',
            'tempat_jab' => 'Tempat Jab',
            'tempat_opd' => 'Tempat Opd',
            'profesi_jab' => 'Profesi Jab',
            'persen_tpp_rp' => 'Persen TPP Rp',
            'beban_jab_rp' => 'Beban Jab Rp',
            'beban_opd_rp' => 'Beban Opd Rp',
            'kondisi_jab_rp' => 'Kondisi Jab Rp',
            'kondisi_opd_rp' => 'Kondisi Opd Rp',
            'pol_jab_rp' => 'Pol Jab Rp',
            'pol_opd_rp' => 'Pol Opd Rp',
            'prestasi_jab_rp' => 'Prestasi Jab Rp',
            'prestasi_opd_rp' => 'Prestasi Opd Rp',
            'tempat_jab_rp' => 'Tempat Jab Rp',
            'tempat_opd_rp' => 'Tempat Opd Rp',
            'profesi_jab_rp' => 'Profesi Jab Rp',
            'pagu_total' => 'Pagu Total',
            'pagu_tpp' => 'Pagu TPP',
            'beban_kerja' => 'Beban Kerja',
            'produktivitas_kerja' => 'Produktivitas Kerja',
            'kinerja' => 'Kinerja',
            'presensi' => 'Presensi',
            'sakip' => 'Sakip',
            'rb' => 'Rb',
            'kinerja_rp' => 'Kinerja Rp',
            'presensi_rp' => 'Presensi Rp',
            'sakip_rp' => 'Sakip Rp',
            'rb_rp' => 'Rb Rp',
            'tpp_jumlah' => 'TPP Jumlah',
            'cuti' => 'Cuti',
            'hukdis' => 'Hukdis',
            'tgr' => 'Tgr',
            'lhkpn' => 'Lhkpn',
            'aset' => 'Aset',
            'cuti_rp' => 'Cuti Rp',
            'hukdis_rp' => 'Hukdis Rp',
            'tgr_rp' => 'Tgr Rp',
            'pengurangan' => 'Pengurangan',
            'tpp_total' => 'TPP Total',
            'pph' => 'Pph',
            'tj_pph_rp' => 'Tj Pph Rp',
            'tj_bpjs4' => 'Tj Bpjs4',
            'tpp_bruto' => 'TPP Bruto',
            'pot_bpjs4' => 'Pot Bpjs4',
            'pot_bpjs1' => 'Pot Bpjs1',
            'pot_pph_rp' => 'Pot PPH',
            'pot_jml' => 'Pot Jml',
            'tpp_net' => 'TPP Net',
            'status' => 'Status',
            'tgl_final' => 'Tgl Finalisasi',
            'final_by' => 'Final By',
            'updated' => 'Updated',
        ];
    }
}

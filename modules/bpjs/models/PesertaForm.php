<?php
namespace app\modules\bpjs\models;

use yii\base\Model;

class PesertaForm extends Model
{
    public $id_peserta;
    public $nip;
    public $opd;
    public $hubkel;
    public $nik;
    public $no_kk;
    public $nama_peserta;
    public $tgl_lahir;
    public $jk;
    public $alamat;
    public $kelurahan;
    public $kecamatan;
    public $kabupaten;
    public $sumber_pembiayaan;
    public $aktif;

    public function rules()
    {
        return [
            [['nip', 'hubkel', 'nik', 'no_kk', 'nama_peserta'], 'required', 'message' => '{attribute} tidak boleh kosong.'],
            [['tgl_lahir', 'updated'], 'safe'],
            [['jk', 'aktif'], 'integer'],
            [['id_peserta'], 'string', 'max' => 21],
            [['nip'], 'string', 'max' => 18],
            [['opd'], 'string', 'max' => 10],
            [['hubkel'], 'string', 'max' => 2],
            [['nik', 'no_kk'], 'string', 'max' => 20],
            [['nama_peserta', 'alamat'], 'string', 'max' => 150],
            [['kelurahan', 'kecamatan', 'kabupaten', 'provinsi', 'sumber_pembiayaan'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_peserta' => 'ID Peserta',
            'nip' => 'NIP',
            'opd' => 'OPD',
            'hubkel' => 'Hubungan Keluarga',
            'nik' => 'NIK',
            'no_kk' => 'No. KK',
            'nama_peserta' => 'Nama Peserta',
            'tgl_lahir' => 'Tanggal Lahir',
            'jk' => 'Jenis Kelamin',
            'alamat' => 'Alamat',
            'kelurahan' => 'Kelurahan',
            'kecamatan' => 'Kecamatan',
            'kabupaten' => 'Kabupaten',
            'sumber_pembiayaan' => 'Sumber Pembiayaan',
            'aktif' => 'Status Aktif',
        ];
    }
}
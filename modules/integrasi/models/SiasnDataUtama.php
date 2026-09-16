<?php

namespace app\modules\integrasi\models;

use Yii;

/**
 * This is the model class for table "siasn_data_utama".
 *
 * @property string $id
 * @property string|null $nipBaru
 * @property string|null $nipLama
 * @property string|null $nama
 * @property string|null $gelarDepan
 * @property string|null $gelarBelakang
 * @property string|null $tempatLahir
 * @property string|null $tempatLahirId
 * @property string|null $tglLahir
 * @property string|null $agama
 * @property string|null $agamaId
 * @property string|null $email
 * @property string|null $emailGov
 * @property string|null $nik
 * @property string|null $alamat
 * @property string|null $noHp
 * @property string|null $noTelp
 * @property string|null $jenisPegawaiId
 * @property string|null $jenisPegawaiNama
 * @property string|null $kedudukanPnsId
 * @property string|null $kedudukanPnsNama
 * @property string|null $statusPegawai
 * @property string|null $jenisKelamin
 * @property string|null $jenisIdDokumenId
 * @property string|null $jenisIdDokumenNama
 * @property string|null $nomorIdDocument
 * @property string|null $noSeriKarpeg
 * @property string|null $tkPendidikanTerakhirId
 * @property string|null $tkPendidikanTerakhir
 * @property string|null $pendidikanTerakhirId
 * @property string|null $pendidikanTerakhirNama
 * @property string|null $tahunLulus
 * @property string|null $tmtPns
 * @property string|null $tglSkPns
 * @property string|null $tmtCpns
 * @property string|null $tglSkCpns
 * @property string|null $tmtPensiun
 * @property int|null $bupPensiun
 * @property string|null $latihanStrukturalNama
 * @property string|null $instansiIndukId
 * @property string|null $instansiIndukNama
 * @property string|null $satuanKerjaIndukId
 * @property string|null $satuanKerjaIndukNama
 * @property string|null $kanregId
 * @property string|null $kanregNama
 * @property string|null $instansiKerjaId
 * @property string|null $instansiKerjaNama
 * @property string|null $instansiKerjaKodeCepat
 * @property string|null $satuanKerjaKerjaId
 * @property string|null $satuanKerjaKerjaNama
 * @property string|null $unorId
 * @property string|null $unorNama
 * @property string|null $unorIndukId
 * @property string|null $unorIndukNama
 * @property string|null $jenisJabatanId
 * @property string|null $jenisJabatan
 * @property string|null $jabatanNama
 * @property string|null $jabatanStrukturalId
 * @property string|null $jabatanStrukturalNama
 * @property string|null $jabatanFungsionalId
 * @property string|null $jabatanFungsionalNama
 * @property string|null $jabatanFungsionalUmumId
 * @property string|null $jabatanFungsionalUmumNama
 * @property string|null $tmtJabatan
 * @property string|null $lokasiKerjaId
 * @property string|null $lokasiKerja
 * @property string|null $golRuangAwalId
 * @property string|null $golRuangAwal
 * @property string|null $golRuangAkhirId
 * @property string|null $golRuangAkhir
 * @property string|null $tmtGolAkhir
 * @property string|null $nomorSptm
 * @property string|null $masaKerja
 * @property string|null $eselon
 * @property string|null $eselonId
 * @property string|null $eselonLevel
 * @property string|null $tmtEselon
 * @property int|null $gajiPokok
 * @property string|null $kpknId
 * @property string|null $kpknNama
 * @property string|null $ktuaId
 * @property string|null $ktuaNama
 * @property string|null $taspenId
 * @property string|null $taspenNama
 * @property string|null $jenisKawinId
 * @property string|null $statusPerkawinan
 * @property string|null $statusHidup
 * @property string|null $tglSuratKeteranganDokter
 * @property string|null $noSuratKeteranganDokter
 * @property int|null $jumlahIstriSuami
 * @property int|null $jumlahAnak
 * @property string|null $noSuratKeteranganBebasNarkoba
 * @property string|null $tglSuratKeteranganBebasNarkoba
 * @property string|null $skck
 * @property string|null $tglSkck
 * @property string|null $akteKelahiran
 * @property string|null $akteMeninggal
 * @property string|null $tglMeninggal
 * @property string|null $noNpwp
 * @property string|null $tglNpwp
 * @property string|null $noAskes
 * @property string|null $bpjs
 * @property string|null $kodePos
 * @property string|null $noSpmt
 * @property string|null $tglSpmt
 * @property string|null $noTaspen
 * @property string|null $bahasa
 * @property string|null $kppnId
 * @property string|null $kppnNama
 * @property string|null $pangkatAkhir
 * @property string|null $tglSttpl
 * @property string|null $nomorSttpl
 * @property string|null $nomorSkCpns
 * @property string|null $nomorSkPns
 * @property string|null $jenjang
 * @property string|null $jabatanAsn
 * @property string|null $kartuAsn
 * @property int|null $mkTahun
 * @property int|null $mkBulan
 * @property int|null $flag
 * @property string $updated
 */
class SiasnDataUtama extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siasn_data_utama';
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
            [['bupPensiun', 'gajiPokok', 'jumlahIstriSuami', 'jumlahAnak', 'mkTahun', 'mkBulan', 'flag'], 'default', 'value' => 0],
            [['bupPensiun', 'gajiPokok', 'jumlahIstriSuami', 'jumlahAnak', 'mkTahun', 'mkBulan', 'flag'], 'integer'],
            [['updated'], 'safe'],
            [['id', 'tempatLahirId', 'pendidikanTerakhirId', 'instansiIndukId', 'satuanKerjaIndukId', 'instansiKerjaId', 'satuanKerjaKerjaId', 'unorId', 'unorIndukId', 'jabatanStrukturalId', 'jabatanFungsionalId', 'jabatanFungsionalUmumId', 'lokasiKerjaId', 'kpknId', 'ktuaId', 'kppnId'], 'string', 'max' => 128],
            [['nipBaru'], 'string', 'max' => 18],
            [['nipLama'], 'string', 'max' => 9],
            [['nama'], 'string', 'max' => 200],
            [['gelarDepan', 'gelarBelakang', 'email', 'emailGov', 'jenisPegawaiNama', 'kedudukanPnsNama', 'tkPendidikanTerakhir', 'instansiIndukNama', 'satuanKerjaIndukNama', 'instansiKerjaNama', 'satuanKerjaKerjaNama', 'skck', 'kppnNama'], 'string', 'max' => 100],
            [['tempatLahir', 'noHp', 'noTelp', 'latihanStrukturalNama', 'lokasiKerja', 'masaKerja'], 'string', 'max' => 40],
            [['tglLahir', 'jenisKelamin', 'tahunLulus', 'tmtPns', 'tglSkPns', 'tmtCpns', 'tglSkCpns', 'tmtPensiun', 'instansiKerjaKodeCepat', 'tmtJabatan', 'tmtGolAkhir', 'tmtEselon', 'tglSuratKeteranganDokter', 'tglSuratKeteranganBebasNarkoba', 'tglSkck', 'tglMeninggal', 'tglNpwp', 'kodePos', 'tglSpmt', 'tglSttpl'], 'string', 'max' => 10],
            [['agama', 'statusPerkawinan'], 'string', 'max' => 15],
            [['agamaId', 'jenisIdDokumenId', 'jenisJabatanId', 'jenisKawinId'], 'string', 'max' => 1],
            [['nik', 'jenisIdDokumenNama', 'nomorIdDocument', 'noSeriKarpeg', 'jenisJabatan', 'nomorSptm', 'akteKelahiran', 'akteMeninggal', 'noNpwp', 'noAskes', 'bpjs', 'noSpmt', 'noTaspen', 'bahasa', 'pangkatAkhir', 'nomorSkCpns', 'nomorSkPns', 'jenjang', 'jabatanAsn', 'kartuAsn'], 'string', 'max' => 50],
            [['alamat', 'noSuratKeteranganDokter', 'noSuratKeteranganBebasNarkoba', 'nomorSttpl'], 'string', 'max' => 255],
            [['jenisPegawaiId', 'kedudukanPnsId', 'tkPendidikanTerakhirId', 'kanregId', 'golRuangAwalId', 'golRuangAkhirId'], 'string', 'max' => 2],
            [['statusPegawai', 'golRuangAwal', 'golRuangAkhir', 'statusHidup'], 'string', 'max' => 5],
            [['pendidikanTerakhirNama', 'kanregNama'], 'string', 'max' => 150],
            [['unorNama', 'unorIndukNama', 'jabatanNama', 'jabatanStrukturalNama', 'jabatanFungsionalNama', 'jabatanFungsionalUmumNama'], 'string', 'max' => 250],
            [['eselon', 'eselonId', 'eselonLevel', 'validNik'], 'string', 'max' => 20],
            [['kpknNama', 'ktuaNama', 'taspenNama'], 'string', 'max' => 60],
            [['taspenId'], 'string', 'max' => 3],
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
            'nipBaru' => 'NIP',
            'nipLama' => 'Nip Lama',
            'nama' => 'Nama',
            'gelarDepan' => 'Gelar Depan',
            'gelarBelakang' => 'Gelar Belakang',
            'tempatLahir' => 'Tempat Lahir',
            'tempatLahirId' => 'Tempat Lahir ID',
            'tglLahir' => 'Tgl Lahir',
            'agama' => 'Agama',
            'agamaId' => 'Agama ID',
            'email' => 'Email',
            'emailGov' => 'Email Gov',
            'nik' => 'Nik',
            'alamat' => 'Alamat',
            'noHp' => 'No Hp',
            'noTelp' => 'No Telp',
            'jenisPegawaiId' => 'Jenis Pegawai ID',
            'jenisPegawaiNama' => 'Jenis Pegawai Nama',
            'kedudukanPnsId' => 'Kedudukan Pns ID',
            'kedudukanPnsNama' => 'Kedudukan Pns Nama',
            'statusPegawai' => 'Status Pegawai',
            'jenisKelamin' => 'Jenis Kelamin',
            'jenisIdDokumenId' => 'Jenis Id Dokumen ID',
            'jenisIdDokumenNama' => 'Jenis Id Dokumen Nama',
            'nomorIdDocument' => 'Nomor Id Document',
            'noSeriKarpeg' => 'No Seri Karpeg',
            'tkPendidikanTerakhirId' => 'Tk Pendidikan Terakhir ID',
            'tkPendidikanTerakhir' => 'Tk Pendidikan Terakhir',
            'pendidikanTerakhirId' => 'Pendidikan Terakhir ID',
            'pendidikanTerakhirNama' => 'Pendidikan Terakhir Nama',
            'tahunLulus' => 'Tahun Lulus',
            'tmtPns' => 'Tmt Pns',
            'tglSkPns' => 'Tgl Sk Pns',
            'tmtCpns' => 'Tmt Cpns',
            'tglSkCpns' => 'Tgl Sk Cpns',
            'tmtPensiun' => 'Tmt Pensiun',
            'bupPensiun' => 'Bup Pensiun',
            'latihanStrukturalNama' => 'Latihan Struktural Nama',
            'instansiIndukId' => 'Instansi Induk ID',
            'instansiIndukNama' => 'Instansi Induk Nama',
            'satuanKerjaIndukId' => 'Satuan Kerja Induk ID',
            'satuanKerjaIndukNama' => 'Satuan Kerja Induk Nama',
            'kanregId' => 'Kanreg ID',
            'kanregNama' => 'Kanreg Nama',
            'instansiKerjaId' => 'Instansi Kerja ID',
            'instansiKerjaNama' => 'Instansi Kerja Nama',
            'instansiKerjaKodeCepat' => 'Instansi Kerja Kode Cepat',
            'satuanKerjaKerjaId' => 'Satuan Kerja Kerja ID',
            'satuanKerjaKerjaNama' => 'Satuan Kerja Kerja Nama',
            'unorId' => 'Unor ID',
            'unorNama' => 'Unor Nama',
            'unorIndukId' => 'Unor Induk ID',
            'unorIndukNama' => 'Unor Induk Nama',
            'jenisJabatanId' => 'Jenis Jabatan ID',
            'jenisJabatan' => 'Jenis Jabatan',
            'jabatanNama' => 'Jabatan Nama',
            'jabatanStrukturalId' => 'Jabatan Struktural ID',
            'jabatanStrukturalNama' => 'Jabatan Struktural Nama',
            'jabatanFungsionalId' => 'Jabatan Fungsional ID',
            'jabatanFungsionalNama' => 'Jabatan Fungsional Nama',
            'jabatanFungsionalUmumId' => 'Jabatan Fungsional Umum ID',
            'jabatanFungsionalUmumNama' => 'Jabatan Fungsional Umum Nama',
            'tmtJabatan' => 'Tmt Jabatan',
            'lokasiKerjaId' => 'Lokasi Kerja ID',
            'lokasiKerja' => 'Lokasi Kerja',
            'golRuangAwalId' => 'Gol Ruang Awal ID',
            'golRuangAwal' => 'Gol Ruang Awal',
            'golRuangAkhirId' => 'Gol Ruang Akhir ID',
            'golRuangAkhir' => 'Gol Ruang Akhir',
            'tmtGolAkhir' => 'Tmt Gol Akhir',
            'nomorSptm' => 'Nomor Sptm',
            'masaKerja' => 'Masa Kerja',
            'eselon' => 'Eselon',
            'eselonId' => 'Eselon ID',
            'eselonLevel' => 'Eselon Level',
            'tmtEselon' => 'Tmt Eselon',
            'gajiPokok' => 'Gaji Pokok',
            'kpknId' => 'Kpkn ID',
            'kpknNama' => 'Kpkn Nama',
            'ktuaId' => 'Ktua ID',
            'ktuaNama' => 'Ktua Nama',
            'taspenId' => 'Taspen ID',
            'taspenNama' => 'Taspen Nama',
            'jenisKawinId' => 'Jenis Kawin ID',
            'statusPerkawinan' => 'Status Perkawinan',
            'statusHidup' => 'Status Hidup',
            'tglSuratKeteranganDokter' => 'Tgl Surat Keterangan Dokter',
            'noSuratKeteranganDokter' => 'No Surat Keterangan Dokter',
            'jumlahIstriSuami' => 'Jumlah Istri Suami',
            'jumlahAnak' => 'Jumlah Anak',
            'noSuratKeteranganBebasNarkoba' => 'No Surat Keterangan Bebas Narkoba',
            'tglSuratKeteranganBebasNarkoba' => 'Tgl Surat Keterangan Bebas Narkoba',
            'skck' => 'Skck',
            'tglSkck' => 'Tgl Skck',
            'akteKelahiran' => 'Akte Kelahiran',
            'akteMeninggal' => 'Akte Meninggal',
            'tglMeninggal' => 'Tgl Meninggal',
            'noNpwp' => 'No Npwp',
            'tglNpwp' => 'Tgl Npwp',
            'noAskes' => 'No Askes',
            'bpjs' => 'Bpjs',
            'kodePos' => 'Kode Pos',
            'noSpmt' => 'No Spmt',
            'tglSpmt' => 'Tgl Spmt',
            'noTaspen' => 'No Taspen',
            'bahasa' => 'Bahasa',
            'kppnId' => 'Kppn ID',
            'kppnNama' => 'Kppn Nama',
            'pangkatAkhir' => 'Pangkat Akhir',
            'tglSttpl' => 'Tgl Sttpl',
            'nomorSttpl' => 'Nomor Sttpl',
            'nomorSkCpns' => 'Nomor Sk Cpns',
            'nomorSkPns' => 'Nomor Sk Pns',
            'jenjang' => 'Jenjang',
            'jabatanAsn' => 'Jabatan Asn',
            'kartuAsn' => 'Kartu Asn',
            'mkTahun' => 'Mk Tahun',
            'mkBulan' => 'Mk Bulan',
            'flag' => 'Flag',
            'updated' => 'Updated',
            'validNik' => 'Valid NIK',
        ];
    }

    public function getNamaPegawai()    
    {  
        if ($this->gelarBelakang === null && $this->gelarDepan === null) $namapns = $this->nama;
        else if ($this->gelarBelakang === null) $namapns = $this->gelarDepan.' '.$this->nama;
        else if ($this->gelarDepan === null) $namapns = $this->nama.', '.$this->gelarBelakang;
        else $namapns = $this->gelarDepan.' '.$this->nama.', '.$this->gelarBelakang;
        return $namapns;   
    }
    
}

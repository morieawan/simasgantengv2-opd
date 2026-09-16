<?php

namespace app\modules\sitampan\models;

use Yii;
use app\modules\simpeg\models\EpsMastfip;
use app\modules\simpeg\models\EpsTgolru;
use app\modules\gaji\models\SimasGajiStapegTbl;
use app\modules\gaji\models\SimasGajiMstPegawai;
use app\modules\integrasi\models\SiasnDataUtama;
use app\modules\sitampan\models\PreskinHariKerja;


/**
 * This is the model class for table "preskin_asn".
 *
 * @property string $nip
 * @property string $idpns
 * @property int $kode_kelas_jab
 * @property int $kode_jadwal dari tabel preskin_kelas_jab
 * @property int $pres flag jadwal presensi
 * @property int $kin flag kinerja
 * @property int $tpp flag tpp (bulan), tidak dapat tpp=0, dapat=12, 
 * @property string|null $tmt_stop tmt penghentian tpp
 * @property int $status status asn ambil dari gaji
 * @property string $updated
 */
class PreskinAsn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preskin_asn';
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
            [['nip'], 'required'],
            [['kode_kelas_jab', 'kode_jadwal', 'pres', 'kin', 'tpp', 'status'], 'default', 'value' => 0],
            [['kode_kelas_jab', 'kode_jadwal', 'pres', 'kin', 'tpp', 'status'], 'integer'],
            [['tmt_stop', 'updated'], 'safe'],
            [['nip'], 'string', 'max' => 18],
            [['idpns'], 'string', 'max' => 128],
            [['nip'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nip' => 'NIP',
            'idpns' => 'ID PNS',
            'kode_kelas_jab' => 'Kode Kelas Jabatan',
            'kode_jadwal' => 'Kode Jadwal',
            'pres' => 'Presensi',
            'kin' => 'Kinerja',
            'tpp' => 'TPP',
            'tmt_stop' => 'TMT Stop',
            'status' => 'Status',
            'updated' => 'Updated',
        ];
    }

    public function getAsnFip()  
    {  
        return $this->hasOne(EpsMastfip::className(), ['B_02' => 'nip']);  
    }

    public function getFipNm()  
    {  
        if($this->asnFip === null) return '-';
        else return $this->asnFip['B_03'];  
    }

    public function getFipNama()  
    {  
        if($this->asnFip === null) return '-';
        else return $this->asnFip['namaPegawai'];  
    }

    public function getFipGol()  
    {  
        if($this->asnFip === null) return '-';
        else {
            $kd = $this->asnFip['E_04'];
            $gol = EpsTgolru::findOne($kd);
            if($gol !== null){
                if($this->status != 12) $gol = ucwords(strtolower(($gol['PANJANG']))).' - '.$gol['NAMA'];
                else $gol = $gol['PPPK'];
            }
            else $gol = '-'; 
            return $gol;
        }
    }

    public function getFipJabatan()  
    {  
        if($this->asnFip === null) return '-';
        else return $this->asnFip['G_05B'];  
    }

    public function getFipUnor()  
    {  
        if($this->asnFip === null) return '-';
        else return $this->asnFip['unorDetail'];  
    }

    public function getFipTablokb()  
    {  
        if($this->asnFip === null) return '-';
        else return $this->asnFip['A_01'].$this->asnFip['A_02'].$this->asnFip['A_03'].$this->asnFip['A_04'];  
    }

    public function getFipTablok()  
    {  
        if($this->asnFip === null) return '-';
        else return $this->asnFip['A_01'].'000000';  
    }

    public function getFipNamaByNip($nip)  
    {  
        $fip = EpsMastfip::find()->where(['B_02' => $nip])->one();
        if($fip === null) return '-';
        else return $fip['namaPegawai'];  
    }

    public function getFipGolByNip($nip)  
    {  
        $fip = EpsMastfip::find()->where(['B_02' => $nip])->one();
        if($fip === null) return '-';
        else {
            $kd = $fip['E_04'];
            $gol = EpsTgolru::findOne($kd);
            if($gol !== null){
                if($this->status != 12) $gol = ucwords(strtolower(($gol['PANJANG']))).' - '.$gol['NAMA'];
                else $gol = $gol['PPPK'];
            }
            else $gol = '-'; 
            return $gol;
        }
    }
    public function getFipJabatanByNip($nip)  
    {  
        $fip = EpsMastfip::find()->where(['B_02' => $nip])->one();
        if($fip === null) return '-';
        else return $fip['G_05B'];  
    }

    public function getFipUnorByNip($nip)  
    {  
        $fip = EpsMastfip::find()->where(['B_02' => $nip])->one();
        if($fip === null) return '-';
        else return $fip['unorDetail'];  
    }

    public function getAsnSiasn()  
    {  
        $siasn = $this->hasOne(SiasnDataUtama::className(), ['nipBaru' => 'nip']);  
        
        if($siasn === null) return '-';
        else return $siasn;
    }

    public function getAsnGaji()  
    {  
        return $this->hasOne(SimasGajiMstpegawai::className(), ['NIP' => 'nip']);  
    }

    public function getStapeg()  
    {  
        return $this->hasOne(SimasGajiStapegTbl::className(), ['KDSTAPEG' => 'status']);  
    }

    public function getAsnKelas()  
    {  
        return $this->hasOne(PreskinPaguTpp::className(), ['id' => 'kode_kelas_jab']);  
    }

    public function getAsnJadwalKerja()  
    {  
        return $this->hasOne(PreskinHariKerja::className(), ['id' => 'kode_jadwal']);  
    }

    public function getAsnPresensi()  
    {  
        return $this->hasMany(PresHarian::className(), ['nip' => 'nip']);  
    }
}

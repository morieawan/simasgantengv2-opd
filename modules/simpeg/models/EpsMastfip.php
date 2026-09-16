<?php

namespace app\modules\simpeg\models;

use Yii;
use app\models\Fungsi;

/**
 * This is the model class for table "eps_mastfip".
 *
 * @property string|null $A_00
 * @property string|null $A_01
 * @property string|null $A_02
 * @property string|null $A_03
 * @property string|null $A_04
 * @property string|null $B_01
 * @property string $B_02
 * @property string|null $B_03A
 * @property string $B_03
 * @property string|null $B_03B
 * @property string|null $B_04
 * @property string|null $B_05
 * @property int|null $B_06
 * @property int|null $B_07
 * @property int|null $B_08
 * @property int|null $B_09
 * @property int|null $B_10
 * @property string|null $B_11
 * @property string|null $B_12
 * @property string|null $B_13
 * @property int|null $B_14
 * @property string|null $B_15
 * @property string|null $B_16
 * @property int|null $B_17
 * @property string|null $C_00
 * @property string|null $C_01
 * @property string|null $C_02
 * @property string|null $C_03
 * @property int|null $C_04
 * @property string|null $D_00
 * @property string|null $D_01
 * @property string|null $D_02
 * @property int|null $D_03
 * @property string|null $D_04
 * @property int|null $D_05
 * @property string|null $E_01
 * @property string|null $E_02
 * @property string|null $E_03
 * @property int|null $E_04
 * @property string|null $E_05
 * @property string|null $E_06
 * @property string|null $E_07
 * @property string|null $F_01
 * @property string|null $F_02
 * @property string|null $F_02A
 * @property int|null $F_03
 * @property string|null $F_04
 * @property string|null $F_05
 * @property string|null $F_06
 * @property int|null $F_07
 * @property string|null $G_01
 * @property string|null $G_02
 * @property string|null $G_03
 * @property string|null $G_04
 * @property string|null $G_05
 * @property int|null $G_05A
 * @property string|null $G_05B
 * @property int|null $G_06
 * @property string|null $G_07
 * @property string|null $G_08
 * @property string|null $G_09
 * @property string|null $G_10
 * @property string|null $G_11
 * @property string|null $G_11A
 * @property int|null $H_01
 * @property string|null $H_02
 * @property int|null $H_03
 * @property int|null $I_01
 * @property string|null $I_02
 * @property int|null $I_03
 * @property string|null $J_01
 * @property string|null $J_02
 * @property string|null $J_03
 * @property string|null $J_04
 * @property string|null $J_05
 * @property string|null $J_06
 * @property string|null $J_07
 * @property string|null $J_08
 * @property string|null $K_01
 * @property string|null $K_02
 * @property string|null $K_03
 * @property string|null $K_04
 * @property int|null $K_05
 * @property int|null $K_06
 * @property string|null $K_07
 * @property int|null $L_01
 * @property int|null $L_02
 * @property string|null $M_01
 * @property string|null $M_02
 * @property string|null $M_03
 * @property int|null $M_04
 * @property string|null $M_05
 * @property string|null $M_06
 * @property string|null $M_07
 * @property int|null $Z_99
 * @property string|null $no_telp
 * @property string|null $foto
 * @property string|null $nik
 * @property string|null $updated
 */
class EpsMastfip extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eps_mastfip';
    }

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
            [['B_02', 'B_03'], 'required'],
            [['B_05', 'C_01', 'C_03', 'D_02', 'D_04', 'E_03', 'E_05', 'F_01', 'F_06', 'G_03', 'G_04', 'G_09', 'G_10', 'I_02', 'J_03', 'J_07', 'K_03', 'K_04', 'M_03', 'M_05', 'updated'], 'safe'],
            [['B_06', 'B_07', 'B_08', 'B_09', 'B_10', 'B_14', 'B_17', 'C_04', 'D_03', 'D_05', 'E_04', 'F_03', 'F_07', 'G_05A', 'G_06', 'H_01', 'H_03', 'I_01', 'I_03', 'K_05', 'K_06', 'L_01', 'L_02', 'M_04', 'Z_99'], 'default', 'value' => null],
            [['B_06', 'B_07', 'B_08', 'B_09', 'B_10', 'B_14', 'B_17', 'C_04', 'D_03', 'D_05', 'E_04', 'F_03', 'F_07', 'G_05A', 'G_06', 'H_01', 'H_03', 'I_01', 'I_03', 'K_05', 'K_06', 'L_01', 'L_02', 'M_04', 'Z_99'], 'integer'],
            [['A_00', 'A_01', 'A_02', 'A_03', 'A_04', 'B_01', 'F_02', 'F_02A'], 'string', 'max' => 2],
            [['B_02', 'K_07'], 'string', 'max' => 18],
            [['B_03A'], 'string', 'max' => 10],
            [['B_03', 'foto'], 'string', 'max' => 50],
            [['B_03B'], 'string', 'max' => 15],
            [['B_04', 'B_11', 'B_12', 'B_13', 'B_15', 'B_16', 'C_00', 'D_00', 'E_01', 'E_07', 'F_04', 'G_01', 'G_05B', 'J_04', 'J_08', 'no_telp'], 'string', 'max' => 255],
            [['C_02', 'G_02', 'G_08', 'G_11A', 'J_02', 'J_06', 'K_02', 'M_01', 'M_02', 'M_07'], 'string', 'max' => 100],
            [['D_01', 'E_02', 'F_05', 'J_01', 'J_05', 'K_01', 'email', 'email_gov', 'kartu_asn'], 'string', 'max' => 150],
            [['E_06', 'G_11', 'M_06'], 'string', 'max' => 4],
            [['G_05'], 'string', 'max' => 8],
            [['G_07'], 'string', 'max' => 3],
            [['H_02'], 'string', 'max' => 6],
            [['nik'], 'string', 'max' => 20],
            [['B_02'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'A_00' => 'A 00',
            'A_01' => 'OPD',
            'A_02' => 'A 02',
            'A_03' => 'Unor',
            'A_04' => 'A 04',
            'B_01' => 'B 01',
            'B_02' => 'NIP',
            'B_03A' => 'B 03a',
            'B_03' => 'Nama',
            'B_03B' => 'B 03b',
            'B_04' => 'B 04',
            'B_05' => 'B 05',
            'B_06' => 'B 06',
            'B_07' => 'B 07',
            'B_08' => 'Status',
            'B_09' => 'B 09',
            'B_10' => 'Kedudukan',
            'B_11' => 'B 11',
            'B_12' => 'B 12',
            'B_13' => 'B 13',
            'B_14' => 'B 14',
            'B_15' => 'B 15',
            'B_16' => 'B 16',
            'B_17' => 'B 17',
            'C_00' => 'C 00',
            'C_01' => 'C 01',
            'C_02' => 'C 02',
            'C_03' => 'C 03',
            'C_04' => 'C 04',
            'D_00' => 'D 00',
            'D_01' => 'D 01',
            'D_02' => 'D 02',
            'D_03' => 'D 03',
            'D_04' => 'D 04',
            'D_05' => 'D 05',
            'E_01' => 'E 01',
            'E_02' => 'E 02',
            'E_03' => 'E 03',
            'E_04' => 'GOL',
            'E_05' => 'E 05',
            'E_06' => 'E 06',
            'E_07' => 'E 07',
            'F_01' => 'F 01',
            'F_02' => 'F 02',
            'F_02A' => 'F 02a',
            'F_03' => 'F 03',
            'F_04' => 'F 04',
            'F_05' => 'F 05',
            'F_06' => 'F 06',
            'F_07' => 'F 07',
            'G_01' => 'G 01',
            'G_02' => 'G 02',
            'G_03' => 'G 03',
            'G_04' => 'G 04',
            'G_05' => 'G 05',
            'G_05A' => 'G 05a',
            'G_05B' => 'G 05b',
            'G_06' => 'G 06',
            'G_07' => 'G 07',
            'G_08' => 'G 08',
            'G_09' => 'G 09',
            'G_10' => 'G 10',
            'G_11' => 'G 11',
            'G_11A' => 'G 11a',
            'H_01' => 'H 01',
            'H_02' => 'H 02',
            'H_03' => 'H 03',
            'I_01' => 'I 01',
            'I_02' => 'I 02',
            'I_03' => 'I 03',
            'J_01' => 'J 01',
            'J_02' => 'J 02',
            'J_03' => 'J 03',
            'J_04' => 'J 04',
            'J_05' => 'J 05',
            'J_06' => 'J 06',
            'J_07' => 'J 07',
            'J_08' => 'J 08',
            'K_01' => 'K 01',
            'K_02' => 'K 02',
            'K_03' => 'K 03',
            'K_04' => 'K 04',
            'K_05' => 'K 05',
            'K_06' => 'K 06',
            'K_07' => 'K 07',
            'L_01' => 'L 01',
            'L_02' => 'L 02',
            'M_01' => 'M 01',
            'M_02' => 'M 02',
            'M_03' => 'M 03',
            'M_04' => 'M 04',
            'M_05' => 'M 05',
            'M_06' => 'M 06',
            'M_07' => 'M 07',
            'Z_99' => 'Z 99',
            'no_telp' => 'No Telp',
            'foto' => 'Foto',
            'nik' => 'Nik',
            'email' => 'E-mail',
            'email_gov' => 'E-mail Gov',
            'kartu_asn' => 'Kartu ASN',
            'updated' => 'Updated',
        ];
    }

    public static function primaryKey()
    {
        return ["B_02"];
    }

    public function getNamaPegawai()  
    {  
        if (($this->B_03B == '-' || $this->B_03B == '') && ($this->B_03A == '-' || $this->B_03A == '')) $namapns = $this->B_03;
        else if ($this->B_03B == '-' || $this->B_03B == '') $namapns = $this->B_03A.'. '.$this->B_03;
        else if ($this->B_03A == '-' || $this->B_03A == '') $namapns = $this->B_03.', '.$this->B_03B;
        else $namapns = $this->B_03A.'. '.$this->B_03.', '.$this->B_03B;
        return $namapns;   
    }

    public function getGolruCpns()
    {
        return $this->hasOne(EpsTgolru::className(), ['KODE' => 'C_04']);
    }

    public function getGolruPns()
    {
        return $this->hasOne(EpsTgolru::className(), ['KODE' => 'D_03']);
    }

    public function getGolruAkhir()
    {
        return $this->hasOne(EpsTgolru::className(), ['KODE' => 'E_04']);
    }

    public function getMastfipTablok()
    {
        $this->A_01 = $this->A_01."000000"; 
        return $this->hasOne(EpsTablok::className(), ['KD' => 'A_01']);
    } 

    public function getMastfipTablokb()
    {
        $kolok = substr($this->A_01,0,2).$this->A_02.$this->A_03.$this->A_04;
        return EpsTablokb::find()->where(['KOLOK' => $kolok])->one();
    }

    public function getElapkin()
    {
        return $this->hasOne(Elapkin::className(), ['nip' => 'B_02']);
    }

    public function getPnsGender()
    {
        return $this->hasOne(EpsKonstanJk::className(), ['kode' => 'B_06']);
    }

    public function getPnsAgama()
    {
        return $this->hasOne(EpsKonstanAgama::className(), ['kode' => 'B_07']);
    }

    public function getPnsKedudukan()
    {
        return $this->hasOne(EpsKonstanKedudukanpegawai::className(), ['kode' => 'B_10']);
    }
    
    public function getPnsStatus()
    {
        return $this->hasOne(EpsKonstanStatuskepegawaian::className(), ['kode' => 'B_08']);
    }

    public function getPnsEsel()
    {
        return $this->hasOne(EpsTesel::className(), ['KODE' => 'G_06']);
    }

    public function getPnsJabPortal()
    {
        return $this->hasOne(EpsKonstanJabatanPortal::className(), ['kode' => 'G_05A']);
    }
    
    public function getPnsTabdik()
    {
        return $this->hasOne(EpsTabdik::className(), ['KOD' => 'H_01']);
    }
    
    public function getPnsTabdikAll()
    {
        return $this->hasOne(EpsTabdikAll::className(), ['TKT' => 'H_01', 'KOD' => 'H_02']);
    }

    public function getPnsVtabdikAll()
    {
        return $this->hasOne(VtabdikAll::className(), ['KOD' => 'H_02']);
    }

    public function getPnsKin()
    {
        return $this->hasOne(MasAsn::className(), ['nip' => 'B_02']);
    }

    public function getPnsSapk()
    {
        return $this->hasOne(SapkDataPns::className(), ['nipBaru' => 'B_02']);
    }
    
    public function getFipMastjab()
    {
        return $this->hasOne(EpsMastjab::className(), ['B_02' => 'B_02']);
    }

    public function getFipTablok()
    {
        return EpsTablok::find()->where(['LEFT("KD",2)' => $this->A_01])->one();
    }

    public function getFipTablokb()
    {
        $tablokb = substr($this->A_01,0,2).$this->A_02.$this->A_03.$this->A_04 ;
        return EpsTablokb::find()->where(['KOLOK' => $tablokb])->one();
    }

    public static function fipNalok($kolok)
    {  
        return EpsTablokb::find()->where(['KOLOK' => $kolok])->one()['NALOK'];
    } 

    public static function mastfipData($id)
    {
        $simpeg = EpsMastfip::find()->where(['B_02' => $id])->asArray()->one();
        
        if($simpeg['A_01'] !== null && $simpeg['A_01'] != '-'){
            $tablok = $simpeg['A_01'];
            $tablokb = $simpeg['A_01'].'00'.$simpeg['A_03'].$simpeg['A_04'];
            $simpeg['opd'] = EpsTablokb::getOpd($tablok);
            $simpeg['unor'] = EpsTablokb::findOne($tablokb)['NALOK'];

        } else {
            $tablok = '';
            $tablokb = '';
            $simpeg['opd'] = '';
            $simpeg['unor'] = '';
        }
        
        $simpeg['jk'] = $simpeg['B_06'] !== null ? EpsKonstanJk::find()->where(['kode' => $simpeg['B_06']])->one()['nm_siasn'] : '';
        $simpeg['agama'] = $simpeg['B_07'] !== null ? EpsKonstanAgama::find()->where(['kode' => $simpeg['B_07']])->one()['nama'] : '';
        $simpeg['kedudukan'] = $simpeg['B_10'] !== null ? EpsKonstanKedudukanpegawai::find()->where(['kode' => $simpeg['B_10']])->one()['nama'] : '';
        $simpeg['marital'] = $simpeg['B_09'] !== null ? EpsKonstanMarital::find()->where(['kode' => $simpeg['B_09']])->one()['nama'] : '';
        $simpeg['golPns'] = $simpeg['D_03'] !== null ? EpsTgolru::find()->where(['KODE' => $simpeg['D_03']])->one()['NAMA'] :  '';
        $simpeg['golAkhir'] = $simpeg['E_04'] !== null ? EpsTgolru::find()->where(['KODE' => $simpeg['E_04']])->one()['NAMA'] : '';
        $simpeg['jenisJab'] = $simpeg['G_05A'] !== null ? EpsKonstanJabatanPortal::find()->where(['kode' => $simpeg['G_05A']])->one()['nama'] : '';
        
        if($simpeg['B_10'] !== null && $simpeg['B_10'] != '-'){
            $simpeg['stapeg'] = $simpeg['B_10'] == 71 ? 'PPPK' : 'PNS';
            $simpeg['golPns'] = $simpeg['B_10'] == 71 && $simpeg['golPns'] !='' ? 
                EpsTgolru::find()->where(['KODE' => $simpeg['D_03']])->one()['PPPK'] : 
                EpsTgolru::find()->where(['KODE' => $simpeg['D_03']])->one()['NAMA'];
            $simpeg['golAkhir'] = $simpeg['B_10'] == 71 && $simpeg['golAkhir'] !='' ? 
                EpsTgolru::find()->where(['KODE' => $simpeg['E_04']])->one()['PPPK'] : EpsTgolru::find()->where(['KODE' => $simpeg['E_04']])->one()['NAMA'];
        } else {
            $simpeg['stapeg'] = '';
            $simpeg['golAkhir'] = '';
        }


        //if($simpeg['B_10'] == 71) $simpeg['stapeg'] ='PPPK'; else $simpeg['stapeg'] = 'PNS';
        
        $simpeg_attr = EpsMastfip::getTableSchema()->getColumnNames();

        foreach($simpeg_attr as $atts => $vas){
            if(EpsMastfip::getTableSchema()->getColumn($vas)->type == 'date') $simpeg["$vas"] = fungsi::tgldmy($simpeg["$vas"]);
        }

        return $simpeg;
    }

    public function getUnorInduk()
    {
        $kolok = $this->A_01.'000000';
        //return $kolok;
        if(EpsTablokb::findOne($kolok) === null) $induk = $kolok;
        else $induk = EpsTablokb::findOne($kolok)['INDUK']; 

        if(EpsTablokb::findOne($induk) === null) $nama = $induk; 
        else $nama = EpsTablokb::findOne($induk)['NALOK'];
        return $nama;
    } 

    public function getUnorBidang()
    {
        $induk = $this->A_01.$this->A_02.'0000';

        if(EpsTablokb::findOne($induk) === null) $nama = $induk; 
        else $nama = EpsTablokb::findOne($induk)['NALOK'];
        return $nama;
    } 

    public function getUnor()
    {
        $kolok = $this->A_01.$this->A_02.$this->A_03.$this->A_04;
    
        if(EpsTablokb::findOne($kolok) === null) $nama = $kolok; 
        else $nama = EpsTablokb::findOne($kolok)['NALOK'];
        return $nama;
    } 

    public function getUnorDetail()
    {
        $kolok = $this->A_01.$this->A_02.$this->A_03.$this->A_04;
        if(EpsTablokb::findOne($kolok) === null) $nama = $kolok; 
        else{
            $bid = EpsTablokb::findOne($kolok)['BIDANG'];
            $unt = EpsTablokb::findOne($kolok)['UNIT'];
            if($bid === null) $bid = '-';
            if($unt === null) $unt = '-'; 

            $nama = EpsTablokb::findOne($unt)['NALOK'];
        }
        return $nama;
    } 
    
    public function getUnorUnit()
    {
        $kolok = $this->A_01.$this->A_02.$this->A_03.$this->A_04;
    
        if(EpsTablokb::findOne($kolok) === null) $unit = $kolok; 
        else{
            $unit = EpsTablokb::findOne($kolok)['UNIT'];
        }
        return $unit;
    } 

    public function getSiasn()
    {
        return $this->hasOne(\app\modules\integrasi\models\SiasnDataUtama::className(), ['nipBaru' => 'B_02']);
    } 
}

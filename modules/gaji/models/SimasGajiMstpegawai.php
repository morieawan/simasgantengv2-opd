<?php

namespace app\modules\gaji\models;

use Yii;

/**
 * This is the model class for table "gaji_mstpegawai".
 *
 * @property string $NIP
 * @property string|null $NAMA
 * @property string|null $GLRDEPAN
 * @property string|null $GLRBELAKANG
 * @property int|null $KDJENKEL
 * @property string|null $TEMPATLHR
 * @property string|null $TGLLHR
 * @property int|null $AGAMA
 * @property int|null $zakat_dg
 * @property string|null $PENDIDIKAN
 * @property string|null $TMTCAPEG
 * @property string|null $TMTSKMT
 * @property int|null $KDSTAWIN
 * @property int|null $JISTRI
 * @property int|null $JANAK
 * @property int|null $KDSTAPEG
 * @property string|null $TMTSTOP
 * @property string|null $KDPANGKAT
 * @property int|null $MKGOLT
 * @property int|null $BLGOLT
 * @property int|null $GAPOK
 * @property int|null $MASKER
 * @property float|null $PRSNGAPOK
 * @property string|null $TMTTABEL
 * @property string|null $TMTKGB
 * @property string|null $TMTKGBYAD
 * @property string|null $KDESELON
 * @property int|null $TJESELON
 * @property int|null $KDFUNGSI1
 * @property string|null $KDFUNGSI
 * @property int|null $TJFUNGSI
 * @property int|null $BUP
 * @property int|null $KDSTRUK
 * @property int|null $TJSTRUK
 * @property string|null $KDGURU
 * @property int|null $TJGURU
 * @property int|null $KDBERAS
 * @property int|null $KDLANGKA
 * @property int|null $TJLANGKA
 * @property int|null $KDTKD
 * @property int|null $TJTKD
 * @property string|null $KDTERPENCIL
 * @property int|null $TJTERPENCIL
 * @property string|null $KDTJKHUSUS
 * @property int|null $TJKHUSUS
 * @property string|null $KDKORPRI
 * @property int|null $PKORPRI
 * @property string|null $KDKOPERASI
 * @property int|null $PKOPERASI
 * @property string|null $KDIRDHATA
 * @property int|null $PIRDHATA
 * @property int|null $TAPERUM
 * @property int|null $PSEWA
 * @property string|null $NODOSIR
 * @property string|null $KDCABTASPEN
 * @property string|null $KDSSBP
 * @property string|null $KDSKPD
 * @property string|null $KDSATKER
 * @property string|null $ALAMAT
 * @property string|null $KDDATI4
 * @property string|null $KDDATI3
 * @property string|null $KDDATI2
 * @property string|null $KDDATI1
 * @property string|null $NOTELP
 * @property string|null $NOKTP
 * @property string|null $NPWP
 * @property string|null $NPWPZ
 * @property string|null $NIPLAMA
 * @property int|null $KDHITUNG
 * @property string|null $KODEBYR
 * @property string|null $induk_bank
 * @property string|null $NOREK
 * @property string|null $TMTBERLAKU
 * @property string|null $CATATAN
 * @property int|null $KDJNSTRANS
 * @property string|null $UPDSTAMP
 * @property string|null $INPUTER
 * @property int|null $kd_infaq
 * @property string|null $NOKARPEG
 * @property int|null $jnsguru
 * @property string|null $EMAIL
 * @property int|null $KD_JNS_PEG
 * @property string $updated
 */
class SimasGajiMstpegawai extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gaji_mstpegawai';
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
            [['NIP'], 'required'],
            [['KDJENKEL', 'AGAMA', 'zakat_dg', 'KDSTAWIN', 'JISTRI', 'JANAK', 'KDSTAPEG', 'MKGOLT', 'BLGOLT', 'GAPOK', 'MASKER', 'TJESELON', 'KDFUNGSI1', 'TJFUNGSI', 'BUP', 'KDSTRUK', 'TJSTRUK', 'TJGURU', 'KDBERAS', 'KDLANGKA', 'TJLANGKA', 'KDTKD', 'TJTKD', 'TJTERPENCIL', 'TJKHUSUS', 'PKORPRI', 'PKOPERASI', 'PIRDHATA', 'TAPERUM', 'PSEWA', 'KDHITUNG', 'KDJNSTRANS', 'kd_infaq', 'jnsguru', 'KD_JNS_PEG'], 'default', 'value' => null],
            [['KDJENKEL', 'AGAMA', 'zakat_dg', 'KDSTAWIN', 'JISTRI', 'JANAK', 'KDSTAPEG', 'MKGOLT', 'BLGOLT', 'GAPOK', 'MASKER', 'TJESELON', 'KDFUNGSI1', 'TJFUNGSI', 'BUP', 'KDSTRUK', 'TJSTRUK', 'TJGURU', 'KDBERAS', 'KDLANGKA', 'TJLANGKA', 'KDTKD', 'TJTKD', 'TJTERPENCIL', 'TJKHUSUS', 'PKORPRI', 'PKOPERASI', 'PIRDHATA', 'TAPERUM', 'PSEWA', 'KDHITUNG', 'KDJNSTRANS', 'kd_infaq', 'jnsguru', 'KD_JNS_PEG'], 'integer'],
            [['TGLLHR', 'TMTCAPEG', 'TMTSKMT', 'TMTSTOP', 'TMTTABEL', 'TMTKGB', 'TMTKGBYAD', 'TMTBERLAKU', 'UPDSTAMP', 'updated'], 'safe'],
            [['PRSNGAPOK'], 'number'],
            [['NIP'], 'string', 'max' => 18],
            [['NAMA', 'CATATAN', 'EMAIL'], 'string', 'max' => 50],
            [['GLRDEPAN', 'GLRBELAKANG', 'NOKTP', 'NOKARPEG'], 'string', 'max' => 30],
            [['TEMPATLHR', 'NOTELP', 'NOREK'], 'string', 'max' => 40],
            [['PENDIDIKAN', 'KDPANGKAT', 'KDESELON', 'KDTJKHUSUS', 'KDKORPRI', 'KDKOPERASI', 'KDIRDHATA', 'KDSATKER', 'NPWP', 'NPWPZ', 'INPUTER'], 'string', 'max' => 20],
            [['KDFUNGSI'], 'string', 'max' => 5],
            [['KDGURU', 'KDTERPENCIL', 'KDCABTASPEN', 'KDSSBP', 'KDSKPD', 'KDDATI4'], 'string', 'max' => 3],
            [['NODOSIR', 'KODEBYR'], 'string', 'max' => 10],
            [['ALAMAT'], 'string', 'max' => 60],
            [['KDDATI3', 'KDDATI2', 'KDDATI1'], 'string', 'max' => 2],
            [['NIPLAMA'], 'string', 'max' => 9],
            [['induk_bank'], 'string', 'max' => 4],
            [['NIP'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NIP' => 'NIP',
            'NAMA' => 'Nama',
            'GLRDEPAN' => 'Glrdepan',
            'GLRBELAKANG' => 'Glrbelakang',
            'KDJENKEL' => 'Kdjenkel',
            'TEMPATLHR' => 'Tempatlhr',
            'TGLLHR' => 'Tgllhr',
            'AGAMA' => 'Agama',
            'zakat_dg' => 'Zakat Dg',
            'PENDIDIKAN' => 'Pendidikan',
            'TMTCAPEG' => 'Tmtcapeg',
            'TMTSKMT' => 'Tmtskmt',
            'KDSTAWIN' => 'Kdstawin',
            'JISTRI' => 'Jistri',
            'JANAK' => 'Janak',
            'KDSTAPEG' => 'STAPEG',
            'TMTSTOP' => 'Tmtstop',
            'KDPANGKAT' => 'GOL',
            'MKGOLT' => 'Mkgolt',
            'BLGOLT' => 'Blgolt',
            'GAPOK' => 'Gapok',
            'MASKER' => 'Masker',
            'PRSNGAPOK' => 'Prsngapok',
            'TMTTABEL' => 'Tmttabel',
            'TMTKGB' => 'Tmtkgb',
            'TMTKGBYAD' => 'Tmtkgbyad',
            'KDESELON' => 'Kdeselon',
            'TJESELON' => 'Tjeselon',
            'KDFUNGSI1' => 'Kdfungsi1',
            'KDFUNGSI' => 'Kdfungsi',
            'TJFUNGSI' => 'Tjfungsi',
            'BUP' => 'Bup',
            'KDSTRUK' => 'Kdstruk',
            'TJSTRUK' => 'Tjstruk',
            'KDGURU' => 'Kdguru',
            'TJGURU' => 'Tjguru',
            'KDBERAS' => 'Kdberas',
            'KDLANGKA' => 'Kdlangka',
            'TJLANGKA' => 'Tjlangka',
            'KDTKD' => 'Kdtkd',
            'TJTKD' => 'Tjtkd',
            'KDTERPENCIL' => 'Kdterpencil',
            'TJTERPENCIL' => 'Tjterpencil',
            'KDTJKHUSUS' => 'Kdtjkhusus',
            'TJKHUSUS' => 'Tjkhusus',
            'KDKORPRI' => 'Kdkorpri',
            'PKORPRI' => 'Pkorpri',
            'KDKOPERASI' => 'Kdkoperasi',
            'PKOPERASI' => 'Pkoperasi',
            'KDIRDHATA' => 'Kdirdhata',
            'PIRDHATA' => 'Pirdhata',
            'TAPERUM' => 'Taperum',
            'PSEWA' => 'Psewa',
            'NODOSIR' => 'Nodosir',
            'KDCABTASPEN' => 'Kdcabtaspen',
            'KDSSBP' => 'Kdssbp',
            'KDSKPD' => 'SKPD',
            'KDSATKER' => 'SATKER',
            'ALAMAT' => 'Alamat',
            'KDDATI4' => 'Kddati4',
            'KDDATI3' => 'Kddati3',
            'KDDATI2' => 'Kddati2',
            'KDDATI1' => 'Kddati1',
            'NOTELP' => 'Notelp',
            'NOKTP' => 'Noktp',
            'NPWP' => 'Npwp',
            'NPWPZ' => 'Npwpz',
            'NIPLAMA' => 'Niplama',
            'KDHITUNG' => 'Kdhitung',
            'KODEBYR' => 'Kodebyr',
            'induk_bank' => 'Induk Bank',
            'NOREK' => 'Norek',
            'TMTBERLAKU' => 'Tmtberlaku',
            'CATATAN' => 'Catatan',
            'KDJNSTRANS' => 'Kdjnstrans',
            'UPDSTAMP' => 'Updstamp',
            'INPUTER' => 'Inputer',
            'kd_infaq' => 'Kd Infaq',
            'NOKARPEG' => 'Nokarpeg',
            'jnsguru' => 'Jnsguru',
            'EMAIL' => 'Email',
            'KD_JNS_PEG' => 'Kd Jns Peg',
            'updated' => 'Updated',
        ];
    }

    public function getNamaPegawai()  
    {  
        if ((trim($this->GLRBELAKANG) == '' || $this->GLRBELAKANG == '') && (trim($this->GLRDEPAN) == '' || $this->GLRDEPAN == '')) $namapns = $this->NAMA;
        else if (trim($this->GLRBELAKANG) == '' || $this->GLRBELAKANG == '') $namapns = $this->GLRDEPAN.'. '.$this->NAMA;
        else if (trim($this->GLRDEPAN) == '' || $this->GLRDEPAN == '') $namapns = $this->NAMA.', '.$this->GLRBELAKANG;
        else $namapns = $this->GLRDEPAN.'. '.$this->NAMA.', '.$this->GLRBELAKANG;
        return $namapns;   
    }

    public function getStapeg()
    {
        return $this->hasOne(SimasGajiStapegTbl::className(), ['KDSTAPEG' => 'KDSTAPEG']);
    }

    public function getSkpd()
    {
        return $this->hasOne(SimasGajiSkpdTbl::className(), ['KDSKPD' => 'KDSKPD']);
    }

    public function getSatker()
    {
        return $this->hasOne(SimasGajiSatkerTbl::className(), ['KDSATKER' => 'KDSATKER']);
    }
}

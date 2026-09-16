<?php

namespace app\modules\gaji\models;

use Yii;

/**
 * This is the model class for table "fgaji".
 *
 * @property string $TGLGAJI
 * @property int $KDJNSTRANS
 * @property string $NIP
 * @property string|null $NAMA
 * @property string|null $GLRDEPAN
 * @property string|null $GLRBELAKANG
 * @property int|null $KDJENKEL
 * @property string|null $TGLLHR
 * @property int|null $KDSTAWIN 0 LAJANG,1 KAWIN,2 CERAI,3 JD/DD
 * @property int|null $JISTRI
 * @property int|null $JANAK
 * @property int|null $KDSTAPEG
 * @property string|null $TMTSTOP
 * @property string|null $KDPANGKAT
 * @property int|null $MASKER
 * @property float|null $PRSNGAPOK
 * @property string|null $TMTTABEL
 * @property string|null $KDESELON
 * @property string|null $KDFUNGSI
 * @property string|null $KDGURU
 * @property int|null $KDSTRUK
 * @property int|null $KDBERAS
 * @property int|null $KDLANGKA
 * @property string|null $KDTERPENCIL
 * @property int|null $KDTKD
 * @property string|null $KDTJKHUSUS
 * @property string|null $KDKORPRI
 * @property string|null $KDKOPERASI
 * @property string|null $KDIRDHATA
 * @property int|null $GAPOK
 * @property int|null $TJISTRI
 * @property int|null $TJANAK
 * @property int|null $TJTPP
 * @property int|null $TJESELON
 * @property int|null $TJFUNGSI
 * @property int|null $TJSTRUK
 * @property int|null $TJGURU
 * @property int|null $TJLANGKA
 * @property int|null $TJTKD
 * @property int|null $TJTERPENCIL
 * @property int|null $TJKHUSUS
 * @property int|null $TJBERAS
 * @property int|null $TJPAJAK
 * @property int|null $TJASKES
 * @property int|null $TJUMUM
 * @property int|null $TJKK
 * @property int|null $TJKM
 * @property int|null $ttaperap
 * @property int|null $TBULAT
 * @property int|null $KOTOR
 * @property int|null $PIWP
 * @property int|null $PIWP8
 * @property int|null $PIWP2
 * @property int|null $PASKES
 * @property int|null $PPAJAK
 * @property int|null $PBULOG
 * @property int|null $PTAPERUM
 * @property int|null $PSEWA
 * @property int|null $PHUTANG
 * @property int|null $PKORPRI
 * @property int|null $PIRDHATA
 * @property int|null $PKOPERASI
 * @property int|null $PJKK
 * @property int|null $PJKM
 * @property int|null $ptaperap
 * @property int|null $ptaperai
 * @property int|null $POTONGAN
 * @property int|null $BERSIH
 * @property string|null $NODOSIR
 * @property string|null $KDSSBP
 * @property string|null $KDSKPD
 * @property string|null $KDSATKER
 * @property string|null $NPWP
 * @property string|null $NIPLAMA
 * @property int|null $KDHITUNG
 * @property string|null $KODEBYR
 * @property string|null $NOREK
 * @property string|null $CATATAN
 * @property int|null $NU
 * @property int|null $HAL
 * @property int|null $jeniskekurangan
 * @property int|null $KD_ZAKAT
 * @property string|null $NOKTP
 * @property string|null $TMT_RAPEL
 * @property string|null $TAT_RAPEL
 * @property int|null $JML_BULAN
 * @property int|null $jnsguru
 * @property string $KDDATI1
 * @property string $KDDATI2
 * @property int|null $kd_jns_peg
 * @property float|null $prosen_iwp
 */
class DbgajidoFgaji extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fgaji';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db5');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TGLGAJI', 'KDJNSTRANS', 'NIP', 'KDDATI1', 'KDDATI2'], 'required'],
            [['TGLGAJI', 'TGLLHR', 'TMTSTOP', 'TMTTABEL', 'TMT_RAPEL', 'TAT_RAPEL'], 'safe'],
            [['KDJNSTRANS', 'KDJENKEL', 'KDSTAWIN', 'JISTRI', 'JANAK', 'KDSTAPEG', 'MASKER', 'KDSTRUK', 'KDBERAS', 'KDLANGKA', 'KDTKD', 'GAPOK', 'TJISTRI', 'TJANAK', 'TJTPP', 'TJESELON', 'TJFUNGSI', 'TJSTRUK', 'TJGURU', 'TJLANGKA', 'TJTKD', 'TJTERPENCIL', 'TJKHUSUS', 'TJBERAS', 'TJPAJAK', 'TJASKES', 'TJUMUM', 'TJKK', 'TJKM', 'ttaperap', 'TBULAT', 'KOTOR', 'PIWP', 'PIWP8', 'PIWP2', 'PASKES', 'PPAJAK', 'PBULOG', 'PTAPERUM', 'PSEWA', 'PHUTANG', 'PKORPRI', 'PIRDHATA', 'PKOPERASI', 'PJKK', 'PJKM', 'ptaperap', 'ptaperai', 'POTONGAN', 'BERSIH', 'KDHITUNG', 'NU', 'HAL', 'jeniskekurangan', 'KD_ZAKAT', 'JML_BULAN', 'jnsguru', 'kd_jns_peg'], 'integer'],
            [['PRSNGAPOK', 'prosen_iwp'], 'number'],
            [['NIP'], 'string', 'max' => 18],
            [['NAMA', 'CATATAN'], 'string', 'max' => 50],
            [['GLRDEPAN', 'GLRBELAKANG'], 'string', 'max' => 30],
            [['KDPANGKAT', 'KDESELON', 'KDKORPRI', 'KDKOPERASI', 'KDIRDHATA', 'KDDATI1', 'KDDATI2'], 'string', 'max' => 2],
            [['KDFUNGSI', 'KDTJKHUSUS'], 'string', 'max' => 5],
            [['KDGURU', 'KDTERPENCIL', 'KDSSBP', 'KDSKPD'], 'string', 'max' => 3],
            [['NODOSIR', 'KODEBYR'], 'string', 'max' => 10],
            [['KDSATKER', 'NPWP', 'NOKTP'], 'string', 'max' => 20],
            [['NIPLAMA'], 'string', 'max' => 9],
            [['NOREK'], 'string', 'max' => 40],
            [['TGLGAJI', 'KDJNSTRANS', 'NIP', 'KDDATI1', 'KDDATI2'], 'unique', 'targetAttribute' => ['TGLGAJI', 'KDJNSTRANS', 'NIP', 'KDDATI1', 'KDDATI2']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TGLGAJI' => 'Tglgaji',
            'KDJNSTRANS' => 'Kdjnstrans',
            'NIP' => 'Nip',
            'NAMA' => 'Nama',
            'GLRDEPAN' => 'Glrdepan',
            'GLRBELAKANG' => 'Glrbelakang',
            'KDJENKEL' => 'Kdjenkel',
            'TGLLHR' => 'Tgllhr',
            'KDSTAWIN' => 'Kdstawin',
            'JISTRI' => 'Jistri',
            'JANAK' => 'Janak',
            'KDSTAPEG' => 'Kdstapeg',
            'TMTSTOP' => 'Tmtstop',
            'KDPANGKAT' => 'Kdpangkat',
            'MASKER' => 'Masker',
            'PRSNGAPOK' => 'Prsngapok',
            'TMTTABEL' => 'Tmttabel',
            'KDESELON' => 'Kdeselon',
            'KDFUNGSI' => 'Kdfungsi',
            'KDGURU' => 'Kdguru',
            'KDSTRUK' => 'Kdstruk',
            'KDBERAS' => 'Kdberas',
            'KDLANGKA' => 'Kdlangka',
            'KDTERPENCIL' => 'Kdterpencil',
            'KDTKD' => 'Kdtkd',
            'KDTJKHUSUS' => 'Kdtjkhusus',
            'KDKORPRI' => 'Kdkorpri',
            'KDKOPERASI' => 'Kdkoperasi',
            'KDIRDHATA' => 'Kdirdhata',
            'GAPOK' => 'Gapok',
            'TJISTRI' => 'Tjistri',
            'TJANAK' => 'Tjanak',
            'TJTPP' => 'Tjtpp',
            'TJESELON' => 'Tjeselon',
            'TJFUNGSI' => 'Tjfungsi',
            'TJSTRUK' => 'Tjstruk',
            'TJGURU' => 'Tjguru',
            'TJLANGKA' => 'Tjlangka',
            'TJTKD' => 'Tjtkd',
            'TJTERPENCIL' => 'Tjterpencil',
            'TJKHUSUS' => 'Tjkhusus',
            'TJBERAS' => 'Tjberas',
            'TJPAJAK' => 'Tjpajak',
            'TJASKES' => 'Tjaskes',
            'TJUMUM' => 'Tjumum',
            'TJKK' => 'Tjkk',
            'TJKM' => 'Tjkm',
            'ttaperap' => 'Ttaperap',
            'TBULAT' => 'Tbulat',
            'KOTOR' => 'Kotor',
            'PIWP' => 'Piwp',
            'PIWP8' => 'Piwp8',
            'PIWP2' => 'Piwp2',
            'PASKES' => 'Paskes',
            'PPAJAK' => 'Ppajak',
            'PBULOG' => 'Pbulog',
            'PTAPERUM' => 'Ptaperum',
            'PSEWA' => 'Psewa',
            'PHUTANG' => 'Phutang',
            'PKORPRI' => 'Pkorpri',
            'PIRDHATA' => 'Pirdhata',
            'PKOPERASI' => 'Pkoperasi',
            'PJKK' => 'Pjkk',
            'PJKM' => 'Pjkm',
            'ptaperap' => 'Ptaperap',
            'ptaperai' => 'Ptaperai',
            'POTONGAN' => 'Potongan',
            'BERSIH' => 'Bersih',
            'NODOSIR' => 'Nodosir',
            'KDSSBP' => 'Kdssbp',
            'KDSKPD' => 'Kdskpd',
            'KDSATKER' => 'Kdsatker',
            'NPWP' => 'Npwp',
            'NIPLAMA' => 'Niplama',
            'KDHITUNG' => 'Kdhitung',
            'KODEBYR' => 'Kodebyr',
            'NOREK' => 'Norek',
            'CATATAN' => 'Catatan',
            'NU' => 'Nu',
            'HAL' => 'Hal',
            'jeniskekurangan' => 'Jeniskekurangan',
            'KD_ZAKAT' => 'Kd Zakat',
            'NOKTP' => 'Noktp',
            'TMT_RAPEL' => 'Tmt Rapel',
            'TAT_RAPEL' => 'Tat Rapel',
            'JML_BULAN' => 'Jml Bulan',
            'jnsguru' => 'Jnsguru',
            'KDDATI1' => 'Kddati1',
            'KDDATI2' => 'Kddati2',
            'kd_jns_peg' => 'Kd Jns Peg',
            'prosen_iwp' => 'Prosen Iwp',
        ];
    }
}

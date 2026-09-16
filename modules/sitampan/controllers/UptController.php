<?php

namespace app\modules\sitampan\controllers;

use Yii;
use app\modules\sitampan\models\FpPresensiCheckinoutHp;
use app\modules\sitampan\models\PreskinAsn;
use app\modules\sitampan\models\PreskinAsnSearch;
use app\modules\sitampan\models\PresHarian;
use app\modules\sitampan\models\PresHarianSearch;
use app\modules\sitampan\models\PreskinHariKerja;
use app\modules\sitampan\models\PreskinJamKerja;
use app\modules\sitampan\models\PreskinLibur;
use app\modules\sitampan\models\PreskinPresJenis;
use app\modules\sitampan\models\PreskinParam;
use app\modules\sitampan\models\PreskinPaguTpp;
use app\modules\sitampan\models\PreskinTppHitung;
use app\modules\sitampan\models\PreskinTppHitungSearch;

use app\modules\sitampan\models\KinHarian;
use app\modules\sitampan\models\KinHarianSearch;
use app\modules\sitampan\models\KinAtasan;
use app\modules\sitampan\models\KinAtasanSearch;
use app\modules\sitampan\models\KinJenisOutput;

use app\modules\sitampan\models\PresKet;
use app\modules\sitampan\models\PresKetSearch;
use app\modules\sitampan\models\PresKetJenis;

use app\modules\simpeg\models\EpsMastfip;
use app\modules\simpeg\models\EpsMastfipSearch;
use app\modules\simpeg\models\EpsTablokb;

use app\modules\gaji\models\SimasGajiStapegTbl;

use app\models\Fungsi;

use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;

use kartik\mpdf\Pdf;


/**
 * PresHarianController implements the CRUD actions for PresHarian model.
 */
class UptController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=>function(){
                            if(Yii::$app->session['module'] != 9)  return $this->redirect(['/']);
                            else return (Yii::$app->session['module'] == 9);
                        },
                    ],
                ],                   
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Finds the PresHarian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PresHarian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PresHarian::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findAsn($id)
    {
        if (($model = PreskinAsn::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function PreskinAsn($group, $view)
    {
        $namapd = EpsTablokb::getUnor($group);

        $opd = EpsTablokb::find()
        ->select(['KOLOK', 'UPT', "NALOK", "CONCAT(\"KOLOK\",' ',\"NALOK\") AS UNOR"])
        ->asArray()
        ->andWhere(['UPT' => $group])
        ->orderBy(['KOLOK' => SORT_ASC])
        ->all();

        $sta = SimasGajiStapegTbl::find()
        ->select(['KDSTAPEG', 'NMSTAPEG'])
        ->where(['OR',['KDSTAPEG' => [0, 3, 4, 6, 12, 23, 24, 27, 28]]])
        ->orderBy(['KDSTAPEG' => SORT_ASC])
        ->all();
        
        $searchModel = new PreskinAsnSearch();
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        if(isset($searchModel['status'])){
            if($searchModel['status'] == '') $dataProvider->query->andFilterWhere(['<', 'status', 13]);
        }else $dataProvider->query->andFilterWhere(['between', 'status', 1, 13]);

        $so = [];
        foreach($opd as $pd){
            $so[] = $pd['KOLOK'];
        }

        if(isset($searchModel)){
            if($searchModel['opd'] == '' && $searchModel['nip'] == '' && $searchModel['nama'] == ''){ 
                $dataProvider->query
                ->andFilterWhere(['OR',['CONCAT("a"."A_01",a."A_02",a."A_03",a."A_04")' => $so[0]]]);

                $searchModel['opd'] = $so[0];
            }

            if($searchModel['opd'] == $so[0]){
                $dataProvider->query
                ->andFilterWhere(['OR',['CONCAT("a"."A_01",a."A_02",a."A_03",a."A_04")' => $so[0]]]);
            }

        }

        $dataProvider->query->orderBy([
            'a.A_01' => SORT_ASC,
            'a.A_03' => SORT_ASC,
            'a.A_04' => SORT_ASC,
            'status' => SORT_ASC,
            'a.E_04' => SORT_DESC, 
            'a.G_06' => SORT_ASC, 
            'nip' => SORT_ASC, 
 
        ]);

        $data = [
            'view' => $view, 
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'opd' => $opd,
            'sta' => $sta,
            'namapd' => $namapd,
            'so' => $so,
        ];

        return $data;
    }

    /**
     * Lists all PresHarian models.
     * @return mixed
     */
    public function actionIndex()
    {
        $sess = Yii::$app->session;
        $group = $sess['groupview'];
        $view = 'index';
        
        $dt = $this->preskinAsn($group, $view);
        
        $this->layout = '//main-upt';

        Url::remember();
        return $this->render($dt['view'], [
            'searchModel' => $dt['searchModel'],
            'dataProvider' => $dt['dataProvider'],
            'opd' => $dt['opd'],
            'sta' => $dt['sta'],
            'namapd' => $dt['namapd'],
        ]);
    }

    public function actionPresensi()
    {
        $sess = Yii::$app->session;
        $group = $sess['groupview'];
        $view = 'index-presensi';

        $bulan = date('m');
        $tahun = date('Y');

        $req = Yii::$app->request;
        if($req->get()){
            if($req->get('periode') !== null){
                $per = explode('-',$req->get('periode'));
                $bulan = $per[0];
                $tahun = $per[1];
            }
        }

        if(substr($bulan, 0,1) == 0) $b = substr($bulan, 1,1);
        else $b = $bulan;
        
        $dt = $this->preskinAsn($group, $view);
        
        $this->layout = '//main-upt';

        Url::remember();
        return $this->render($dt['view'], [
            'searchModel' => $dt['searchModel'],
            'dataProvider' => $dt['dataProvider'],
            'opd' => $dt['opd'],
            'sta' => $dt['sta'],
            'namapd' => $dt['namapd'],
            'bulan' => $bulan,
            'tahun' => $tahun,
            'namabul' => Fungsi::Nmbulan($b),
        ]);
    }

    public function actionPenerimaTpp()
    {  
        $sess = Yii::$app->session;
        $pd = $sess['tablokb'];

        $opd = EpsTablokb::find()
        ->select(['KOLOK', 'GROUP_USER'])
        ->where(['KOLOK' => $pd])
        ->one();

        $group = $opd['GROUP_USER'];
        $namapd = EpsTablokb::findOne($group)['NALOK'];
        if($namapd === null) $namapd = '';

        $opdlist = EpsTablokb::find()
        ->select(['KOLOK', 'GROUP_CETAK', 'GROUP_VIEW', 'UNIT', "NALOK", "CONCAT(\"KOLOK\",' ',\"NALOK\") AS UNOR"])
        ->asArray()
        ->where(new yii\db\Expression('"KOLOK" = "GROUP_CETAK"'))
        ->andWhere(['GROUP_VIEW' => $group, 'UPT' => $group])
        ->orderBy(['KOLOK' => SORT_ASC])
        ->all();

        $gr = [];
        foreach($opdlist as $op){
            $gr[] = $op['KOLOK'];
        }

        $searchModel = new PreskinTppHitungSearch();

        $searchModel['bulan'] = date('m');
        $searchModel['tahun'] = date('Y');
        $searchModel['tablok'] = $gr[0];

        $req = Yii::$app->request;
        if($req->get()){
            if($req->get('periode') !== null){
                $per = explode('-',$req->get('periode'));
                $searchModel['bulan'] = $per[0];
                $searchModel['tahun'] = $per[1];
            }
        }

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);   
        $dataProvider->query->andFilterWhere(['<', 'status', 99]);       

        $dataProvider->query->orderBy([
            'status' => SORT_ASC,
            'gol' => SORT_DESC, 
            'tablok' => SORT_ASC,
            'tablokb' => SORT_ASC,
            'jenis_jab' => SORT_ASC,  
        ]);

        $this->layout = '//main-upt';
        
        Url::remember();
        return $this->render('index-tpp-penerima', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'opd' => $opdlist, 'tahun' => $searchModel['tahun'], 'bulan' => $searchModel['bulan'],
            'namabul' => strtoupper(Fungsi::NmBulan(intval($searchModel['bulan']))),
            'namapd' => $namapd,
        ]);
    }

    public function actionCheckinout($id, $bulan, $tahun)
    { 
        $this->layout = '//main-upt';
        
        $asn = $this->findAsn($id);
        
        if($asn['asnJadwalKerja'] === null) $jk = 0;//$dt['kode_jadwal'];
        else $jk = $asn['asnJadwalKerja']['jenis'];

        $data = [
            'nip' => $id,
            'nama' => $asn['fipNama'],
            'jabatan' => $asn['fipJabatan'],
            'unor' => $asn['fipUnor'],
            'tahun' => $tahun, 
            'bulan' => $bulan,
            'bul' => ucwords(Fungsi::NmBulan(intval($bulan))),
            'jk' => $jk,
        ];

        $model = FpPresensiCheckinoutHp::find()
        ->where([
            'EXTRACT(month FROM DATE(checktime))' => $bulan, 
            'EXTRACT(year FROM DATE (checktime))' => $tahun,
            'nip' => $id,
        ])
        ->orderBy(['checktime' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $model,
            'pagination' => false
        ]);

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('presensi-checkinout', [
                'data' => $data,
                'dataProvider' => $dataProvider, 
            ]);
        }else{
            return $this->render('presensi-checkinout', [
                'data' => $data,
                'dataProvider' => $dataProvider, 
            ]);
        } 
    }

    public function actionPresensiHasil($id, $bulan, $tahun)
    {
        $this->layout = '//main-upt';
        
        $asn = $this->findAsn($id);

        if($asn['asnJadwalKerja'] === null) $jk = $dt['kode_jadwal'];
        else $jk = $asn['asnJadwalKerja']['jenis'];

        $model = FpPresensiCheckinoutHp::find()
        ->where([
            'EXTRACT(month FROM DATE(checktime))' => $bulan, 
            'EXTRACT(year FROM DATE (checktime))' => $tahun,
            'nip' => $id,
        ])
        ->orderBy(['checktime' => SORT_ASC]);

        $data = [
            'nip' => $id,
            'nama' => $asn['fipNama'],
            'jabatan' => $asn['fipJabatan'],
            'unor' => $asn['fipUnor'],
            'tahun' => $tahun, 
            'bulan' => $bulan,
            'bul' => ucwords(Fungsi::NmBulan(intval($bulan))),
            'jk' => $jk,
        ];

        $model = PresHarian::find()
        ->where([
            'EXTRACT(month FROM DATE(tgl))' => $bulan, 
            'EXTRACT(year FROM DATE (tgl))' => $tahun,
            'nip' => $id,
        ])
        ->orderBy(['tgl' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $model,
            'pagination' => false,
        ]);
        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('presensi-detail', [
                'data' => $data,
                'dataProvider' => $dataProvider, 
            ]);
        }else{
            return $this->render('presensi-detail', [
                'data' => $data,
                'dataProvider' => $dataProvider, 
            ]);
        } 
    }

    public function actionKinerjaHasil($id, $bulan, $tahun)
    {        
        $this->layout = '//main-upt';
                
        $searchModel = new KinHarianSearch([
            'nip' =>  $id,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);  
        $dataProvider->query->orderBy(['tgl' => SORT_ASC]);      
        $dataProvider->pagination = false;      

        $data = $dataProvider->query->one();

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('kinerja-detail', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            return $this->render('kinerja-detail', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'data' => $data,
            ]);
        }
    }

    public function actionCetakTppForm()
    {
        $arbul = [
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
            13 => 'Ketiga belas/ 13',
            14 => 'THR',
        ];

        $varta = date('Y') - 4;
        $arta = [];
        for ($y = $varta; $y < $varta + 5; $y++){
            $arta["$y"] = $y;
        }

        $sess = Yii::$app->session;
        $pd = $sess['tablokb'];

        $opd = EpsTablokb::find()
        ->select(['KOLOK', 'GROUP_USER'])
        ->where(['KOLOK' => $pd])
        ->one();

        $opdlist = EpsTablokb::find()
        ->select(['KOLOK', 'GROUP_VIEW', 'UNIT', "NALOK", "CONCAT(\"KOLOK\",' ',\"NALOK\") AS UNOR"])
        ->asArray()
        ->where(new yii\db\Expression('"KOLOK" = "UNIT"'))
        ->andWhere(['GROUP_VIEW' => $opd['GROUP_USER']])
        ->orderBy(['KOLOK' => SORT_ASC])
        ->all();

        //return Json::encode($opdlist, $asArray = true);

        return $this->render('form-cetak', [
            'arta' => $arta, 'arbul' => $arbul, 'opdlist' => $opdlist,
        ]);
    }

    public function actionCetakFormPdf()
    {
        $arbul = [
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
            13 => 'Ketiga belas/ 13',
            14 => 'THR',
        ];

        $varta = date('Y') - 4;
        $arta = [];
        for ($y = $varta; $y < $varta + 5; $y++){
            $arta["$y"] = $y;
        }

        $sess = Yii::$app->session;
        $pd = $sess['tablokb'];

        $opd = EpsTablokb::find()
        ->select(['KOLOK', 'GROUP_USER'])
        ->where(['KOLOK' => $pd])
        ->one();

        $opdlist = EpsTablokb::find()
        ->select(['KOLOK', 'GROUP_VIEW', 'UNIT', "NALOK", "CONCAT(\"KOLOK\",' ',\"NALOK\") AS UNOR"])
        ->asArray()
        ->where(new yii\db\Expression('"KOLOK" = "UNIT"'))
        ->andWhere(['GROUP_VIEW' => $opd['GROUP_USER']])
        ->orderBy(['KOLOK' => SORT_ASC])
        ->all();

        // if(substr($pd,0,4) == '4300'){
        //     $opdlist = EpsTablokb::find()
        //     ->select(['KOLOK', 'GROUP_VIEW', 'UNIT', "NALOK", "CONCAT(\"KOLOK\",' ',\"NALOK\") AS UNOR"])
        //     ->asArray()
        //     ->where(new yii\db\Expression('"KOLOK" = "UNIT"'))
        //     ->andWhere(['GROUP_VIEW' => $opd['GROUP_USER']])
        //     ->orderBy(['KOLOK' => SORT_ASC])
        //     ->all();
        // }

        //return Json::encode($opdlist, $asArray = true);

        return $this->render('form-cetak-pdf', [
            'arta' => $arta, 'arbul' => $arbul, 'opdlist' => $opdlist,
        ]);
    }

    public function actionCetakTpp()
    {
        $post = Yii::$app->request->post();
        $tahun = $post['tahun'];
        $bulan = $post['bulan'];
        $opd = $post['opd'];
        $status = $post['status'];

        if($bulan == 1) $bulan_huruf = 'Bulan Januari';
        elseif($bulan == 2) $bulan_huruf = 'Bulan Februari';
        elseif($bulan == 3) $bulan_huruf = 'Bulan Maret';
        elseif($bulan == 4) $bulan_huruf = 'Bulan April';
        elseif($bulan == 5) $bulan_huruf = 'Bulan Mei';
        elseif($bulan == 6) $bulan_huruf = 'Bulan Juni';
        elseif($bulan == 7) $bulan_huruf = 'Bulan Juli';
        elseif($bulan == 8) $bulan_huruf = 'Bulan Agustus';
        elseif($bulan == 9) $bulan_huruf = 'Bulan September';
        elseif($bulan == 10) $bulan_huruf = 'Bulan Oktober';
        elseif($bulan == 11) $bulan_huruf = 'Bulan November';
        elseif($bulan == 12) $bulan_huruf = 'Bulan Desember';
        elseif($bulan == 13) $bulan_huruf = 'Ketiga Belas Tahun';
        elseif($bulan == 14) $bulan_huruf= 'Tunjangan Hari Raya Tahun';

        $rum = [];
        $trekap = [];
        $tdetail = [];
        $no = 0;
        $nd = 0;
        for ($i = 4; $i > 0; $i--) {
            if($i == 1) {
                $x = 'I';
                $awal = 11;
                $akhir = 14;
            }elseif($i == 2){ 
                $x = 'II';
                $awal = 21;
                $akhir = 24;
            }elseif($i == 3){ 
                $x = 'III';
                $awal = 31;
                $akhir = 34;
            }elseif($i == 4){ 
                $x = 'IV';
                $awal = 41;
                $akhir = 45;
            }

            $tpp_rekap = PreskinTppHitung::find()
            ->select([
                'count(nip) as jml_pegawai',
                'sum(pagu_total) as jml_pagu_total',
                'sum(pagu_tpp) as jml_pagu_tpp',
                'sum(beban_kerja) as jml_beban_kerja',
                'sum(produktivitas_kerja) as jml_prod_kerja',
                'sum(kinerja_rp) as jml_kinerja_rp',
                'sum(presensi_rp) as jml_presensi_rp',
                'sum(sakip_rp) as jml_sakip_rp',
                'sum(rb_rp) as jml_rb_rp',
                'sum(tpp_jumlah) as jml_tpp_jumlah',
                'sum(cuti_rp) as jml_cuti_rp',
                'sum(hukdis_rp) as jml_hukdis_rp',
                'sum(tgr_rp) as jml_tgr_rp',
                'sum(pengurangan) as jml_pengurangan',
                'sum(tpp_total) as jml_tpp_total',
                'sum(pot_pph_rp) as jml_pph_rp',
                'sum(pot_bpjs4) as jml_bpjs4',
                'sum(tpp_bruto) as jml_tpp_bruto',
                'sum(pot_bpjs1) as jml_bpjs1',
                'sum(pot_jml) as jml_pot_jml',
                'sum(tpp_net) as jml_tpp_net',
            ])->asArray()
            ->where([
                'tahun' => $tahun,
                'bulan' => $bulan,
                'tablok' => $opd,
            ])
            ->andWhere([
                'and',['<=', 'gol', $akhir],['>=', 'gol', $awal]
            ])
            //->andWhere(['<', 'status', 99])
            ->andWhere(['status' => $status])
            ->all();

            $rekap = [];
            foreach($tpp_rekap as $trek){
                $no = $no + 1;
                $rekap = [
                    'no' => $no,
                    'gg' => $i,
                    'grum' => $x,
                    'jml_pegawai' => $trek['jml_pegawai'],
                    'jml_pagu_total' => $trek['jml_pagu_total'],
                    'jml_pagu_tpp' => $trek['jml_pagu_tpp'],
                    'jml_beban_kerja' => $trek['jml_beban_kerja'],
                    'jml_prod_kerja' => $trek['jml_prod_kerja'],
                    'jml_kinerja_rp' => $trek['jml_kinerja_rp'],
                    'jml_presensi_rp' => $trek['jml_presensi_rp'],
                    'jml_sakip_rp' => $trek['jml_sakip_rp'],
                    'jml_rb_rp' => $trek['jml_rb_rp'],
                    'jml_tpp_jumlah' => $trek['jml_tpp_jumlah'],
                    'jml_cuti_rp' => $trek['jml_cuti_rp'],
                    'jml_hukdis_rp' => $trek['jml_hukdis_rp'],
                    'jml_tgr_rp' => $trek['jml_tgr_rp'],
                    'jml_pengurangan' => $trek['jml_pengurangan'],
                    'jml_tpp_total' => $trek['jml_tpp_total'],
                    'jml_pph_rp' => $trek['jml_pph_rp'],
                    'jml_bpjs4' => $trek['jml_bpjs4'],
                    'jml_tpp_bruto' => $trek['jml_tpp_bruto'],
                    'jml_bpjs1' => $trek['jml_bpjs1'],
                    'jml_pot_jml' => $trek['jml_pot_jml'],
                    'jml_tpp_net' => $trek['jml_tpp_net'],
                ];
            }  

            $trekap[] = $rekap;

            //detail tpp per pegawai
            $tpp_detail = PreskinTppHitung::find()
            ->select([
                'nip',
                'nama',
                'nama_gol',
                'kelas_jab_tpp',
                'nama_kelas',
                'nama_jab',
                'pagu_total',
                'persen_tpp',
                'pagu_tpp',
                'beban_kerja',
                'produktivitas_kerja as prestasi_kerja',
                'kinerja',
                'kinerja_rp',
                'presensi',
                'presensi_rp',
                'sakip',
                'sakip_rp',
                'rb',
                'rb_rp',
                'cuti',
                'cuti_rp',
                'hukdis',
                'hukdis_rp',
                'tgr',
                'tgr_rp',
                'tpp_jumlah',
                'pot_bpjs4',
                'pot_bpjs1',
                'pengurangan',
                'tpp_total',
                'pph',
                'pot_pph_rp',
                'tpp_bruto',
                'pot_jml',
                'tpp_net',
            ])->asArray()
            ->where([
                'tahun' => $tahun,
                'bulan' => $bulan,
                'tablok' => $opd,
            ])
            ->andWhere([
                'and',['<=', 'gol', $akhir],['>=', 'gol', $awal]
            ])
            //->andWhere(['<', 'status', 99])
            ->andWhere(['status' => $status])
            ->orderBy(['gol' => SORT_DESC, 'kelas_jab_tpp' => SORT_DESC, 'tablokb' => SORT_ASC])
            ->all();

            $rinci = [];
            $dj_asn = 0;
            $dj_pagu = 0;
            $dj_beban = 0;
            $dj_prestasi = 0;
            $dj_kinerja = 0;
            $dj_presensi = 0;
            $dj_sakip = 0;
            $dj_rb = 0;
            $dj_cuti = 0;
            $dj_hukdis = 0;
            $dj_tgr = 0;
            $dj_total = 0;
            $dj_bpjs4 = 0;
            $dj_bpjs1 = 0;
            $dj_bruto = 0;
            $dj_pph = 0;
            $dj_pot = 0;
            $dj_net = 0;
            
            foreach($tpp_detail as $det){
                $nd = $nd + 1;
                // $tppkelas = \app\modules\tpp\models\TppPaguKelas::findOne($det['kode_kelas_jab']);
                // if($tppkelas !== null) $kelasjab = $tppkelas['kelas'];
                // else $kelasjab = "-";  

                $rinci[] = [
                    'nd' => $nd,
                    'nip' => $det['nip'],
                    'nama' => $det['nama'],
                    'nama_gol' => $det['nama_gol'],
                    'nama_jab' => $det['nama_jab'],
                    'kode_kelas_jab' => $det['kelas_jab_tpp'],
                    'kelasjab' => $det['nama_kelas'],
                    'pagu_total' => $det['pagu_total'],
                    'persen_tpp' => $det['persen_tpp'],
                    'pagu_tpp' => $det['pagu_tpp'],
                    'beban_kerja' => $det['beban_kerja'],
                    'prestasi_kerja' => $det['prestasi_kerja'],
                    'kinerja' => $det['kinerja'],
                    'kinerja_rp' => $det['kinerja_rp'],
                    'presensi' => $det['presensi'],
                    'presensi_rp' => $det['presensi_rp'],
                    'sakip' => $det['sakip'],
                    'sakip_rp' => $det['sakip_rp'],
                    'rb' => $det['rb'],
                    'rb_rp' => $det['rb_rp'],
                    'cuti' => $det['cuti'],
                    'cuti_rp' => $det['cuti_rp'],
                    'hukdis' => $det['hukdis'],
                    'hukdis_rp' => $det['hukdis_rp'],
                    'tgr' => $det['tgr'],
                    'tgr_rp' => $det['tgr_rp'],
                    'tpp_jumlah' => $det['tpp_jumlah'],
                    'bpjs4' => $det['pot_bpjs4'],
                    'bpjs1' => $det['pot_bpjs1'],
                    'pengurangan' => $det['pengurangan'],
                    'tpp_total' => $det['tpp_total'],
                    'pph' => $det['pph'],
                    'pph_rp' => $det['pot_pph_rp'],
                    'tpp_bruto' => $det['tpp_bruto'],
                    'pot_jml' => $det['pot_jml'],
                    'tpp_net' => $det['tpp_net'],                    
                ];
                $dj_asn = $dj_asn + 1;
                $dj_pagu = $dj_pagu + $det['pagu_tpp'];
                $dj_beban = $dj_beban + $det['beban_kerja'];
                $dj_prestasi = $dj_prestasi + $det['prestasi_kerja'];
                $dj_kinerja = $dj_kinerja + $det['kinerja_rp'];
                $dj_presensi = $dj_presensi + $det['presensi_rp'];
                $dj_sakip = $dj_sakip + $det['sakip_rp'];
                $dj_rb = $dj_rb + $det['rb_rp'];
                $dj_cuti = $dj_cuti + $det['cuti_rp'];
                $dj_hukdis = $dj_hukdis + $det['hukdis_rp'];
                $dj_tgr = $dj_tgr + $det['tgr_rp'];
                $dj_total = $dj_total + $det['tpp_total'];
                $dj_bpjs4 = $dj_bpjs4 + $det['pot_bpjs4'];
                $dj_bpjs1 = $dj_bpjs1 + $det['pot_bpjs1'];
                $dj_bruto = $dj_bruto + $det['tpp_bruto'];
                $dj_pph = $dj_pph + $det['pot_pph_rp'];
                $dj_pot = $dj_pot + $det['pot_jml'];
                $dj_net = $dj_net + $det['tpp_net'];
            }  

            $tdetail[] = [
                'gd' => $i,
                'gdrum' => $x,
                'dj_asn' => $dj_asn,
                'dj_pagu' => $dj_pagu,
                'dj_beban' => $dj_beban,
                'dj_prestasi' => $dj_prestasi,
                'dj_kinerja' => $dj_kinerja,
                'dj_presensi' => $dj_presensi,
                'dj_sakip' => $dj_sakip,
                'dj_rb' => $dj_rb,
                'dj_cuti' => $dj_cuti,
                'dj_hukdis' => $dj_hukdis,
                'dj_tgr' => $dj_tgr,
                'dj_total' => $dj_total,
                'dj_bpjs4' => $dj_bpjs4,
                'dj_bpjs1' => $dj_bpjs1,
                'dj_bruto' => $dj_bruto,
                'dj_pph' => $dj_pph,
                'dj_pot' => $dj_pot,
                'dj_net' => $dj_net,
                'rinci' => $rinci,
            ];
            // end detail tpp
        }

        $nama_opd = EpsTablokb::findOne($opd)['NALOK'];
        if($nama_opd === null) $nama_opd = '';

        $data[] = [
            'bulan' => $bulan,
            'bulan_huruf' => $bulan_huruf,
            'tahun' => $tahun,
            'opd_nama' => $nama_opd,
            'rekap' => $trekap,
            'detail' => $tdetail,
        ];
                
        $content =  $this->renderPartial('tpp-pdf-cetak', [
            'data' => $data,
        ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, 
            'format' => Pdf::FORMAT_FOLIO, 
            'orientation' => Pdf::ORIENT_LANDSCAPE, 
            'destination' => Pdf::DEST_BROWSER, 
            'content' => $content,  
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:12px}', 
            'options' => ['title' => 'Cetak TPP '.$nama_opd],
            'methods' => [ 
                //'SetHeader'=>['TPP '.ucfirst(Fungsi::NmBulan($bulan).' '.$tahun)], 
                'SetFooter'=>['
                <div align="right"> '.$nama_opd.' : Hal. {PAGENO}</div>
                '],
            ]
        ]);
        
        if($status == 0){
            $mpdf = $pdf->getApi();
            //$mpdf->SetWatermarkText('img/theimage.png',0.2, '',[10,150]);
            $mpdf->SetWatermarkText(' - -  D R A F T   - - ');
            $mpdf->showWatermarkText = true;
        }
        return $pdf->render(); 
    }

}

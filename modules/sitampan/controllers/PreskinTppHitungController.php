<?php

namespace app\modules\sitampan\controllers;

use Yii;
use app\modules\sitampan\models\PreskinTppHitung;
use app\modules\sitampan\models\PreskinTppHitungSearch;
use app\modules\sitampan\models\PreskinGroupCetak;
use app\modules\simpeg\models\EpsTablokb;
use app\models\Fungsi;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\helpers\Json;
use kartik\mpdf\Pdf;

/**
 * PreskinTppHitungController implements the CRUD actions for PreskinTppHitung model.
 */
class PreskinTppHitungController extends Controller
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
                            if(Yii::$app->session['module'] != 6)  return $this->redirect(['/']);
                            else return (Yii::$app->session['module'] == 6);
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
     * Lists all PreskinTppHitung models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PreskinTppHitungSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        Url::remember('index');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPns()
    {
        $searchModel = new PreskinTppHitungSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        Url::remember('index');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PreskinTppHitung model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new PreskinTppHitung model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PreskinTppHitung();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Data berhasil disimpan.');
            return $this->redirect(Url::previous());
        }

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model, 
            ]);
        }else{
            return $this->render('create', [
                'model' => $model, 
            ]);
        } 
    }

    /**
     * Updates an existing PreskinTppHitung model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Data berhasil diubah.');
            return $this->redirect(Url::previous());
        }

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('update', [
                'model' => $model, 
            ]);
        }else{
            return $this->render('update', [
                'model' => $model, 
            ]);
        } 
    }

    /**
     * Deletes an existing PreskinTppHitung model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        Yii::$app->session->setFlash('success', 'Data berhasil dihapus.');
        return $this->redirect(Url::previous());
    }

    /**
     * Finds the PreskinTppHitung model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PreskinTppHitung the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PreskinTppHitung::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
        $unor = $sess['tablok'];

        $opd = EpsTablokb::find()
        ->select(['KOLOK', 'GROUP_USER'])
        ->where(['KOLOK' => $pd])
        ->one();

        $opdlist = EpsTablokb::find()
        ->select(['KOLOK', 'GROUP_USER', 'UNIT', "NALOK", "CONCAT(\"KOLOK\",' ',\"NALOK\") AS UNOR"])
        ->asArray()
        ->where(new yii\db\Expression('"KOLOK" = "UNIT"'))
        ->andWhere(['GROUP_USER' => $opd['GROUP_USER']])
        ->orderBy(['KOLOK' => SORT_ASC])
        ->all();

        if(substr($pd,0,4) == '4300' && substr($pd,0,6) != '430006'){            
            $opdlist = EpsTablokb::find()
            ->select(['KOLOK', 'GROUP_VIEW', 'UNIT', "NALOK", "CONCAT(\"KOLOK\",' ',\"NALOK\") AS UNOR"])
            ->asArray()
            ->where(new yii\db\Expression('"KOLOK" = "UNIT"'))
            ->andWhere(['GROUP_VIEW' => $opd['GROUP_USER']])
            ->orderBy(['KOLOK' => SORT_ASC])
            ->all();
        }

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
        $jenis = $post['jenis'];

        // if($jenis <> 1){
        //     Yii::$app->session->setFlash('position', [
        //         'icon' => \dominus77\sweetalert2\Alert::TYPE_WARNING, 
        //         'title' => 'Maintenace',
        //         'text' => 'Modul masih dalam tahap pengembangan...',
        //         'showConfirmButton' => false,
        //         'timer' => 2000
        //     ]);
        //     return $this->redirect(['cetak-form-pdf']);
        // }

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

            if($jenis == 2){
                switch ($x) {
                    case 'I':
                        $x = 'I s.d IV';
                      break;
                    case 'II':
                        $x = 'V s.d VIII';
                      break;
                    case 'III':
                      $x = 'IX s.d XII';
                      break;
                    default: $x = 'XIII s.d XVII';
                }
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
                'sum(tj_pph_rp) as jml_tj_pph_rp',
                'sum(tj_bpjs4) as jml_tj_bpjs4',
                'sum(tpp_bruto) as jml_tpp_bruto',
                'sum(pot_pph_rp) as jml_pot_pph_rp',
                'sum(pot_bpjs4) as jml_pot_bpjs4',
                'sum(pot_bpjs1) as jml_pot_bpjs1',
                'sum(pot_jml) as jml_pot_jml',
                'sum(tpp_net) as jml_tpp_net',
            ])->asArray()
            ->where([
                'tahun' => $tahun,
                'bulan' => $bulan,
                'tablok' => $opd,
                'jtrans' => $jenis,
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
                    'jml_tj_pph_rp' => $trek['jml_tj_pph_rp'],
                    'jml_tj_bpjs4' => $trek['jml_tj_bpjs4'],
                    'jml_tpp_bruto' => $trek['jml_tpp_bruto'],
                    'jml_pot_pph_rp' => $trek['jml_pot_pph_rp'],
                    'jml_pot_bpjs4' => $trek['jml_pot_bpjs4'],
                    'jml_pot_bpjs1' => $trek['jml_pot_bpjs1'],
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
                'pengurangan',
                'tpp_total',
                'pph',
                'tj_pph_rp',
                'tj_bpjs4',
                'tpp_bruto',
                'pot_pph_rp',
                'pot_bpjs4',
                'pot_bpjs1',
                'pot_jml',
                'tpp_net',
            ])->asArray()
            ->where([
                'tahun' => $tahun,
                'bulan' => $bulan,
                'tablok' => $opd,
                'jtrans' => $jenis,
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
            $dj_pengurangan = 0;
            $dj_total = 0;
            $dj_tj_bpjs4 = 0;
            $dj_tj_pph = 0;
            $dj_bruto = 0;
            $dj_pot_bpjs4 = 0;
            $dj_pot_bpjs1 = 0;
            $dj_pot_pph = 0;
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
                    'pengurangan' => $det['pengurangan'],
                    'tpp_total' => $det['tpp_total'],
                    'pph' => $det['pph'],
                    'tj_pph_rp' => $det['tj_pph_rp'],
                    'tj_bpjs4' => $det['tj_bpjs4'],
                    'tpp_bruto' => $det['tpp_bruto'],
                    'pot_bpjs1' => $det['pot_bpjs1'],
                    'pot_bpjs4' => $det['pot_bpjs4'],
                    'pot_pph_rp' => $det['pot_pph_rp'],
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
                $dj_pengurangan = $dj_pengurangan + $det['pengurangan'];
                $dj_total = $dj_total + $det['tpp_total'];
                $dj_tj_bpjs4 = $dj_tj_bpjs4 + $det['tj_bpjs4'];
                $dj_tj_pph = $dj_tj_pph + $det['tj_pph_rp'];
                $dj_bruto = $dj_bruto + $det['tpp_bruto'];
                $dj_pot_pph = $dj_pot_pph + $det['pot_pph_rp'];
                $dj_pot_bpjs1 = $dj_pot_bpjs1 + $det['pot_bpjs1'];
                $dj_pot_bpjs4 = $dj_pot_bpjs4 + $det['pot_bpjs4'];
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
                'dj_pengurangan' => $dj_pengurangan,
                'dj_tj_bpjs4' => $dj_tj_bpjs4,
                'dj_tj_pph' => $dj_tj_pph,
                'dj_bruto' => $dj_bruto,
                'dj_pot_pph' => $dj_pot_pph,
                'dj_pot_bpjs4' => $dj_pot_bpjs4,
                'dj_pot_bpjs1' => $dj_pot_bpjs1,
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

       $view_cetak = 'tpp-pdf-cetak';
                
        $content =  $this->renderPartial($view_cetak, [
            'data' => $data,
        ]);

        if($jenis == 1) $jenis = 'PNS ';
        elseif($jenis == 2) $jenis = 'PPPK ';
        elseif($jenis == 4) $jenis = 'PJ/PLT/PLH ';

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
                    <div style="width: 100%;">
                        <div style="float: left; width: 30%; text-align: left;">Tgl Cetak : '.date('d-m-Y H:i:s').'</div>
                        <div style="float: right; width: 70%; text-align: right;">'.$nama_opd.' - '.$jenis.' : Hal. {PAGENO}</div>
                    </div>
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

    public function actionPenerimaTpp()
    {    
        $sess = Yii::$app->session;
        $pd = $sess['tablokb'];

        $opd = EpsTablokb::find()
        ->select(['KOLOK', 'GROUP_USER'])
        ->where(['KOLOK' => $pd])
        ->one();

        //return Json::encode($opd, $asArray = true);

        $group = $opd['GROUP_USER'];
        $namapd = EpsTablokb::findOne($group)['NALOK'];
        if($namapd === null) $namapd = '';

        $searchModel = new PreskinTppHitungSearch();

        $opdlist = EpsTablokb::find()
        ->select(['KOLOK', 'GROUP_USER', 'UNIT', "NALOK", "CONCAT(\"KOLOK\",' ',\"NALOK\") AS UNOR"])
        ->asArray()
        ->where(new yii\db\Expression('"KOLOK" = "UNIT"'))
        ->andWhere(['GROUP_USER' => $group])
        ->orderBy(['KOLOK' => SORT_ASC])
        ->all();

        if(substr($pd,0,4) == '4300' && substr($pd,0,6) != '430006'){
            $searchModel['tablok'] = '43000000';
            $opdlist = EpsTablokb::find()
            ->select(['KOLOK', 'GROUP_VIEW', 'UNIT', "NALOK", "CONCAT(\"KOLOK\",' ',\"NALOK\") AS UNOR"])
            ->asArray()
            ->where(new yii\db\Expression('"KOLOK" = "UNIT"'))
            ->andWhere(['GROUP_VIEW' => $group])
            ->orderBy(['KOLOK' => SORT_ASC])
            ->all();
        }

        $gr = [];
        foreach($opdlist as $op){
            $gr[] = $op['KOLOK'];
        }
        
        // $searchModel = new PreskinTppHitungSearch();

        $bln = date('n')-1;
        $thn = date('Y');

        if(strtotime(date('Y-m-d H:i:s')) < strtotime(date('Y-m-21 00:00:00'))) $bln = date('n')-1;
        else $bln = date('n');
        
        $thn = date('Y');
        if($bln == 0){
            $bln = 12;
            $thn = $thn - 1;
        }

        $req = Yii::$app->request;
        if($req->get()){
            if($req->get('periode') !== null){
                $per = explode('-',$req->get('periode'));
                $bln = $per[0];
                $thn = $per[1];
            }
        }

        $searchModel['bulan'] = $bln;
        $searchModel['tahun'] = $thn;
        $searchModel['jtrans'] = 1;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);   
        $dataProvider->query->andFilterWhere(['<=', 'status', 90]);

        if($searchModel['tablok'] === null)
            $dataProvider->query->andFilterWhere(['OR',['tablok' => $gr]]);
        else $dataProvider->query->andFilterWhere(['tablok' => $searchModel['tablok']]);

        //return Json::encode($gr, $asArray = true);

        $dataProvider->query->orderBy([
            'status' => SORT_ASC,
            'gol' => SORT_DESC, 
            'tablok' => SORT_ASC,
            'tablokb' => SORT_ASC,
            'jenis_jab' => SORT_ASC,  
        ]);

        $nb = $bln + 1;
        $nt = $thn;

        if($nb == 13){$nb = 1; $nt = $nt + 1;}

        if(time() < strtotime(date("$nt-$nb-06 08:00:00"))) $view = 'index-tpp-penerima-draf';
        else $view = 'index-tpp-penerima';

        Url::remember();
        return $this->render($view, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'opd' => $opdlist, 'thn' => $thn, 'bln' => $bln,
            'bul' => strtoupper(Fungsi::NmBulan(intval($bln))),
            'namapd' => $namapd,
        ]);
    }

    public function actionFinal($id)
    {
        $sess = Yii::$app->session;
        $model = $this->findModel($id);
        $model['status'] = 90;
        $model['tgl_final'] = date('Y-m-d H:i:s');
        $model['tgl_tpp'] = date('Y-m-d');
        $model['final_by'] = $sess['nip']."-".$sess['namapengguna'];

        if($model->save(false)){
            Yii::$app->session->setFlash('position', [
                'icon' => \dominus77\sweetalert2\Alert::TYPE_SUCCESS, 
                'title' => 'Berhasil',
                'text' => 'TPP '.$model['nip'].' '.$model['nama'].' telah Final',
                'showConfirmButton' => false,
                'timer' => 2000
            ]);
        };

        return $this->redirect(Url::previous());
    }
}

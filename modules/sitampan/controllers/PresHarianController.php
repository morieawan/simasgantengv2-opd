<?php

namespace app\modules\sitampan\controllers;

use Yii;
use app\modules\sitampan\models\PresHarian;
use app\modules\sitampan\models\PresHarianSearch;
use app\modules\sitampan\models\PreskinAsn;
use app\modules\sitampan\models\PreskinAsnSearch;
use app\modules\sitampan\models\PreskinHariKerja;
use app\modules\sitampan\models\PreskinJamKerja;
use app\modules\sitampan\models\PreskinLibur;
use app\modules\sitampan\models\FpPresensiCheckinoutHp;
use app\modules\sitampan\models\PresKet;
use app\modules\sitampan\models\PreskinPresJenis;
use app\modules\sitampan\models\PreskinParam;
use app\modules\simpeg\models\EpsMastfip;
use app\modules\simpeg\models\EpsMastfipSearch;
use app\modules\simpeg\models\EpsTablokb;
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

/**
 * PresHarianController implements the CRUD actions for PresHarian model.
 */
class PresHarianController extends Controller
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
                    'update-presensi' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PresHarian models.
     * @return mixed
     */
    public function actionIndexx()
    {
        $searchModel = new PresHarianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['nip' => Yii::$app->session['nip']]);
        
        Url::remember();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSearchJadwalOpd()
    {
        $sess = Yii::$app->session;
        $namapd = EpsTablokb::getUnor($sess['group_user']);

        $opd = EpsTablokb::find()
        ->select(['KOLOK', 'GROUP_USER', "NALOK", "CONCAT(\"KOLOK\",' ',\"NALOK\") AS UNOR"])
        ->asArray()
        ->andWhere(['GROUP_USER' => $sess['group_user']])
        ->all();
                
        $searchModel = new PreskinAsnSearch();
        
        $bln = date('n');
        $thn = date('Y');

        Url::remember();
        return $this->render('_search', [
            'model' => $searchModel,
            'opd' => $opd, 'thn' => $thn, 'bln' => $bln,
            'bul' => strtoupper(Fungsi::NmBulan(intval($bln))),
            'namapd' => $namapd,
            'title' => 'JADWAL KERJA '.$namapd,
        ]);
    }

    public function actionJadwalOpd()
    {
        $sess = Yii::$app->session;
        $namapd = EpsTablokb::getUnor($sess['group_user']);

        $opd = EpsTablokb::find()
        ->select(['KOLOK', 'GROUP_USER', "NALOK", "CONCAT(\"KOLOK\",' ',\"NALOK\") AS UNOR"])
        ->asArray()
        ->andWhere(['GROUP_USER' => $sess['group_user']])
        ->all();
        
        //return Json::encode($opd, $asArray = true);
        
        $searchModel = new PreskinAsnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);        
        //$dataProvider->query->andFilterWhere(['<', 'status', 13]);
        $dataProvider->query->andWhere(['OR',['<', 'status', 13],['>', 'tmt_stop', date('Y-m-01')], ['tmt_stop' => null]]);

        $so = [];
        foreach($opd as $pd){
            $so[] = $pd['KOLOK'];
        }

        $dataProvider->query->orderBy([
            'status' => SORT_ASC,
            'a.E_04' => SORT_DESC, 
            'a.A_01' => SORT_ASC,
            'a.A_03' => SORT_ASC,
            'a.A_01' => SORT_ASC,
            'a.G_06' => SORT_ASC,  
        ]);

        if(isset($searchModel)){
            if($searchModel['opd'] == '' && $searchModel['nip'] == '' && $searchModel['nama'] == '') 
                $dataProvider->query
                ->andFilterWhere(['OR',['CONCAT("a"."A_01",a."A_02",a."A_03",a."A_04")' => $so]]);
        }
        $dataProvider->query
            ->andFilterWhere(['OR',['CONCAT("a"."A_01",a."A_02",a."A_03",a."A_04")' => $so]]);

        $bln = date('n');
        $thn = date('Y');

        $req = Yii::$app->request;
        if($req->get()){
            if($req->get('periode') !== null){
                $per = explode('-',$req->get('periode'));
                $bln = $per[0];
                $thn = $per[1];
            }
        }else{
            return $this->render('_search', ['model' => $searchModel, 'opd' => $opd, 'bln' => $bln, 'thn' => $thn]);
        }

        $data = $dataProvider->query->all();
        if($data !== null){
            $dt = [];
            foreach($data as $dat){
                $presensi = PresHarian::find()
                ->select(['tgl', 'jd_masuk', 'jd_pulang'])
                ->where([
                    'nip' => $dat['nip'], 
                    'EXTRACT(month FROM tgl::date)' => $bln, 
                    'EXTRACT(year FROM tgl::date)' => $thn,
                ]);

                if($presensi->count() > 0){
                    $pr = [];     
                    foreach($presensi->all() as $pre){
                        $pr[] = [
                            'tgl' => $pre['tgl'],
                            'jd_masuk' => $pre['jd_masuk'],
                            'jd_pulang' => $pre['jd_pulang'],
                        ];
                    }
                }else $pr = [];
                
                $dt[] = [
                    'nip' => $dat['nip'],
                    'kode_jadwal' => $dat['kode_jadwal'],
                    'nama' => PreskinAsn::getFipNamaByNip($dat['nip']), 
                    'unor' => PreskinAsn::getFipUnorByNip($dat['nip']),
                    'presensi' => $pr,
                ];
            }
        }

        $dataProvider = new ArrayDataProvider(['allModels' => $dt]);

        $batas = PreskinParam::findOne(1)['batas_pres'];

        // $tgl = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
        $nthn = $thn;
        $nbln = $bln + 1;
        if($bln == 12){
            $nbln = 1;
            $nthn = $thn + 1;
        }

        if(time() < strtotime(date("$nthn-$nbln-$batas 23:59:59"))) 
            $view = 'index-jadwal';
        else $view = 'index-jadwal-last';


        Url::remember();
        return $this->render($view, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'opd' => $opd, 'thn' => $thn, 'bln' => $bln,
            'bul' => strtoupper(Fungsi::NmBulan(intval($bln))),
            'namapd' => $namapd,
        ]);
    }

    public function actionPresOpd()
    {
        // Yii::$app->response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        
        $sess = Yii::$app->session;
        $namapd = EpsTablokb::getUnor($sess['group_user']);

        $opd = EpsTablokb::find()
        ->select(['KOLOK', 'GROUP_USER', "NALOK", "CONCAT(\"KOLOK\",' ',\"NALOK\") AS UNOR"])
        ->asArray()
        ->andWhere(['GROUP_USER' => $sess['group_user']])
        ->all();
        
        //return Json::encode($opd, $asArray = true);
        
        $searchModel = new PreskinAsnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);        
        //$dataProvider->query->andFilterWhere(['<', 'status', 13]);
        $dataProvider->query->andWhere(['OR',['<', 'status', 13],['>', 'tmt_stop', date('Y-m-01')], ['tmt_stop' => null]]);
        
        $so = [];
        foreach($opd as $pd){
            $so[] = $pd['KOLOK'];
        }

        $dataProvider->query->orderBy([
            'status' => SORT_ASC,
            'a.E_04' => SORT_DESC, 
            'a.A_01' => SORT_ASC,
            'a.A_03' => SORT_ASC,
            'a.A_01' => SORT_ASC,
            'a.G_06' => SORT_ASC,  
        ]);

        if(isset($searchModel)){
            if($searchModel['opd'] == '' && $searchModel['nip'] == '' && $searchModel['nama'] == '') 
                $dataProvider->query
                ->andFilterWhere(['OR',['CONCAT("a"."A_01",a."A_02",a."A_03",a."A_04")' => $so]]);
        }
        $dataProvider->query
            ->andFilterWhere(['OR',['CONCAT("a"."A_01",a."A_02",a."A_03",a."A_04")' => $so]]);

        // $dataProvider->query->limit(2);    

        $bln = date('n');
        $thn = date('Y');

        $req = Yii::$app->request;
        if($req->get()){
            if($req->get('periode') !== null){
                $per = explode('-',$req->get('periode'));
                $bln = $per[0];
                $thn = $per[1];
            }
        }else{
            return $this->render('_search-pres', ['model' => $searchModel, 'opd' => $opd, 'bln' => $bln, 'thn' => $thn]);
        }

        $data = $dataProvider->query->all();
        if($data !== null){
            $dt = [];
            foreach($data as $dat){
                $presensi = PresHarian::find()
                ->select(['tgl', 'kd_pr_masuk', 'kd_pr_pulang'])
                ->where([
                    'nip' => $dat['nip'], 
                    'EXTRACT(month FROM tgl::date)' => $bln, 
                    'EXTRACT(year FROM tgl::date)' => $thn,
                ]);

                if($presensi->count() > 0){
                    $pr = [];     
                    foreach($presensi->all() as $pre){
                        $pr[] = [
                            'tgl' => $pre['tgl'],
                            'kd_pr_masuk' => $pre['kd_pr_masuk'],
                            'kd_pr_pulang' => $pre['kd_pr_pulang'],
                        ];
                    }
                }else $pr = [];
                
                $dt[] = [
                    'nip' => $dat['nip'],
                    'kode_jadwal' => $dat['kode_jadwal'],
                    'nama' => PreskinAsn::getFipNamaByNip($dat['nip']), 
                    'unor' => PreskinAsn::getFipUnorByNip($dat['nip']),
                    'presensi' => $pr,
                ];
            }
        }

        $dataProvider = new ArrayDataProvider(['allModels' => $dt]);

        Url::remember();
        return $this->render('index-presensi', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'opd' => $opd, 'thn' => $thn, 'bln' => $bln,
            'bul' => strtoupper(Fungsi::NmBulan(intval($bln))),
            'namapd' => $namapd,
        ]);
    }

    /**
     * Displays a single PresHarian model.
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
     * Creates a new PresHarian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PresHarian();

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
     * Updates an existing PresHarian model.
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
     * Deletes an existing PresHarian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeletes($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        Yii::$app->session->setFlash('success', 'Data berhasil dihapus.');
        return $this->redirect(Url::previous());
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

    public function actionUpdateJadwal($id, $bulan, $tahun)
    {
        $asn = $this->findAsn($id);

        if($asn['asnJadwalKerja'] === null) $jk = $dt['kode_jadwal'];
        else $jk = $asn['asnJadwalKerja']['jenis'];

        $model = new PresHarian([
            'nip' => $asn['nip'],
            'nama' => $asn['fipNm'],
            'idpns' => $asn['asnSiasn']['id'],
            'tablokb' => $asn['fipTablokb']
        ]);

        if($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            $nip = $model['nip'];
            $nama = $model['nama'];
            $idpns = $model['idpns'];
            $tablokb = $model['tablokb'];

            $t2 = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

            if($post['pilih-tgl'] == 0){
                $data = [];
                for($i=1; $i<=$t2; $i++) {
                    $data[] = $i;
                }
            }else{
                $data = [];
                $tgl = $post['PresHarian']['tgl'];
                foreach($tgl as $tg){
                    $data[] = $tg;
                }
            } 
                
            foreach($data as $key => $val){
                $tanggal = $tahun.'-'.$bulan.'-'.$val;
                $kode = $nip."-".date('Ymd', strtotime($tanggal));
                $mod = PresHarian::findOne($kode);

                if($mod === null){
                    $mod = new PresHarian();
                    $mod['kode'] = $kode;
                    $mod['tgl'] = $tanggal;
                    $mod['nip'] = $nip;
                    $mod['idpns'] = $idpns;
                    $mod['nama'] = $nama;
                    $mod['tablokb'] = $tablokb;
                }

                $hari = date('w', strtotime($tanggal));
                
                $jadwal = PreskinJamKerja::find()->where([
                    'jenis_hari_kerja' => $asn['kode_jadwal'],
                    'hari' => $hari,
                ])
                ;

                if($jadwal->count() != 0){
                    $jad = $jadwal->one(); 
                    $mod['jd_masuk'] = $mod['tgl'].' '.$jad['jam_masuk'];
                    $mod['jd_pulang'] = $mod['tgl'].' '.$jad['jam_pulang'];
                    $mod['updated'] = date('Y-m-d H:i:s');                        
                    $mod->save(false);
                }
            }
        
            // if($asn['kode_jadwal'] == 1){
            //     $libur = PreskinLibur::find()
            //         ->where(['between', 'tanggal', "$tahun-$bulan-01", "$tahun-$bulan-$t2"])
            //         ->orderBy(['tanggal' => SORT_ASC]);
            // }elseif($asn['kode_jadwal'] == 2 || $mas['kode_jadwal'] == 4){
            //     $libur = PreskinLibur::find()
            //         ->where(['<>', 'ket_libur', 1])
            //         ->andWhere(['between', 'tanggal', "$tahun-$bulan-01", "$tahun-$bulan-$t2"])
            //         ->orderBy(['tanggal' => SORT_ASC]);
            // }

            $libur = PreskinLibur::find()
                    ->where(['between', 'tanggal', "$tahun-$bulan-01", "$tahun-$bulan-$t2"])
                    ->orderBy(['tanggal' => SORT_ASC]);

            if($libur->count() != 0){
                foreach($libur->all() as $lbr){

                    $tgllibur = $lbr['tanggal'];
                    
                    if($lbr['ket_libur'] != 1){
                        $kd_pres = $nip.'-'.date( "Ymd", strtotime($tgllibur));
                        $presensi = PresHarian::findOne($kd_pres);

                        if($presensi !== null) $presensi->delete(false);
                    }

                }
            }              
            //} 
            Yii::$app->session->setFlash('position', [
                'icon' => \dominus77\sweetalert2\Alert::TYPE_SUCCESS, 
                'title' => 'Berhasil',
                'text' => 'Jadwal kerja berhasil diubah !!!',
                'showConfirmButton' => false,
                'timer' => 2000
            ]);
            return $this->redirect(Url::previous());
        }

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('jadwal', [
                'asn' => $asn,
                'model' => $model, 
                'tahun' => $tahun, 'bulan' => $bulan,
                'bul' => ucwords(Fungsi::NmBulan(intval($bulan))),
                'jk' => $jk,
            ]);
        }else{
            return $this->render('jadwal', [
                'asn' => $asn,
                'model' => $model, 
                'tahun' => $tahun, 'bulan' => $bulan,
                'bul' => ucwords(Fungsi::NmBulan(intval($bulan))),
                'jk' => $jk,
            ]);
        } 
    }

    public function actionUpdateJadwalShift($id, $bulan, $tahun)
    {
        $asn = $this->findAsn($id);
        
        if($asn['asnJadwalKerja'] === null) $jk = $dt['kode_jadwal'];
        else $jk = $asn['asnJadwalKerja']['jenis'];
        
        $model = [new PresHarian([
            'nip' => $asn['nip'],
            'nama' => $asn['fipNm'],
            'idpns' => $asn['asnSiasn']['id'],
            'tablokb' => $asn['fipTablokb']
        ])];

        if(Model::loadMultiple($model, Yii::$app->request->post())){
            $post = Yii::$app->request->post();
            $pres = $post['PresHarian'];

            if(count($pres) > 0){
            
                $nip = $model[0]['nip'];
                $nama = $model[0]['nama'];
                $idpns = $model[0]['idpns'];
                $tablokb = $model[0]['tablokb'];
                
                $prh = PresHarian::find()->where([
                    'nip' => $nip,
                    'EXTRACT(YEAR FROM tgl::date)' => $tahun, 
                    'EXTRACT(MONTH FROM tgl::date)' => $bulan, 
                ]);

                if($prh->count() > 0){
                    PresHarian::deleteAll(['nip' => $nip, 'EXTRACT(YEAR FROM tgl::date)' => $tahun, 'EXTRACT(MONTH FROM tgl::date)' => $bulan]);
                }

                for($row = 0; $row < count($pres); $row++){
                    foreach($pres[$row]['tgl'] as $tg){
                        $pr = new PresHarian();
                        $pr['kode'] = $nip."-".date('Ymd', strtotime("$tahun-$bulan-$tg"));
                        $pr['tgl'] = date('Y-m-d', strtotime("$tahun-$bulan-$tg"));
                        $pr['nip'] = $nip;
                        $pr['nama'] = $nama;
                        $pr['idpns'] = $idpns;
                        $pr['tablokb'] = $tablokb;
                        $pr['jd_masuk'] = date('Y-m-d H:i:s', strtotime("$tahun-$bulan-$tg ".$pres[$row]['jd_masuk']));
                        $pr['jd_pulang'] = date('Y-m-d H:i:s', strtotime("$tahun-$bulan-$tg ".$pres[$row]['jd_pulang']));

                        if(strtotime($pr['jd_pulang']) < strtotime($pr['jd_masuk']))
                            $pr['jd_pulang'] = date('Y-m-d H:i:s', strtotime('+1 day',strtotime($pr['jd_pulang']))); 

                        $pr->save(false);
                    }
                }
                //return  Json::encode($dta, $asArray = true);
                
                Yii::$app->session->setFlash('position', [
                    'icon' => \dominus77\sweetalert2\Alert::TYPE_SUCCESS, 
                    'title' => 'Berhasil',
                    'text' => 'Data berhasil disimpan !!!',
                    'showConfirmButton' => false,
                    'timer' => 2000
                ]);
                
            }else{
                Yii::$app->session->setFlash('position', [
                    'icon' => \dominus77\sweetalert2\Alert::TYPE_ERROR, 
                    'title' => 'Gagal',
                    'text' => 'Tidak ada data disimpan !!!',
                    'showConfirmButton' => false,
                    'timer' => 2000
                ]);
            }
            return $this->redirect(Url::previous());
        }

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('jadwal-shift', [
                'asn' => $asn,
                'model' => $model, 
                'tahun' => $tahun, 'bulan' => $bulan,
                'bul' => ucwords(Fungsi::NmBulan(intval($bulan))),
                'jk' => $jk,
            ]);
        }else{
            return $this->render('jadwal-shift', [
                'asn' => $asn,
                'model' => $model, 
                'tahun' => $tahun, 'bulan' => $bulan,
                'bul' => ucwords(Fungsi::NmBulan(intval($bulan))),
                'jk' => $jk,
            ]);
        } 
    }
    
    protected function findAsn($id)
    {
        if (($model = PreskinAsn::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUpdatePresensi($id, $bulan, $tahun)
    {
        $presensi = PresHarian::find()
        ->where([
            'EXTRACT(month FROM DATE(tgl))' => $bulan, 
            'EXTRACT(year FROM DATE (tgl))' => $tahun,
            'nip' => $id,    
        ])
        ->andWhere(['<','flag', 3])
        ->orderBy(['flag' => SORT_ASC]);

        if($presensi->count() != 0){
            foreach($presensi->all() as $pre){
                $id = $pre['idpns'];
                $nip = $pre['nip'];
                $kode = $pre['kode'];
                $tgl = $pre['tgl'];
                $jd_masuk = $pre['jd_masuk'];
                $jd_pulang = $pre['jd_pulang'];

                $cekFake = FpPresensiCheckinoutHp::find()
                    ->where([
                        'nip' => $nip,                    ])
                    ->andWhere(['between', 'checktime', "$tgl 00:00:00", "$tgl 23:59:59"])
                    ->andWhere(['ilike', 'light', 'fake'])
                ;  
                if($cekFake->count() == 0){

                    $tjd_masuk = strtotime($jd_masuk);
                    $tjd_pulang = strtotime($jd_pulang);

                    $separo = floor(($tjd_pulang - $tjd_masuk)/120);
                    
                    $w_mas = date('Y-m-d H:i:s', strtotime('-1 hours', $tjd_masuk));
                    $w_pul = date('Y-m-d H:i:s', strtotime('+2 hours', $tjd_pulang));
                    
                    $masuk = FpPresensiCheckinoutHp::find()
                        ->select(['checktime', 'nip'])
                        ->where(['nip' => $nip])
                        ->andWhere(['between', 'checktime', $w_mas, $w_pul])
                        ->orderBy(['checktime' => SORT_ASC])
                        ->one();
                    ;  
                    
                    $pulang = FpPresensiCheckinoutHp::find()
                        ->select(['checktime', 'nip'])
                        ->where(['nip' => $nip])
                        ->andWhere(['between', 'checktime', $w_mas, $w_pul])
                        ->orderBy(['checktime' => SORT_DESC])
                        ->one();
                    ;   
    

                    if($masuk !== null){

                        $pr_masuk = $masuk['checktime'];
                        $pr_pulang = $pulang['checktime'];                   

                        $pre['pr_masuk'] = $pr_masuk;
                        $pre['pr_pulang'] = $pr_pulang;

                        $tpr_masuk = strtotime($pr_masuk);
                        $tpr_pulang = strtotime($pr_pulang);

                        $mnt_masuk = $tpr_masuk - $tjd_masuk;
                        $mm = floor($mnt_masuk/60);

                        if($mm >= 1){

                            $kd_pr_masuk = PreskinPresJenis::find()
                                ->where(['>=', 'selisih_waktu', $mm])
                                ->andWhere(['like', 'kd_presensi', 'TL'])
                                ->orderBy(['selisih_waktu' => SORT_ASC]);

                            //echo $kd_pr_masuk->createCommand()->getRawSql()."\n";                            
                            
                            if($kd_pr_masuk->count() == 0){
                                $kd_pr_masuk = PreskinPresJenis::find()
                                ->where(['like', 'kd_presensi', 'TL'])
                                ->orderBy(['selisih_waktu' => SORT_DESC])
                                ->one();
                            }else $kd_pr_masuk = $kd_pr_masuk->one();
                                
                            $pre['mnt_masuk'] = $mnt_masuk;
                            $pre['kd_pr_masuk'] = $kd_pr_masuk['kd_presensi'];
                            $pre['pot_masuk'] = $kd_pr_masuk['persen_pot'];

                            if($mnt_masuk >= $separo) $pre['mnt_masuk'] = $separo;

                        }else{

                            $pre['mnt_masuk'] = 0;
                            $pre['kd_pr_masuk'] = 'H';
                            $pre['pot_masuk'] = 0;
                        }

                        $mnt_pulang = $tjd_pulang - $tpr_pulang;
                        $mp = floor($mnt_pulang/60);

                        if($mp >= 1){                        

                            $kd_pr_pulang = PreskinPresJenis::find()
                                ->where(['>=', 'selisih_waktu', $mp])
                                ->andWhere(['like', 'kd_presensi', 'PSW'])
                                ->orderBy(['selisih_waktu' => SORT_ASC]);

                            if($kd_pr_pulang->count() == 0){
                                $kd_pr_pulang = PreskinPresJenis::find()
                                ->where(['like', 'kd_presensi', 'PSW'])
                                ->orderBy(['selisih_waktu' => SORT_DESC])
                                ->one();
                            }else $kd_pr_pulang = $kd_pr_pulang->one();                            

                            $pre['mnt_pulang'] = $mnt_pulang;
                            $pre['kd_pr_pulang'] = $kd_pr_pulang['kd_presensi'];
                            $pre['pot_pulang'] = $kd_pr_pulang['persen_pot'];

                            if($mnt_pulang >= $separo) $pre['mnt_pulang'] = $separo;

                        }else{

                            $pre['mnt_pulang'] = 0;
                            $pre['kd_pr_pulang'] = 'H';
                            $pre['pot_pulang'] = 0;
                        }

                    }else{
                        $pre['mnt_masuk'] = $pre['mnt_pulang'] = $separo;
                        $pre['kd_pr_masuk'] = 'TMK'; 
                        $pre['kd_pr_pulang'] = 'TMK'; 
                        $pre['pot_masuk'] = 2.5;
                        $pre['pot_pulang'] = 2.5;
                    }

                    $pre['flag'] = 3;  
                    if($pre['mnt_masuk'] > 0 || $pre['mnt_pulang'] > 0) $pre['flag'] = 1;
                    $pre['updated'] = date('Y-m-d H:i:s');
                    $pre->save(false);    

                    $ket = PresKet::find()->where(['like', 'nip', $nip.';'])
                        ->andWhere(['and', ['<=', 'tgl_awal', $tgl],['>=', 'tgl_akhir', $tgl]])
                        ->orderBy(['jenis_ket' => SORT_DESC]);

                    if($ket->count() != 0){                    
                        $pre['mnt_masuk'] = 0;
                        $pre['mnt_pulang'] = 0;
                        $pre['kd_pr_masuk'] = $ket->one()['jenisSuket']['kode'];
                        $pre['kd_pr_pulang'] = $ket->one()['jenisSuket']['kode']; 
                        $pre['pot_masuk'] = 0;
                        $pre['pot_pulang'] = 0;
                        $pre['flag'] = 3; 
                        $pre['updated'] = date('Y-m-d H:i:s');
                        $pre->save(false);  
                    }
                }   
            }

            Yii::$app->session->setFlash('position', [
                'icon' => \dominus77\sweetalert2\Alert::TYPE_SUCCESS, 
                'title' => 'Berhasil',
                'text' => 'Presensi kehadiran berhasil dihitung !!!',
                'showConfirmButton' => false,
                'timer' => 2000
            ]);
            return $this->redirect(Url::previous());  
        }else{
            Yii::$app->session->setFlash('position', [
                'icon' => \dominus77\sweetalert2\Alert::TYPE_ERROR, 
                'title' => 'Gagal',
                'text' => 'Data tidak ditemukan atau jadwal belum dibuat !!!',
                'showConfirmButton' => false,
                'timer' => 2000
            ]);
            return $this->redirect(Url::previous());  
        } 
    }
    
    public function actionDataPresensi($id, $bulan, $tahun)
    {
        $asn = $this->findAsn($id);
        
        if($asn['asnJadwalKerja'] === null) $jk = $dt['kode_jadwal'];
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
            'pagination' => [
                'pageSize' => 70,
            ],
        ]);

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('view-data', [
                'data' => $data,
                'dataProvider' => $dataProvider, 
            ]);
        }else{
            return $this->render('view-data', [
                'data' => $data,
                'dataProvider' => $dataProvider, 
            ]);
        } 

    }

    public function actionDetailPresensi($id, $bulan, $tahun)
    {
        $asn = $this->findAsn($id);
        
        if($asn['asnJadwalKerja'] === null) $jk = $dt['kode_jadwal'];
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

        $model = PresHarian::find()
        ->where([
            'EXTRACT(month FROM DATE(tgl))' => $bulan, 
            'EXTRACT(year FROM DATE (tgl))' => $tahun,
            'nip' => $id,
        ])
        ->orderBy(['tgl' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 40,
            ],
        ]);
        //return Json::encode($model->all(), $asArray = true);

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('view-detail', [
                'data' => $data,
                'dataProvider' => $dataProvider, 
            ]);
        }else{
            return $this->render('view-detail', [
                'data' => $data,
                'dataProvider' => $dataProvider, 
            ]);
        } 
    }
}

<?php

namespace app\modules\sitampan\controllers;

use Yii;
use app\modules\sitampan\models\KinHarian;
use app\modules\sitampan\models\KinHarianSearch;
use app\modules\sitampan\models\KinAtasan;
use app\modules\sitampan\models\KinAtasanSearch;
use app\modules\sitampan\models\KinJenisOutput;
use app\modules\sitampan\models\PreskinParam;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\data\ActiveDataProvider;

//use app\models\EpsMastfip;
use app\modules\simpeg\models\EpsMastfip;

/**
 * KinHarianController implements the CRUD actions for KinHarian model.
 */
class KinHarianController extends Controller
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
                            if(Yii::$app->session['module'] != 2)  return $this->redirect(['/']);
                            else return (Yii::$app->session['module'] == 2);
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
     * Lists all KinHarian models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->redirect(['/site/index']);
    }

    public function actionTarget()
    {
        $sess = Yii::$app->session;
        $searchModel = new KinHarianSearch(['nip' => $sess['nip']]);
        $searchModel['tanggal'] = date('d');
        $searchModel['bulan'] = date('n');
        $searchModel['tahun'] = date('Y');

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['tgl' => SORT_ASC, 'id' => SORT_ASC]);

        $atasan = KinAtasan::findOne($sess['nip']);
        if($atasan === null){
            $sess['nip_atasan'] = '';
            $sess['nama_atasan'] = '';
            $sess['tablok_atasan'] = '';
            $sess['tablokb_atasan'] = '';
        }else{
            $sess['nip_atasan'] = $atasan['nip_atasan'];
            $sess['nama_atasan'] = $atasan['nama_atasan'];
            $sess['tablok_atasan'] = $atasan['tablok_atasan'];
            $sess['tablokb_atasan'] = $atasan['tablokb_atasan'];
        }

        
        $thn = $searchModel['tahun'];
        $bln = $searchModel['bulan'];
        $tgl = $searchModel['tanggal'];
        
        //$batas = PreskinParam::findOne(1)['batas_pres'];        
        $now = date('Y-m-01 00:00:00');
        $mid = date('Y-m-16 00:00:00');
        $last = date('Y-m-d H:i:s',strtotime('-1 day',strtotime($now)));
        $next = date('Y-m-d H:i:s',strtotime('+1 month',strtotime($now)));
        $tglx = "$thn-$bln-$tgl 23:59:59";

        if(strtotime($tglx) < strtotime($now) || strtotime($tglx) >= strtotime($next)) $view = 'target-last';
        elseif(time() >= strtotime($mid)){
            if(strtotime($tglx) < strtotime($mid)) $view = 'target-last';
            else $view = 'target';
        }else $view = 'target';

        Url::remember();
        return $this->render($view, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRealisasi()
    {
        $sess = Yii::$app->session;
        $searchModel = new KinHarianSearch(['nip' => $sess['nip']]);
        $searchModel['tanggal'] = date('d');
        $searchModel['bulan'] = date('n');
        $searchModel['tahun'] = date('Y');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['tgl' => SORT_ASC, 'id' => SORT_ASC]);

        $atasan = KinAtasan::findOne($sess['nip']);
        if($atasan === null){
            $sess['nip_atasan'] = '';
            $sess['nama_atasan'] = '';
            $sess['tablok_atasan'] = '';
            $sess['tablokb_atasan'] = '';
        }else{
            $sess['nip_atasan'] = $atasan['nip_atasan'];
            $sess['nama_atasan'] = $atasan['nama_atasan'];
            $sess['tablok_atasan'] = $atasan['tablok_atasan'];
            $sess['tablokb_atasan'] = $atasan['tablokb_atasan'];
        }
        
        $batas = PreskinParam::findOne(1)['batas_pres'];
        $bln = $searchModel['bulan'];
        $thn = $searchModel['tahun'];

        $tgl = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
        $nbln = $bln + 1;

        if(time() < strtotime(date("$thn-$nbln-$batas 23:59:59"))) 
            $view = 'realisasi';
        else $view = 'realisasi-last';

        // $now = date('Y-m-01 00:00:00');
        // $mid = date('Y-m-15 00:00:00');
        // $last = date('Y-m-d H:i:s',strtotime('-1 day',strtotime($now)));
        // $next = date('Y-m-d H:i:s',strtotime('+1 month',strtotime($now)));
        // $tglx = "$thn-$bln-$tgl 23:59:59";

        // if(strtotime($tglx) < strtotime($now) || strtotime($tglx) >= strtotime($next)) $view = 'realisasi-last';
        // elseif(time() >= strtotime($mid)){
        //     if(strtotime($tglx) < strtotime($mid)) $view = 'realisasi-last';
        //     else $view = 'realisasi';
        // }else $view = 'realisasi';

        Url::remember();
        return $this->render($view, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KinHarian model.
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

    public function actionAtasan()
    {
        $sess = Yii::$app->session;
        $model = KinAtasan::findOne(Yii::$app->session['nip']);
        if($model === null){
            $model = new KinAtasan([
                'nip' => $sess['nip'],
                'nama' => $sess['namapengguna'],
                'tablok' => $sess['tablok'],
                'tablokb' => $sess['tablokb'],
            ]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            $cek = KinHarian::find()->where(['nip' => $sess['nip'], 'flag' => 0]);
            if($cek->count() != 0){
                foreach($cek->all() as $kin){
                    $kin['penilai_nip'] = $model['nip_atasan'];
                    $kin['penilai_nama'] = $model['nama_atasan'];
                    $kin['penilai_tablok'] = $model['tablok_atasan'];
                    $kin['penilai_tablokb'] = $model['tablokb_atasan'];
                    $kin->save();
                }
            }
            Yii::$app->session->setFlash('position', [
                'icon' => \dominus77\sweetalert2\Alert::TYPE_SUCCESS, //SUCCESS, INFO, ERROR, WARNING, QUESTION
                'title' => 'Berhasil',
                'text' => 'Data berhasil disimpan',
                'showConfirmButton' => false,
                'timer' => 2000
            ]); 
            return $this->redirect(['/target-kinerja']);
        }

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('atasan', [
                'model' => $model,
            ]);
        }else{
            return $this->render('atasan', [
                'model' => $model, 
            ]);
        } 
    }

    public function actionGetAtasan($zipId){
        $fip = EpsMastfip::find()->where(['B_02' => $zipId])->one();  
        if($fip === null) $data = '';
        else{  
            $data = [
                "nipAtasan" => $fip['B_02'],
                "namaAtasan" => $fip['B_03'],
                "tablokAtasan" => $fip['A_01'].'000000',    
                "tablokbAtasan" => $fip['A_01'].$fip['A_02'].$fip['A_03'].$fip['A_04'],  
            ];
            return Json::encode($data);
        }
 
    }

    /**
     * Creates a new KinHarian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tgl)
    {
        $sess = Yii::$app->session;
        $model = new KinHarian([
            'id' => $sess['nip'].'-'.time(),
            'tgl' => $tgl, 
            'id_pns' => $sess['pengguna'],
            'nip' => $sess['nip'],
            'tablok' => $sess['tablok'],
            'tablokb' => $sess['tablokb'],
            'nama' => $sess['namapengguna'],
            'penilai_nip' => $sess['nip_atasan'],
            'penilai_tablok' => $sess['tablok_atasan'],
            'penilai_tablokb' => $sess['tablokb_atasan'],
            'penilai_nama' => $sess['nama_atasan'],
        ]);

        $output = KinJenisOutput::find()
        ->orderBy(['jenis_output'=>SORT_ASC])
        ->all(); 

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('position', [
                'icon' => \dominus77\sweetalert2\Alert::TYPE_SUCCESS, //SUCCESS, INFO, ERROR, WARNING, QUESTION
                'title' => 'Berhasil',
                'text' => 'Data berhasil disimpan',
                'showConfirmButton' => false,
                'timer' => 2000
            ]); 
            return $this->redirect(Url::previous());
        }

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model, 'output' => $output,
            ]);
        }else{
            return $this->render('create', [
                'model' => $model, 'output' => $output,
            ]);
        } 
    }

    /**
     * Updates an existing KinHarian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $output = KinJenisOutput::find()
        ->orderBy(['jenis_output'=>SORT_ASC])
        ->all(); 

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('position', [
                'icon' => \dominus77\sweetalert2\Alert::TYPE_SUCCESS, //SUCCESS, INFO, ERROR, WARNING, QUESTION
                'title' => 'Berhasil',
                'text' => 'Data berhasil disimpan',
                'showConfirmButton' => false,
                'timer' => 2000
            ]); 
            return $this->redirect(Url::previous());
        }

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('update', [
                'model' => $model, 'output' => $output,
            ]);
        }else{
            return $this->render('update', [
                'model' => $model, 'output' => $output,
            ]);
        } 
    }

    public function actionUpdateRel($id)
    {
        $model = $this->findModel($id);
        $output = KinJenisOutput::find()
        ->orderBy(['jenis_output'=>SORT_ASC])
        ->all(); 

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('position', [
                'icon' => \dominus77\sweetalert2\Alert::TYPE_SUCCESS, //SUCCESS, INFO, ERROR, WARNING, QUESTION
                'title' => 'Berhasil',
                'text' => 'Data berhasil disimpan',
                'showConfirmButton' => false,
                'timer' => 2000
            ]); 
            return $this->redirect(Url::previous());
        }

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('update-rel', [
                'model' => $model, 'output' => $output,
            ]);
        }else{
            return $this->render('update-rel', [
                'model' => $model, 'output' => $output,
            ]);
        } 
    }

    /**
     * Deletes an existing KinHarian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        Yii::$app->session->setFlash('position', [
            'icon' => \dominus77\sweetalert2\Alert::TYPE_SUCCESS, //SUCCESS, INFO, ERROR, WARNING, QUESTION
            'title' => 'Berhasil',
            'text' => 'Data berhasil dihapus',
            'showConfirmButton' => false,
            'timer' => 2000
        ]); 
        return $this->redirect(Url::previous());
    }

    public function actionHapusRel($id)
    {
        $model = $this->findModel($id);
        $model['real_kuan_h'] = 0;
        $model['real_output_h'] = '';
        $model['real_waktu_h'] = 0;
        if($model->save()){
            Yii::$app->session->setFlash('position', [
                'icon' => \dominus77\sweetalert2\Alert::TYPE_SUCCESS, //SUCCESS, INFO, ERROR, WARNING, QUESTION
                'title' => 'Berhasil',
                'text' => 'Data Realisasi berhasil dihapus',
                'showConfirmButton' => false,
                'timer' => 2000
            ]); 
        }
        return $this->redirect(Url::previous());
    }

    /**
     * Finds the KinHarian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return KinHarian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KinHarian::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPenilaian()
    {
        $sess = Yii::$app->session;
        $searchModel = new KinAtasanSearch(['nip_atasan' => $sess['nip']]);
        $dataProvider = $searchModel->search($this->request->queryParams);

        Url::remember();
        return $this->render('penilaian', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        //nanti ditambahkan X penilaian bawahan
    }

    public function actionKinerjaBawahan($id)
    {
        $sess = Yii::$app->session;
        $searchModel = new KinHarianSearch(['nip' => $id, 'penilai_nip' => $sess['nip']]);
        //$searchModel['tanggal'] = date('d');
        $searchModel['bulan'] = date('n');
        $searchModel['tahun'] = date('Y');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['tgl' => SORT_ASC, 'id' => SORT_ASC]);
        $modl = $dataProvider->query->one();

        if($modl === null){
            $mod = EpsMastfip::find()->select(['B_02', 'B_03'])->where(['B_02' => $id])->one();
            $modl['nama'] = $mod['B_03'];
        }
        
        $batas = PreskinParam::findOne(1)['batas_pres'];
        $bln = $searchModel['bulan'];
        $thn = $searchModel['tahun'];

        $tgl = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
        $nbln = $bln + 1;

        if(time() < strtotime(date("$thn-$nbln-$batas 23:59:59"))) 
            $view = 'bawahan';
        else $view = 'bawahan-last';

        Url::remember();
        return $this->render($view, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modl' => $modl,
        ]);
    }

    public function actionUpdateNil($id)
    {
        $model = $this->findModel($id);
        $output = KinJenisOutput::find()
        ->orderBy(['jenis_output'=>SORT_ASC])
        ->all(); 

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->post('submit') == 'tolak'){
                $model['tgl_ok'] = null;
                $model['ok_kuan_h'] = 0;
                $model['ok_output_h'] = '';
                $model['ok_waktu_h'] = 0;
                $model['penilaian'] = '<font color="red"><b>'.$model['penilaian'].'</b></font>';
            }else{
                if ($model['penilaian'] != '') $model['penilaian'] = '<font color="green"><b>'.$model['penilaian'].'</b></font>';
                $model['flag'] = 1;
            }
            $model->save();
            Yii::$app->session->setFlash('position', [
                'icon' => \dominus77\sweetalert2\Alert::TYPE_SUCCESS, //SUCCESS, INFO, ERROR, WARNING, QUESTION
                'title' => 'Berhasil',
                'text' => 'Data berhasil disimpan',
                'showConfirmButton' => false,
                'timer' => 2000
            ]); 
            return $this->redirect(Url::previous());
        }

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('update-nil', [
                'model' => $model, 'output' => $output,
            ]);
        }else{
            return $this->render('update-nil', [
                'model' => $model, 'output' => $output,
            ]);
        } 
    }

    public function actionHapusNil($id)
    {
        $model = $this->findModel($id);
        $model['ok_kuan_h'] = 0;
        $model['ok_output_h'] = '';
        $model['ok_waktu_h'] = 0;
        if($model->save()){
            Yii::$app->session->setFlash('position', [
                'icon' => \dominus77\sweetalert2\Alert::TYPE_SUCCESS, //SUCCESS, INFO, ERROR, WARNING, QUESTION
                'title' => 'Berhasil',
                'text' => 'Penilaian berhasil dihapus',
                'showConfirmButton' => false,
                'timer' => 2000
            ]); 
        }
        return $this->redirect(Url::previous());
    }
}

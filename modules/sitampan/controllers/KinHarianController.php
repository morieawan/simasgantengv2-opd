<?php

namespace app\modules\sitampan\controllers;

use Yii;
use app\modules\sitampan\models\PreskinAsn;
use app\modules\sitampan\models\PreskinAsnSearch;
use app\modules\sitampan\models\KinHarian;
use app\modules\sitampan\models\KinHarianSearch;
use app\modules\sitampan\models\KinAtasan;
use app\modules\sitampan\models\KinAtasanSearch;
use app\modules\sitampan\models\KinJenisOutput;
use app\modules\sitampan\models\PreskinParam;
use app\modules\simpeg\models\EpsTablokb;
use app\models\Fungsi;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\data\ArrayDataProvider;
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
     * Lists all KinHarian models.
     * @return mixed
     */

    public function actionSearch()
    {
        $sess = Yii::$app->session;

        $opd = EpsTablokb::find()
        ->select(['KOLOK', 'UNIT', "NALOK", "CONCAT(\"KOLOK\",' ',\"NALOK\") AS UNOR"])
        ->asArray()
        ->andWhere(['GROUP_USER' => $sess['group_user']])
        ->all();

        $searchModel = new PreskinAsnSearch();

        return $this->render('_search-pres-asn', [
            'model' => $searchModel,
            'opd' => $opd,
            'bln' => date('m'),
            'thn' => date('Y'),
        ]);
    }

    public function actionIndex()
    {
        $sess = Yii::$app->session;
        Url::remember();

        $nama_pd = EpsTablokb::find()
            ->select(['NALOK'])
            ->where(['KOLOK' => $sess['group_user']])
            ->one()['NALOK'];

        // =========================
        // OPD
        // =========================
        $opd = EpsTablokb::find()
            ->select([
                'KOLOK',
                'GROUP_USER',
                'NALOK',
                new \yii\db\Expression('CONCAT("KOLOK", \' \', "NALOK") AS UNOR')
            ])
            ->where(['GROUP_USER' => $sess['group_user']])
            ->asArray()
            ->all();

        $so = array_column($opd, 'KOLOK');

        // =========================
        // SEARCH MODEL
        // =========================
        $searchModel = new PreskinAsnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->andWhere([
            'OR',
            ['<', 'status', 13],
            ['>', 'tmt_stop', date('Y-m-01')],
            ['tmt_stop' => null]
        ]);

        $dataProvider->query->andFilterWhere([
            'OR',
            ['CONCAT("a"."A_01",a."A_02",a."A_03",a."A_04")' => $so]
        ]);

        $dataProvider->query->orderBy([
            'status' => SORT_ASC,
            'a.E_04' => SORT_DESC,
            'a.A_01' => SORT_ASC,
            'a.A_03' => SORT_ASC,
            'a.G_06' => SORT_ASC,
        ]);

        // =========================
        // PERIODE
        // =========================
        $bln = date('n');
        $thn = $nthn = date('Y');

        $req = Yii::$app->request;
        if ($req->get('periode')) {
            $per = explode('-', $req->get('periode'));
            $bln = $per[0];
            $thn = $per[1];
        }

        $dataProvider->query->andWhere([
            'OR',
            ['<', 'status', 13],
            ['>', 'tmt_stop', "$thn-$bln-01"],
            ['tmt_stop' => null]
        ]);

        $nbln = $bln + 1;
        if ($nbln == 13) {
            $nbln = 1;
            $nthn = $thn + 1;
        }

        // =========================
        // DATA ASN
        // =========================
        $data = $dataProvider->query->asArray()->all();
        if (empty($data)) {
            return $this->render('index-data', [
                'searchModel' => $searchModel,
                'dataProvider' => new ArrayDataProvider(['allModels' => []]),
                'opd' => $opd,
                'thn' => $thn,
                'bln' => $bln,
                'bul' => strtoupper(Fungsi::NmBulan(intval($bln))),
                'namapd' => $nama_pd,
            ]);
        }

        $nips = array_column($data, 'nip');

        // =========================
        // B: NAMA + TABLOK
        // =========================
        $b = EpsMastfip::find()
            ->select([
                '"B_02" AS nip',
                '"B_03" AS nama',
                new \yii\db\Expression('CONCAT("A_01","A_02","A_03","A_04") AS tablok')
            ])
            ->where(['B_02' => $nips])
            ->asArray()
            ->all();

        $bMap = [];
        $tablokList = [];
        foreach ($b as $row) {
            $bMap[$row['nip']] = $row;
            $tablokList[] = $row['tablok'];
        }

        // =========================
        // C: UNIT (NALOK)
        // =========================
        $c = EpsTablokb::find()
            ->select(['KOLOK AS tablok', 'NALOK'])
            ->where(['KOLOK' => $tablokList])
            ->asArray()
            ->all();

        $cMap = [];
        foreach ($c as $row) {
            $cMap[$row['tablok']] = $row['NALOK'];
        }

        // =========================
        // KINERJA (BULK)
        // =========================
        $presensiAll = KinHarian::find()
            ->select([
                'nip',
                'SUM("target_waktu_h") AS target',
                'SUM("real_waktu_h") AS realisasi',
                'SUM("ok_waktu_h") AS hasil'
            ])
            ->where(['nip' => $nips])
            ->andWhere([
                'EXTRACT(month FROM tgl::date)' => $bln,
                'EXTRACT(year FROM tgl::date)' => $thn,
            ])
            ->andWhere(['OR',
                ['<', 'tgl_ok', "$nthn-$nbln-03 23:59:59"],
                ['tgl_ok' => null]
            ])
            ->groupBy(['nip'])
            ->asArray()
            ->all();

        $presensiMap = [];
        foreach ($presensiAll as $p) {
            $presensiMap[$p['nip']] = $p;
        }

        // =========================
        // ATASAN
        // =========================
        $atasanAll = KinHarian::find()
            ->select(['nip', 'penilai_nip', 'penilai_nama', 'tgl'])
            ->where(['nip' => $nips])
            ->andWhere([
                'EXTRACT(month FROM tgl::date)' => $bln,
                'EXTRACT(year FROM tgl::date)' => $thn,
            ])
            ->orderBy(['tgl' => SORT_DESC])
            ->asArray()
            ->all();

        $atasanMap = [];
        foreach ($atasanAll as $a) {
            if (!isset($atasanMap[$a['nip']])) {
                $atasanMap[$a['nip']] = $a;
            }
        }

        // =========================
        // FINAL LOOP
        // =========================
        $dt = [];

        foreach ($data as $dat) {

            $nip = $dat['nip'];

            $bRow = $bMap[$nip] ?? [];
            $tablok = $bRow['tablok'] ?? '';

            $dt[] = [
                'nip' => $nip,
                'nama' => $bRow['nama'] ?? '',
                'unor' => $cMap[$tablok] ?? '',
                'thn' => $thn,
                'bln' => $bln,

                'target' => $presensiMap[$nip]['target'] ?? 0,
                'realisasi' => $presensiMap[$nip]['realisasi'] ?? 0,
                'hasil' => $presensiMap[$nip]['hasil'] ?? 0,

                'nip_atasan' => $atasanMap[$nip]['penilai_nip'] ?? '',
                'nama_atasan' => $atasanMap[$nip]['penilai_nama'] ?? '',
            ];
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $dt,
            'pagination' => ['pageSize' => 20],
        ]);

        return $this->render('index-data', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'opd' => $opd,
            'thn' => $thn,
            'bln' => $bln,
            'bul' => strtoupper(Fungsi::NmBulan(intval($bln))),
            'namapd' => $nama_pd,
        ]);
    }

    public function actionDetail($id, $bulan, $tahun)
    {        
        $searchModel = new KinHarianSearch([
            'nip' =>  $id,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);  
        $dataProvider->query->orderBy(['tgl' => SORT_ASC]);      

        $nbln = $bulan+1;

        $sum_target = 0;
        $sum_real = 0;
        $sum_ok = 0;
        foreach ($dataProvider->getModels() as  $value) {
            $sum_target += $value['target_waktu_h'];
            $sum_real += $value['real_waktu_h'];
            $sum_ok += $value['ok_waktu_h'];
        }

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('index-detail', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'sum_target' => $sum_target,
                'sum_real' => $sum_real,
                'sum_ok' => $sum_ok,
                //'thn' => $thn, 'bln' => $bln,
                //'bul' => strtoupper(Fungsi::NmBulan(intval($bln))),
                //'namapd' => '',
            ]);
        }else{
            return $this->render('index-detail', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'sum_target' => $sum_target,
                'sum_real' => $sum_real,
                'sum_ok' => $sum_ok,
            ]);
        }
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

        Url::remember();
        return $this->render('bawahan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modl' => $modl,
        ]);
    }
}

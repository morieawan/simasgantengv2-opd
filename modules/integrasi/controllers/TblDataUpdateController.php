<?php

namespace app\modules\integrasi\controllers;

use Yii;
use app\modules\integrasi\models\TblDataUpdate;
use app\modules\integrasi\models\TblDataUpdateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\helpers\Json;

use app\modules\integrasi\models\SiasnDataUtama;
use app\modules\integrasi\models\SiasnIntegrasiConfig;
use app\modules\integrasi\models\TblHist;

use app\modules\gaji\models\SimasGajiMstpegawai;
use app\modules\simpeg\models\EpsMastfip;

/**
 * TblDataUpdateController implements the CRUD actions for TblDataUpdate model.
 */
class TblDataUpdateController extends Controller
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
     * Lists all TblDataUpdate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblDataUpdateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy([
            'flag' => SORT_ASC,
            'dataUtama' => SORT_DESC,
        ]);

        Url::remember('index');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblDataUpdate model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $model, 
            ]);
        }else{
            return $this->render('view', [
                'model' => $model, 
            ]);
        } 
    }

    /**
     * Creates a new TblDataUpdate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblDataUpdate();

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
     * Updates an existing TblDataUpdate model.
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
     * Deletes an existing TblDataUpdate model.
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
     * Finds the TblDataUpdate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TblDataUpdate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblDataUpdate::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelByNip($id)
    {
        if (($model = TblDataUpdate::find()->where(['nipBaru' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSyncDataUtama($nip)
    {
        $model = $this->findModelByNip($nip);

        $siasn = ['code' => 0, 'data'=> '', 'message' => null];

        $siasn = SiasnIntegrasiConfig::getDataSiasn($nip, 'prod', '/pns/data-utama/');

        if($siasn['code'] != 1){
            $siasn['data'] = '';
            $model['flag'] = 99;
            $model->save(false);
            
            Yii::$app->session->setFlash('position', [
                'icon' => \dominus77\sweetalert2\Alert::TYPE_ERROR, //SUCCESS, INFO, ERROR, WARNING, QUESTION
                'title' => 'Data tidak ditemukan',
                'showConfirmButton' => false,
                'timer' => 2000
            ]); 
        }else{
            $data = $siasn['data'];
            $data['updated']  = date('Y-m-d H:i:s');  

            $sapkpns = SiasnDataUtama::findOne($data['id']);
            if($sapkpns === null) $sapkpns = new SiasnDataUtama();

            foreach($data as $attr => $value){
                if($data["$attr"] == 'null') $data["$attr"] = NULL;
                    $sapkpns["$attr"] = $data["$attr"];
            }

            $log = new TblHist();
            $log['id'] = $sapkpns['id'];
            $log['oleh'] = Yii::$app->session['username'];
            $log['data'] = 'data-utama';
            $log['aksi'] = 'all';

            $model['id'] = $sapkpns['id'];
            $model['dataUtama'] = date('Y-m-d H:i:s');
            if($sapkpns['kedudukanPnsId'] == '99') {
                $model['flag'] = 99;
                $sapkpns['flag'] = 99;
            }
            
            if($sapkpns->save(false) && $log->save(false) && $model->save(false)){
                
                Yii::$app->session->setFlash('position', [
                    'icon' => \dominus77\sweetalert2\Alert::TYPE_SUCCESS, //SUCCESS, INFO, ERROR, WARNING, QUESTION
                    'title' => 'Berhasil !!!',
                    'text' => 'Data berhasil disimpan',
                    'showConfirmButton' => false,
                    'timer' => 2000
                ]); 
            }else{
                $model['flag'] = 99;
                $model->save(false);
                Yii::$app->session->setFlash('position', [
                    'icon' => \dominus77\sweetalert2\Alert::TYPE_ERROR, //SUCCESS, INFO, ERROR, WARNING, QUESTION
                    'title' => 'Gagal !!!',
                    'text' => 'Data gagal disimpan',
                    'showConfirmButton' => false,
                    'timer' => 2000
                ]); 
            }

        }

        return $this->redirect(['index']);
    }

    public function actionSimpeg()
    {
        $mdl = EpsMastfip::find()->select(['B_02', 'B_08'])->where(['<', 'B_08', 3]);

        foreach($mdl->all() as $dt){
            $nip = $dt['B_02'];
            $up = TblDataUpdate::find()->where(['nipBaru' => $nip])->one();
            
            if($up === null){
                $up = new TblDataUpdate();
                $up['id'] = $nip;
            }
            
            $up['nipBaru'] = $nip;
            $up->save(false);

        }
        
        return $this->redirect(Url::previous());
    }

    public function actionSimgaji()
    {
        $mdl = SimasGajiMstpegawai::find()->select(['NIP', 'KDSTAPEG'])->where(['<', 'KDSTAPEG', 13]);

        foreach($mdl->all() as $dt){
            $nip = $dt['NIP'];
            $up = TblDataUpdate::find()->where(['nipBaru' => $nip])->one();
            
            if($up === null){
                $up = new TblDataUpdate();
                $up['id'] = $nip;
            }
            
            $up['nipBaru'] = $nip;
            $up->save(false);

        }
        return $this->redirect(Url::previous());
    }
}

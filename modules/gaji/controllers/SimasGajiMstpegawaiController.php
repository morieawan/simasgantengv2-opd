<?php

namespace app\modules\gaji\controllers;

use Yii;
use app\modules\gaji\models\SimasGajiMstpegawai;
use app\modules\gaji\models\SimasGajiMstpegawaiSearch;
use app\modules\gaji\models\DbgajidoMstpegawai;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * SimasGajiMstpegawaiController implements the CRUD actions for SimasGajiMstpegawai model.
 */
class SimasGajiMstpegawaiController extends Controller
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
     * Lists all SimasGajiMstpegawai models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SimasGajiMstpegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy([
            'KDSTAPEG' => SORT_ASC, 
            'NIP' => SORT_ASC,
            'TJESELON' => SORT_DESC, 
            'KDESELON' => SORT_ASC, 
            'KDSATKER' => SORT_ASC,
        ]);

        $jml = SimasGajiMstpegawai::find()
            ->select(['NIP', 'KDSTAPEG'])
            ->where(['<=', 'KDSTAPEG', 12])
            ->count();

        $p3k = SimasGajiMstpegawai::find()
            ->select(['NIP', 'KDSTAPEG'])
            ->where(['KDSTAPEG' => 12])
            ->count();

        $data['jml'] = $jml;
        $data['p3k'] = $p3k;
        $data['pns'] = $jml - $p3k;

        Url::remember('index');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data' => $data,
        ]);
    }

    /**
     * Displays a single SimasGajiMstpegawai model.
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
     * Creates a new SimasGajiMstpegawai model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SimasGajiMstpegawai();

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
     * Updates an existing SimasGajiMstpegawai model.
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
     * Deletes an existing SimasGajiMstpegawai model.
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
     * Finds the SimasGajiMstpegawai model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SimasGajiMstpegawai the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SimasGajiMstpegawai::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSinkron($zid)
    {
        $dbgajido = DbgajidoMstpegawai::find()->count();
        $simas = SimasGajiMstpegawai::find()->count();

        $tgl = date('Y-m-d H:i:s', $zid/1000);

        return $dbgajido.' '.$simas.' '.$tgl;
    }
}

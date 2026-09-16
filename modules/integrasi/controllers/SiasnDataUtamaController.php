<?php

namespace app\modules\integrasi\controllers;

use Yii;
use app\modules\integrasi\models\SiasnDataUtama;
use app\modules\integrasi\models\SiasnDataUtamaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * SiasnDataUtamaController implements the CRUD actions for SiasnDataUtama model.
 */
class SiasnDataUtamaController extends Controller
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
     * Lists all SiasnDataUtama models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SiasnDataUtamaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy([
            'flag' => SORT_ASC,
            'kedudukanPnsId' => SORT_ASC,
            'golRuangAkhirId' => SORT_DESC,
        ]);

        $jml = SiasnDataUtama::find()
            ->select(['nipBaru', 'flag'])
           // ->where(['<', 'flag', 99])
            ->where(['<', 'kedudukanPnsId', 99])
            ->count();

        $p3k = $this->getData('kedudukanPnsId', 71);

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
     * Displays a single SiasnDataUtama model.
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
     * Creates a new SiasnDataUtama model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SiasnDataUtama();

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
     * Updates an existing SiasnDataUtama model.
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
     * Deletes an existing SiasnDataUtama model.
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
     * Finds the SiasnDataUtama model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SiasnDataUtama the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SiasnDataUtama::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getData($fil, $val){
        $query = SiasnDataUtama::find()
        ->select(['nipBaru', 'flag', $fil])
        ->where(['<', 'flag', 99])
        ->andWhere([$fil => $val])
        ->count()
        ;

        return $query;
    }

    public function actionSinkron($zid)
    {
        $simas = SiasnDataUtama::find()->count();

        $tgl = date('Y-m-d H:i:s', $zid/1000);

        return $simas.' '.$tgl;
    }
}

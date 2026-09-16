<?php

namespace app\modules\simpeg\controllers;

use Yii;
use app\modules\simpeg\models\EpsMastfip;
use app\modules\simpeg\models\EpsMastfipSearch;
use app\modules\simpeg\models\SimpegEpsMastfip;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * EpsMastfipController implements the CRUD actions for EpsMastfip model.
 */
class EpsMastfipController extends Controller
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
                            if(Yii::$app->session['module'] != 1)  return $this->redirect(['/']);
                            else return (Yii::$app->session['module'] == 1);
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
     * Lists all EpsMastfip models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EpsMastfipSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy([
            'E_04' => SORT_DESC,
            'A_01' => SORT_ASC,
        ]);

        $jml = EpsMastfip::find()
            ->select(['B_02', 'B_08'])
            ->where(['<', 'B_08', 3])
            ->count();

        $p3k = $this->getData('B_10', 71);

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
     * Displays a single EpsMastfip model.
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
     * Creates a new EpsMastfip model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EpsMastfip();

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
     * Updates an existing EpsMastfip model.
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
     * Deletes an existing EpsMastfip model.
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
     * Finds the EpsMastfip model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return EpsMastfip the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EpsMastfip::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getData($fil, $val){
        $query = EpsMastfip::find()
        ->select(['B_02', 'B_08', $fil])
        ->where(['<', 'B_08', 3])
        ->andWhere([$fil => $val])
        ->count()
        ;

        return $query;
    }

    public function actionSinkron($zid)
    {
        $dbgajido = EpsMastfip::find()->count();
        $simas = SimpegEpsMastfip::find()->count();

        $tgl = date('Y-m-d H:i:s', $zid/1000);

        return $dbgajido.' '.$simas.' '.$tgl;
    }
}

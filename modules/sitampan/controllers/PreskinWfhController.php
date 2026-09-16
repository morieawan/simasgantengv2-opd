<?php

namespace app\modules\sitampan\controllers;


use Yii;
use app\modules\sitampan\models\PreskinWfh;
use app\modules\sitampan\models\PreskinWfhSearch;
use app\modules\simpeg\models\EpsTablokb;
use app\modules\simpeg\models\EpsMastfip;
use app\models\Fungsi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;

/**
 * PreskinWfhController implements the CRUD actions for PreskinWfh model.
 */
class PreskinWfhController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all PreskinWfh models.
     *
     * @return string
     */
    public function actionSearch()
    {
        $sess = Yii::$app->session;

        $opd = EpsTablokb::find()
        ->select(['KOLOK', 'UNIT', "NALOK", "CONCAT(\"KOLOK\",' ',\"NALOK\") AS UNOR"])
        ->asArray()
        ->andWhere(['GROUP_USER' => $sess['group_user']])
        ->all();

        // $searchModel = new PreskinWfhSearch();
        // $searchModel['periode'] = date('m').'-'.date('Y');
        $searchModel = new PreskinWfhSearch();
        $searchModel->load(Yii::$app->request->queryParams);

        $periode = $searchModel['periode'];
        if(empty($periode) == 1){
            $bln = date('m');
            $thn = date('Y');
            $searchModel['periode'] = $bln.'-'.$thn;
        }else{
            $per = explode('-', $periode);
            $bln = $per[0];
            $thn = $per[1];
        }

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('_search', [
                'model' => $searchModel,
                'opd' => $opd,
            ]);
        }else{
            return $this->render('_search', [
                'model' => $searchModel,
                'opd' => $opd,
            ]);
        }
    }

    public function actionIndex()
    {
        $sess = Yii::$app->session;

        $opd = EpsTablokb::find()
        ->select(['KOLOK', 'UNIT', "NALOK", "CONCAT(\"KOLOK\",' ',\"NALOK\") AS UNOR"])
        ->asArray()
        ->andWhere(['GROUP_USER' => $sess['group_user']])
        ->all();
        
        $searchModel = new PreskinWfhSearch();

        $periode = $searchModel['periode'];
        if(empty($periode) == 1){
            $bln = date('m');
            $thn = date('Y');
            $searchModel['periode'] = $bln.'-'.$thn;
        }else{
            $per = explode('-', $periode);
            $bln = $per[0];
            $thn = $per[1];
        }

        $dataProvider = $searchModel->search($this->request->queryParams);

        Url::remember();

        $awal = Fungsi::tglindodibalik("01-".$searchModel['periode']);
        $akhir = date('Y-m-t', (strtotime($awal)));
        $batas = date('Y-m-d', strtotime('+4 days', (strtotime($akhir))));
        $sekarang = date('Y-m-d');
        
        if($sekarang < $batas) $view = 'index';
        else $view = 'index-last';

        // return Json::encode($dataProvider, $asArray = true);
        return $this->render($view, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'opd' => $opd,
            'bln' => $bln,
            'thn' => $thn,
        ]);
    }

    public function actionCreate()
    {
        $sess = Yii::$app->session;
        $model = new PreskinWfh();
        $asn = EpsMastfip::find()
            ->select(['B_02', 'B_03', 'A_01', 'A_02', 'A_03', 'A_04', 'B_08', 
                'CONCAT("B_02",\' \',"B_03") AS nipnama'])
            ->leftJoin('eps_tablokb', 'eps_tablokb."KOLOK" = CONCAT("A_01","A_02","A_03","A_04")')
            ->where(['<', 'B_08', 3])
            ->andWhere(['eps_tablokb.GROUP_USER' => $sess['group_user']])
            ->orderBy([
                'CONCAT("A_01","A_02","A_03","A_04")' => SORT_ASC,
                'B_03' => SORT_ASC,
                ])
            ->asArray()
            ->all()
            ;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $tgl  = $model->tgl;
                $nips = $model->nip;

                $db = Yii::$app->db2;
                $transaction = $db->beginTransaction();

                try {

                    foreach ($nips as $nip) {

                        $id = $nip . '-' . strtotime($tgl);

                        // PostgreSQL safe insert (anti duplicate)
                        $db->createCommand("
                            INSERT INTO preskin_wfh (id_wfh, nip, tgl)
                            VALUES (:id_wfh, :nip, :tgl)
                            ON CONFLICT (id_wfh) DO NOTHING
                        ", [
                            ':id_wfh'  => $id,
                            ':nip' => $nip,
                            ':tgl' => $tgl,
                        ])->execute();
                    }

                    $transaction->commit();

                    Yii::$app->session->setFlash('position', [
                        'icon' => \dominus77\sweetalert2\Alert::TYPE_SUCCESS, 
                        'title' => 'Berhasil',
                        'text' => 'Data berhasil disimpan !!!',
                        'showConfirmButton' => false,
                        'timer' => 2000
                    ]);
                    return $this->redirect(Url::previous());
                    // return $this->redirect(["index", "PreskinWfhSearch['nip']" => $model->nip]);

                } catch (\Exception $e) {
                    $transaction->rollBack();

                    Yii::$app->session->setFlash('position', [
                        'icon' => \dominus77\sweetalert2\Alert::TYPE_ERROR, 
                        'title' => 'Gagal',
                        'text' => 'Data gagal disimpan : '.$e->getMessage(),
                        // 'showConfirmButton' => false,
                        // 'timer' => 2000
                    ]);
                    return $this->redirect(Url::previous());
                }
            }
                
        } else {
            $model->loadDefaultValues();
        }

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model, 'asn' => $asn,
            ]);
        }else{
            return $this->render('create', [
                'model' => $model, 'asn' => $asn,
            ]);
        }
    }

    public function actionUpdate($id_wfh)
    {
        $model = $this->findModel($id_wfh);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_wfh' => $model->id_wfh]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDeleteTgl()
    {
        $nip = Yii::$app->request->post('nip');
        $tgl = Yii::$app->request->post('tgl');

        if ($nip && $tgl) {
            $id = $nip . '-' . strtotime($tgl);

            PreskinWfh::deleteAll(['id_wfh' => $id]);
        }

        return 'ok';
    }

    protected function findModel($id_wfh)
    {
        if (($model = PreskinWfh::findOne(['id_wfh' => $id_wfh])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionHasil()
    {
        $sess = Yii::$app->session;
        return $this->render('hasil', [
            'model' => $model,
        ]);

    }

    public function actionRekap()
    {
        $sess = Yii::$app->session;
        return $this->render('rekap', [
            'model' => $model,
        ]);
    }
}

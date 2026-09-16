<?php

namespace app\modules\sitampan\controllers;

use Yii;
use app\modules\sitampan\models\PresKet;
use app\modules\sitampan\models\PresKetSearch;
use app\modules\sitampan\models\PresKetJenis;
use app\modules\sitampan\models\PreskinParam;
use app\modules\simpeg\models\EpsMastfip;
//use app\models\EpsMastfip;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\helpers\Json;

/**
 * PresKetController implements the CRUD actions for PresKet model.
 */
class PresKetController extends Controller
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
     * Lists all PresKet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $sess = Yii::$app->session;
        $searchModel = new PresKetSearch([
            'opd' => $sess['group_user'],
        ]);
        
        if($searchModel['bulan'] === null) $searchModel['bulan'] = date('n');
        if($searchModel['tahun'] === null) $searchModel['tahun'] = date('Y');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $jenis = PresKetJenis::find()->all();

        $batas = PreskinParam::findOne(1)['batas_pres'];
        $bln = $searchModel['bulan'];
        $thn = $searchModel['tahun'];

        $tgl = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
        $nbln = $bln + 1;
        $nthn = $thn;
        if($nbln == 13){
            $nbln = 1;
            $nthn = $nthn + 1;
        }

        // if(time() < strtotime(date("$nthn-$nbln-$batas 23:59:59")))
        if(time() < strtotime(date("$nthn-$nbln-04 11:59:59"))) 

            $view = 'index';
        else $view = 'index-last';

        //return date('Y-m-d H:i:s',strtotime('+3 day',strtotime("$thn-$bln-$tgl 23:59:59")));
        //return strtotime('+3 day',strtotime("$thn-$bln-$tgl 23:59:59"))." - ".strtotime(date("Y-m-$batas 23:59:59"));

        Url::remember();
        return $this->render($view, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jenis' => $jenis,
            'tahun' => $searchModel['tahun'],
            'bulan' => $searchModel['bulan'],
        ]);
    }

    /**
     * Displays a single PresKet model.
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
     * Creates a new PresKet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $sess = Yii::$app->session;
        $jenis = PresKetJenis::find()->all();
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
            ;
    
        // $asn = EpsMastfip::find()
        //     ->select(['B_02', 'B_03', 'A_01', 'A_03', 'A_04', 'B_08', 'CONCAT("B_02",\' \',"B_03") AS nipnama'])
        //     ->where(['A_01' => substr($sess['tablok'], 0, 2)])
        //     ->andWhere(['<', 'B_08', 3])
        //     ->asArray();

        // if($sess['tablok'] == 'A2000000'){
        //     $asn->orWhere(['LEFT("A_01",1)' => 'C']);
        // }   
        // if($sess['tablok'] == '10000000'){
        //     $asn->orWhere(['A_01' => '01']);
        // }   
        
        // if(substr($sess['tablok'],0,2) >= 51 && substr($sess['tablok'],0,2) <= 67 && substr($sess['tablokb'], 5, 2) == '04'){
        //     $asn->andWhere(['A_03' => '04']);
        // }

        // if(substr($sess['tablok'],0,2) >= 51 && substr($sess['tablok'],0,2) <= 67 && substr($sess['tablokb'], 5, 2) != '04'){
        //     $asn->andWhere(['<>', 'A_03', '04']);
        // }   
        
        $model = new PresKet([
            'id' => $sess['tablok'].'-'.$sess['nip'].'-'.time(),
            //'opd' => $sess['tablok'],
            'opd' => $sess['group_user'],
        ]);

        if ($model->load(Yii::$app->request->post())) {
            if($model['nip'] != ''){
                $nip = '';
                foreach ($model['nip'] as $data) {
                    $nip = $nip.$data.';';
                }
                $model['nip'] = $nip;
            }
            $model['updated'] = date('Y-m-d H:i:s');
            if($model->save()){
                Yii::$app->session->setFlash('position', [
                    'icon' => \dominus77\sweetalert2\Alert::TYPE_SUCCESS, //SUCCESS, INFO, ERROR, WARNING, QUESTION
                    'title' => 'Berhasil',
                    'text' => 'Data keterangan absen berhasil disimpan',
                    'showConfirmButton' => false,
                    'timer' => 2000
                ]); 
            }
            return $this->redirect(Url::previous());
        }

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model, 'jenis' => $jenis, 'asn' => $asn,
            ]);
        }else{
            return $this->render('create', [
                'model' => $model, 'jenis' => $jenis, 'asn' => $asn,
            ]);
        } 
    }

    /**
     * Updates an existing PresKet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $sess = Yii::$app->session;
        
        $jenis = PresKetJenis::find()->all();
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
            ;
        // $asn = EpsMastfip::find()
        //     ->select(['B_02', 'B_03', 'A_01', 'A_03', 'A_04', 'B_08', 'CONCAT("B_02",\' \',"B_03") AS nipnama'])
        //     ->where(['A_01' => substr($sess['tablok'], 0, 2)])
        //     ->andWhere(['<', 'B_08', 3])
        //     ->asArray();

        // if($sess['tablok'] == 'A2000000'){
        //     $asn->orWhere(['LEFT("A_01",1)' => 'C']);
        // }   
        // if($sess['tablok'] == '10000000'){
        //     $asn->orWhere(['A_01' => '01']);
        // }   
        
        // if(substr($sess['tablok'],0,2) >= 51 && substr($sess['tablok'],0,2) <= 67 && substr($sess['tablok'], 5, 2) == '04'){
        //     $asn->andWhere(['A_03' => '04']);
        // }

        // if(substr($sess['tablok'],0,2) >= 51 && substr($sess['tablok'],0,2) <= 67 && substr($sess['tablok'], 5, 2) != '04'){
        //     $asn->andWhere(['<>', 'A_03', '04']);
        // }

        $pegawai = explode(";",$model['nip']);
        $nip = [];
        foreach($pegawai as $peg){
            if($peg != ''){
                $nip[]= $peg;
            }
        }
        $model['nip'] = $nip;

        if ($model->load(Yii::$app->request->post())) {
            if($model['nip'] != ''){
                $nip = '';
                foreach ($model['nip'] as $data) {
                    $nip = $nip.$data.';';
                }
                $model['nip'] = $nip;
            }
            $model['updated'] = date('Y-m-d H:i:s');
            if($model->save()){
                Yii::$app->session->setFlash('position', [
                    'icon' => \dominus77\sweetalert2\Alert::TYPE_SUCCESS, //SUCCESS, INFO, ERROR, WARNING, QUESTION
                    'title' => 'Berhasil',
                    'text' => 'Data keterangan absen berhasil diubah',
                    'showConfirmButton' => false,
                    'timer' => 2000
                ]); 
            }
            return $this->redirect(Url::previous());
        }

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('update', [
                'model' => $model, 'jenis' => $jenis, 'asn' => $asn,
            ]);
        }else{
            return $this->render('update', [
                'model' => $model, 'jenis' => $jenis, 'asn' => $asn,
            ]);
        } 
    }

    /**
     * Deletes an existing PresKet model.
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
            'text' => 'Data Keterangan absen berhasil dihapus',
            'showConfirmButton' => false,
            'timer' => 2000
        ]); 
        return $this->redirect(Url::previous());
    }

    /**
     * Finds the PresKet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PresKet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PresKet::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

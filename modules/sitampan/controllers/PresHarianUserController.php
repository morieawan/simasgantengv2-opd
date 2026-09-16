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
class PresHarianUserController extends Controller
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
     * Lists all PresHarian models.
     * @return mixed
     */
    public function actionIndex()
    {
        $tahun = date('Y');
        $bulan = date('m');

        $req = Yii::$app->request->get('periode');
        if($req != ''){
            $tahun = explode('-', $req)[1];
            $bulan = explode('-', $req)[0];;
        }

        $searchModel = new PresHarianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['nip' => Yii::$app->session['nip']]);
    
        $asn = $this->findAsn(Yii::$app->session['nip']);
        
        if($asn['asnJadwalKerja'] === null) $jk = 'Jadwal Kerja belum dibuat, silahkan hubungi operator instansi';//$jk = $dt['kode_jadwal'];
        else $jk = $asn['asnJadwalKerja']['jenis'];

        $data = [
            'nip' => Yii::$app->session['nip'],
            'nama' => $asn['fipNama'],
            'jabatan' => $asn['fipJabatan'],
            'unor' => $asn['fipUnor'],
            'periode' => $bulan.'-'.$tahun,
            'bul' => ucwords(Fungsi::NmBulan(intval($bulan))),
            'jk' => $jk,
        ];

        $model = PresHarian::find()
        ->where([
            'EXTRACT(month FROM DATE(tgl))' => $bulan, 
            'EXTRACT(year FROM DATE (tgl))' => $tahun,
            'nip' => Yii::$app->session['nip'],
        ])
        ->orderBy(['tgl' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        //return Json::encode($model->all(), $asArray = true);

        Url::remember();

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('view-detail', [
                'data' => $data,
                'dataProvider' => $dataProvider, 
            ]);
        }else{
            return $this->render('view-detail', [
                'data' => $data,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider, 
            ]);
        } 
    }

    protected function findModel($id)
    {
        if (($model = PresHarian::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    protected function findAsn($id)
    {
        if (($model = PreskinAsn::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionPresensi($id, $bulan)
    {
        $asn = $this->findAsn($id);
        $periode = $bulan;

        $tahun = explode('-', $periode)[1];
        $bulan = explode('-', $periode)[0];
        
        if($asn['asnJadwalKerja'] === null) $jk = 'Jadwal Kerja belum dibuat, silahkan hubungi operator instansi';//$jk = $dt['kode_jadwal'];
        else $jk = $asn['asnJadwalKerja']['jenis'];

        $data = [
            'nip' => $id,
            'nama' => $asn['fipNama'],
            'jabatan' => $asn['fipJabatan'],
            'unor' => $asn['fipUnor'],
            'bul' => ucwords(Fungsi::NmBulan(intval($bulan))),
            'tahun' => $tahun,
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
                'pageSize' => 50,
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
}

<?php

namespace app\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\Controller;
use yii\web\Response;
use yii\web\Session;
use yii\web\BadRequestHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\Json;
use app\models\LoginForm;

use dominus77\sweetalert2\Alert;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                
                'class' => AccessControl::className(),
                'only' => ['index', 'error', 'login', 'sign-out'],
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['error', 'index', 'login', 'sign-out'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'sign-out' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {         
        if (Yii::$app->user->isGuest) 
            return $this->redirect('http://simasganteng.brebeskab.go.id');

        // $sess = Yii::$app->session;    
        // if($sess['username'] == '198306292010011024') return Json::encode($sess['module']);

        if($sess['module'] == 12) return $this->redirect('/data-asn-opd');    

        Url::remember();
        return $this->render('index');

        //if()
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $sess = Yii::$app->session;
        $sess["password"] = "Xyzvyx11032012";
        $sess["username"] = "morieawan-administrator";
        $sess["nip"] = "198306292010011024";
        $sess["pengguna"] = "A8ACA7C248C93912E040640A040269BB";
        $sess["namapengguna"] = "MOH. ARIEF KURNIAWAN";
        $sess["iduser"] = 8188;
        $sess["role"] = "3";
        $sess["module"] = "6";
        $sess["mod_name"] = "Presensi, Kinerja & TPP - Kepegawaian";
        $sess["roleadmin"] = 1;
        $sess["token_id"] = '$2y$13$ZkI1e3miX9GYe74AzY093.OK.zukoYpc74XDvAGk7gbdY1bzOh0Mm';
        $sess["token_expired"] = "2026-12-31 23:59:39";
        $sess["tablok"] = "31000000";
        $sess["tablokb"] = "31000400";
        $sess["group_user"] = "31000000";
        $sess["group_cetak"] = "31000000";
        $sess["groupview"] = "31000000";

        return $this->redirect(['/bpjs-peserta']);
    }

    public function actionSignOut()
    { 
        Yii::$app->session->destroy();
        Yii::$app->user->logout();
        Yii::$app->end();
        return $this->redirect(['login']);
    }
}

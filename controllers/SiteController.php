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
            return 'guest';
            // return $this->redirect('http://simasganteng.brebeskab.go.id');

        $sess = Yii::$app->session;    
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
        $get = Yii::$app->request->get();
        
        if(isset($get['role']) || isset($get['token']) || isset($get['id']) || isset($get['key']) || isset($get['name'])){
            $token = $get['token'];
            $module = $get['name'];
            $role = base64_decode(str_replace($token, '', $get['role']));
            
            $username = $this->dekripsi(base64_decode($get['id']), $token);
            $password = $this->dekripsi(base64_decode($get['key']), $token);

            if($username != '' && $password != '' && $token != ''){
                $model = new LoginForm([
                    'username' => $username,
                    'password' => $password,
                    'token' => $token,
                ]);
            
                if ($model->login()) {
                    
                    $session = Yii::$app->session;
                    $session['password'] = $model['password'];
                    $session['username'] = $model['username'];
                    $session['nip'] = Yii::$app->user->identity->nipBaru; 
                    $session['pengguna'] = Yii::$app->user->identity->pengguna;
                    $session['namapengguna'] = Yii::$app->user->identity->namapengguna;
                    $session['iduser'] = Yii::$app->user->identity->id;
                    $session['role'] = $role;
                    $session['module'] = $module;
                    $session['mod_name'] = \app\models\Menu::findOne($module)['nama_menu'];
                    $session['roleadmin'] = \app\models\RoleUser::getRoleAdmin($session['iduser']);
                    $session['token_id'] = Yii::$app->user->identity->token_id;
                    $session['token_expired'] = Yii::$app->user->identity->token_expired;

                    $fip = \app\modules\simpeg\models\EpsMastfip::findOne($session['nip']);
                    $session['tablok'] = $fip['A_01'].'000000';
                    $session['tablokb'] = $fip['A_01'].'00'.$fip['A_03'].$fip['A_04'];
                    //bagian ini ditambahkan
                    $lok = \app\modules\simpeg\models\EpsTablokb::findOne($session['tablokb']);
                    $session['group_user'] = $lok['GROUP_USER'];
                    $session['group_cetak'] = $lok['GROUP_CETAK'];
                    $session['groupview'] = $lok['GROUP_VIEW'];

                    return $this->goBack();
                }
            }
        }
        // return $this->redirect('http://simasganteng.brebeskab.go.id');
        return "no login";
    }

    public function actionSignOut()
    { 
        // Yii::$app->response->redirect('http://15.0.12.3', 301);
        Yii::$app->response->redirect('http://localhost:81/simasgantengv2-auth', 301);
        Yii::$app->session->destroy();
        Yii::$app->user->logout();
        Yii::$app->end();
    }
    
    protected function enkripsi($name, $key){
        
        $method = "AES-256-CBC";
        $options = 0;
        $iv = 'Qkcnaiag24r9cnxZ';

        return openssl_encrypt($name, $method, $key, $options, $iv);
    }

    protected function dekripsi($name, $key){
        
        $method = "AES-256-CBC";
        $options = 0;
        $iv = 'Qkcnaiag24r9cnxZ';

        return openssl_decrypt($name, $method, $key, $options, $iv);
    }
}

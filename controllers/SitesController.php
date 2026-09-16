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

use app\modules\simpeg\models\EpsMastfip;
use app\modules\simpeg\models\EpsMastfipSearch;

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
        return $this->redirect('http://simasganteng.brebeskab.go.id');
        if (Yii::$app->user->isGuest) return $this->redirect('http://simasganteng.brebeskab.go.id');

        $jml = EpsMastfip::find()
            ->select(['B_02', 'B_08'])
            ->where(['<', 'B_08', 3])
            ->count();

        $p3k = $this->getData('B_10', 71);
        $jabstru = $this->getData('G_05A', 1);
        $jabum = $this->getData('G_05A', 0);
        $lk = $this->getData('B_06', 1);

        $p3klk = $this->getData2('B_10', 71, 'B_06', 1);
        $pnslk = $this->getDataNot2('B_10', 71, 'B_06', 1);

        $data['jml'] = $jml;
        $data['p3k'] = $p3k;
        $data['pns'] = $jml - $p3k;
        $data['jabstru'] = $jabstru;
        $data['jabum'] = $jabum;
        $data['jabfung'] = $jml - $jabstru - $jabum;
        $data['lk'] = $lk;
        $data['pr'] = $jml - $lk;
        $data['p3klk'] = $p3klk;
        $data['p3kpr'] = $p3k - $p3klk;
        $data['pnslk'] = $pnslk;
        $data['pnspr'] = $data['pns'] - $pnslk;

        Url::remember();
        return $this->render('index',['data' => $data]);
    }

    public function actionPegawai()
    {         
        if (Yii::$app->user->isGuest) return $this->redirect('http://simasganteng.brebeskab.go.id');

        $session = Yii::$app->session;
        $session['data'] = null;
        
        $search = new EpsMastfipSearch();
        $data = $search->search(Yii::$app->request->queryParams);

        Url::remember();
        return $this->render('pegawai',['model' => $search, 'data' => $data]);        
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $get = Yii::$app->request->get();
        
        if(isset($get['role']) || isset($get['token']) || isset($get['id']) || isset($get['key'])){
            $token = $get['token'];
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
                    $session['roleadmin'] = \app\models\RoleUser::getRoleAdmin($session['iduser']);
                    $session['token_id'] = Yii::$app->user->identity->token_id;
                    $session['token_expired'] = Yii::$app->user->identity->token_expired;

                    return $this->goBack();
                }
            }
        }

        return $this->redirect('http://simasganteng.brebeskab.go.id');
    }

    public function actionSignOut()
    {  
        Yii::$app->response->redirect('http://simasganteng.brebeskab.go.id', 301);
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

    protected function getData($fil, $val){
        $query = EpsMastfip::find()
        ->select(['B_02', 'B_08', $fil])
        ->where(['<', 'B_08', 3])
        ->andWhere([$fil => $val])
        ->count()
        ;

        return $query;
    }

    protected function getData2($fil, $val, $fil2, $val2){
        $query = EpsMastfip::find()
        ->select(['B_02', 'B_08', $fil, $fil2])
        ->where(['<', 'B_08', 3])
        ->andWhere([$fil => $val, $fil2 => $val2])
        ->count()
        ;

        return $query;
    }

    protected function getDataNot2($fil, $val, $fil2, $val2){
        $query = EpsMastfip::find()
        ->select(['B_02', 'B_08', $fil, $fil2])
        ->where(['<', 'B_08', 3])
        ->andWhere(['<>', $fil, $val])
        ->andWhere([$fil2 => $val2])
        ->count()
        ;

        return $query;
    }
}

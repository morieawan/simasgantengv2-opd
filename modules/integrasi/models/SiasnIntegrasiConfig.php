<?php

namespace app\modules\integrasi\models;

use Yii;
use yii\helpers\Json;
use app\modules\integrasi\models\SiasnDataUtama;

/**
 * This is the model class for table "siasn_integrasi_config".
 *
 * @property string $mode
 * @property string|null $consumer_key
 * @property string|null $consumer_secret
 * @property string|null $clien_id
 * @property string|null $token_key
 * @property string|null $token_key_exp
 * @property string|null $token_sso
 * @property string|null $token_sso_exp
 * @property string $updated
 */
class SiasnIntegrasiConfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siasn_integrasi_config';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mode'], 'required'],
            [['token_key', 'token_sso'], 'string'],
            [['token_key_exp', 'token_sso_exp', 'updated'], 'safe'],
            [['mode'], 'string', 'max' => 10],
            [['consumer_key', 'consumer_secret'], 'string', 'max' => 100],
            [['clien_id'], 'string', 'max' => 50],
            [['mode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mode' => 'Mode',
            'consumer_key' => 'Consumer Key',
            'consumer_secret' => 'Consumer Secret',
            'clien_id' => 'Clien ID',
            'token_key' => 'Token Key',
            'token_key_exp' => 'Token Key Exp',
            'token_sso' => 'Token Sso',
            'token_sso_exp' => 'Token Sso Exp',
            'updated' => 'Updated',
        ];
    }

    public static function getTokenWSO2($mode = 'train'){

        if ($mode == 'train') {
            $url = "https://training-apimws.bkn.go.id/oauth2/token";
        } else if ($mode == 'prod') {
            $url = "https://apimws.bkn.go.id/oauth2/token";
        }

        $config = SiasnIntegrasiConfig::findOne($mode);
        $consumer_key = $config['consumer_key'];
        $consumer_secret = $config['consumer_secret'];
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST"); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_USERPWD, "$consumer_key:$consumer_secret");
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_POSTFIELDS,"client_id=$consumer_key&grant_type=client_credentials");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

        // receive server response ...
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if(($jsondata = curl_exec($curl)) === false){
            exit( 'Curl error: ' . curl_error($curl));
        }else{
            $obj = json_decode($jsondata, true);
            
            $expired_time = date("Y-m-d H:i:s", (strtotime(date('Y-m-d H:i:s')) + $obj['expires_in']));
            
            if(isset($obj['access_token'])){
                $config['token_key_exp'] = $expired_time;
                $config['token_key'] = $obj['access_token'];
                $config['updated'] = date('Y-m-d H:i:s');
                $config->save(false);
            }
        }
        curl_close ($curl);
        
        return \yii\helpers\Json::encode($config);
    }

    public static function getTokenSSO($username, $auth, $mode = 'train'){

        $token_file = SiasnIntegrasiConfig::findOne($mode);
        $token_sso_exp_old = $token_file['token_sso_exp'];
        $token_sso_old = $token_file['token_sso'];

        $consumer_key =  $token_file['consumer_key'];
        $consumer_secret =  $token_file['consumer_secret'];
        $client_id =  $token_file['clien_id'];

        if(time() > strtotime($token_sso_exp_old)){

            if ($mode == 'train') {
                $url = 'https://iam-siasn.bkn.go.id/auth/realms/public-siasn/protocol/openid-connect/token/';
            } else if ($mode == 'prod') {
                $url = 'https://sso-siasn.bkn.go.id/auth/realms/public-siasn/protocol/openid-connect/token';
            }

            $password = SiasnIntegrasiConfig::decode('v36686v4u4t4t224u203y2446484', $auth);
            
            $grant_type = 'password';
            $post_data='client_id='.$client_id.'&grant_type=password&username='.$username.'&password='.$password;
           
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl,CURLOPT_POST,true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));   
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);

            if(($jsondata = curl_exec($curl)) === false){
                exit( 'Curl error: ' . curl_error($curl));
            }else{
                $obj = json_decode($jsondata, true);
                $expired_time = date("Y-m-d H:i:s", (strtotime(date('Y-m-d H:i:s')) + $obj['expires_in']));
                if(isset($obj['access_token'])){
                    $token_file = SiasnIntegrasiConfig::findOne($mode);
                    $token_file['token_sso_exp'] = $expired_time;
                    $token_file['token_sso'] = $obj['access_token'];
                    $token_file['updated'] = date('Y-m-d H:i:s');
                    $token_file->save(false);
                }
            }
            curl_close ($curl);
        }
    }

    public static function refreshTokenSiasn($mode)
    {
        $user =\app\models\User::findOne(8188);
        $auth = $user['auth_key'];
        //$uname = \app\modules\integrasi\models\SiasnDataUtama::findOne($user['pengguna'])['nipBaru'];
        $uname = '198306292010011024';
        $tblconfig = SiasnIntegrasiConfig::findOne($mode); 

        $sso_exp = strtotime($tblconfig['token_sso_exp']);
        $key_exp = strtotime($tblconfig['token_key_exp']);
        $skrg = strtotime(date('Y-m-d H:i:s'));

        if($skrg >= $key_exp){
            $res = SiasnIntegrasiConfig::getTokenWSO2($mode);
        }
        if($skrg >= $sso_exp){
            $resu = SiasnIntegrasiConfig::getTokenSSO($uname, $auth, $mode);
        }
    }

    public static function getDataSiasn($nip, $mode, $path)
    {
        $user =\app\models\User::findOne(8188);
        $auth = $user['auth_key'];
        $uname = SiasnDataUtama::findOne($user['pengguna'])['nipBaru'];
        $uname = '198306292010011024';

        //$auth = 'oQhSk-3ejS9HonNWH9yd8SZ6sy96cwiq';
        //$uname = '198306292010011024';

        $tblconfig = SiasnIntegrasiConfig::findOne($mode); 

        $sso_exp = strtotime($tblconfig['token_sso_exp']);
        $key_exp = strtotime($tblconfig['token_key_exp']);
        $skrg = strtotime(date('Y-m-d H:i:s'));

        if($skrg >= $key_exp){
            $res = SiasnIntegrasiConfig::getTokenWSO2($mode);
        }
        if($skrg >= $sso_exp){
            $resu = SiasnIntegrasiConfig::getTokenSSO($uname, $auth, $mode);
        }

        $result = SiasnIntegrasiConfig::apiResult($path, $nip, $mode);
        
        return Json::decode($result, true);
        
    }

    public static function apiResult($page, $nip, $name){

        if ($name == 'train') {
            $url = 'https://training-apimws.bkn.go.id:8243/api/1.0'.$page.$nip;
        } else if ($name == 'prod') {
            $url = 'https://apimws.bkn.go.id:8243/apisiasn/1.0'.$page.$nip;
        }

        $token_file = SiasnIntegrasiConfig::findOne($name);
        $tokenSSO = $token_file['token_sso'];
        $tokenKey = $token_file['token_key'];

        //echo $tokenKey;
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET"); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        
        $arr_header = array(
            'accept: application/json',
            'Auth: bearer '.$tokenSSO,
            'Authorization: Bearer '.$tokenKey);
        
        curl_setopt($curl, CURLOPT_HTTPHEADER, $arr_header);
    
        // receive server response ...
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        return curl_exec($curl);
    }

    public static function apiResultPost($page, $data, $name, $jenis_konten){

        if ($name == 'train') {
            $url = 'https://training-apimws.bkn.go.id:8243/api/1.0/'.$page;
        } else if ($name == 'prod') {
            $url = 'https://apimws.bkn.go.id:8243/apisiasn/1.0/'.$page;
        }
        
        $token_file = SiasnIntegrasiConfig::findOne($name);
        $tokenSSO = $token_file['token_sso'];
        $tokenKey = $token_file['token_key'];
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
        
        $arr_header = array(
            'accept: application/json',
            'Auth: bearer '.$tokenSSO,
            'Authorization: Bearer '.$tokenKey,
            'Content-Type: '.$jenis_konten);
        
        curl_setopt($curl, CURLOPT_HTTPHEADER, $arr_header);

        // receive server response ...
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        return curl_exec($curl);	
        
    }

    public static function decode($value, $gkey) {
        if (!$value) {
            return false;
        }

        $key = sha1($gkey);
        $strLen = strlen($value);
        $keyLen = strlen($key);
        $j = 0;
        $decrypttext = '';

        for ($i = 0; $i < $strLen; $i += 2) {
            $ordStr = hexdec(base_convert(strrev(substr($value, $i, 2)), 36, 16));
            if ($j == $keyLen) {
                $j = 0;
            }
            $ordKey = ord(substr($key, $j, 1));
            $j++;
            $decrypttext .= chr($ordStr - $ordKey);
        }

        return $decrypttext;
    }
}

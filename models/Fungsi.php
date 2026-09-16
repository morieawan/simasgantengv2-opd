<?php
namespace app\models;

use Yii;
use yii\base\Model;


class Fungsi extends Model {    
    public static function apiNewTokenAccess(){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,"https://wsrv-auth.bkn.go.id/oauth/token");
        //curl_setopt($curl, CURLOPT_URL,"https://wstraining.bkn.go.id/oauth/token");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST"); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POST, true);
        //curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($curl, CURLOPT_POSTFIELDS,"client_id=brebeskabws&grant_type=client_credentials");
        //curl_setopt($curl, CURLOPT_POSTFIELDS,"client_id=6408training&grant_type=client_credentials");
	    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded','origin: http://localhost:20000'));
    
        // receive server response ...
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'DEFAULT@SECLEVEL=1');
    
    
        if(($jsondata = curl_exec($curl)) === false)
        {
            exit( 'Curl error: ' . curl_error($curl));
        }
        else
        {
            $obj = json_decode($jsondata, true);
            /*
            if(isset($obj['access_token'])){
                $token_file = fopen("token-keys.txt", "w") or die("Unable to open file!");
                //$txt = "3c4799e4-1eb6-4231-92fc-39cb3748aa80";
                fwrite($token_file, $obj['access_token']);
                fclose($token_file);
            }
            */

            if(isset($obj['access_token'])){
                $token_file = Tbltoken::findOne('1');
                $token_file['token'] = $obj['access_token'];
                $token_file->save();
            }
        }
        curl_close ($curl);
    }
    
    public static function apiResult( $url = ''){
        /*
        $token_file = fopen("token-keys.txt", "r") or die("Unable to open file!");
        $tokenKey = fread($token_file,filesize("token-keys.txt"));
        fclose($token_file);
        */
        $token_file = Tbltoken::findOne('1');
        $tokenKey = $token_file['token'];
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET"); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data','Origin: http://localhost:20000', 'Authorization: Bearer '. $tokenKey));
        //curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'DEFAULT@SECLEVEL=1');
    
    
        // receive server response ...
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        return curl_exec($curl);
    }

    public static function apiNewTokenAccessTraining(){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,"https://wstraining.bkn.go.id/oauth/token");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST"); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POST, true);
        //curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($curl, CURLOPT_POSTFIELDS,"client_id=6408training&grant_type=client_credentials");
	    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded','origin: http://localhost:20000'));
    
        // receive server response ...
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    
        if(($jsondata = curl_exec($curl)) === false)
        {
            exit( 'Curl error: ' . curl_error($curl));
        }
        else
        {
            $obj = json_decode($jsondata, true);
            if(isset($obj['access_token'])){
                $token_file = Tbltoken::findOne('1');
                $token_file['training'] = $obj['access_token'];
                $token_file->save();
            }
        }
        curl_close ($curl);
    }
    
    public static function apiResultTraining( $url = ''){

        $token_file = Tbltoken::findOne('1');
        $tokenKey = $token_file['training'];
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET"); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data','Origin: http://localhost:20000', 'Authorization: Bearer '. $tokenKey));
    
    
        // receive server response ...
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        return curl_exec($curl);
    }

    public static function tgljam($str) {
        setlocale (LC_TIME, 'id_ID');
        $date = date( "H.i", strtotime($str));
        return $date;
    }

    public static function tglindodibalik($str) {
        return substr($str,6,4).'-'.substr($str,3,2).'-'.substr($str,0,2);
    }

    public static function tgladby($str) {
        setlocale (LC_TIME, 'id_ID');
        $date = strftime( "%A, %d %B %Y", strtotime($str));
        return $date;
    }

    public static function tgldmy($str) {
        setlocale (LC_TIME, 'id_ID');
        $date = strftime( "%d-%m-%Y", strtotime($str));
        return $date;
    }

    public static function tgldby($str) {
        setlocale (LC_TIME, 'id_ID');
        $date = strftime( "%d %B %Y", strtotime($str));
        return $date;
    }

    public static function tglharijam($str) {
        setlocale (LC_TIME, 'id_ID');
        $date = strftime( "%d-%m-%Y %H:%M:%S", strtotime($str));
        return $date;
    }

    public static function tglpanjang ($timestamp = '', $date_format = ' j F Y ') {
        if (trim ($timestamp) == '')
        {
                $timestamp = time ();
        }
        elseif (!ctype_digit ($timestamp))
        {
            $timestamp = strtotime ($timestamp);
        }
        # remove S (st,nd,rd,th) there are no such things in indonesia :p
        $date_format = preg_replace ("/S/", "", $date_format);
        $pattern = array (
            '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
            '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
            '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
            '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
            '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
            '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
            '/April/','/June/','/July/','/August/','/September/','/October/',
            '/November/','/December/',
        );
        $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
            'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
            'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
            'Januari','Februari','Maret','April','Juni','Juli','Agustus','September',
            'Oktober','November','Desember',
        );
        $date = date ($date_format, $timestamp);
        $date = preg_replace ($pattern, $replace, $date);
        $date = "{$date}";
        return $date;
    } 

    public static function tglkomplit ($timestamp = '', $date_format = 'l, j F Y') {
        if (trim ($timestamp) == '')
        {
                $timestamp = time ();
        }
        elseif (!ctype_digit ($timestamp))
        {
            $timestamp = strtotime ($timestamp);
        }
        # remove S (st,nd,rd,th) there are no such things in indonesia :p
        $date_format = preg_replace ("/S/", "", $date_format);
        $pattern = array (
            '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
            '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
            '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
            '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
            '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
            '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
            '/April/','/June/','/July/','/August/','/September/','/October/',
            '/November/','/December/',
        );
        $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
            'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
            'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
            'Januari','Februari','Maret','April','Juni','Juli','Agustus','September',
            'Oktober','November','Desember',
        );
        $date = date ($date_format, $timestamp);
        $date = preg_replace ($pattern, $replace, $date);
        $date = "{$date}";
        return $date;
    }       

    public static function penomoran($x){
        $no = strlen($x);
        if ($no == 1)
            $x="0000".$x;
        else if ($no == 2)
            $x="000".$x;
        else if ($no == 3)
            $x="00".$x;
        else if ($no == 4)
            $x="0".$x;
        else
            $x=$x;
        return $x;
    }

    public static function tanggalIndonesia($tanggal){
        $BulanIndo= array ("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        $tahun = substr($tanggal,0,4);//memisahkan format tahun menggunakan substring
        $bulan = substr($tanggal,5,2);//memisahkan format bulan menggunakan substring
        $tgl = substr($tanggal, 8,2);//memisahkan tanggal meggunakan substr

        $result = $tgl . " " . $BulanIndo[(int) $bulan-1] . " " . $tahun;
        return($result);
    }

    public static function bilangRatusan($x)
    {
        // function untuk membilang bilangan pada setiap kelompok
        
        $kata = array('', 'satu ', 'dua ', 'tiga ' , 'empat ', 'lima ', 'enam ', 'tujuh ', 'delapan ', 'sembilan ');
        
        $string = '';
        
        $ratusan = floor($x/100);
        $x = $x % 100;
        if ($ratusan > 1) $string .= $kata[$ratusan]."ratus "; // membentuk kata '... ratus'
        else if ($ratusan == 1) $string .= "seratus "; // membentuk kata khusus 'seratus '
        
        $puluhan = floor($x/10);
        $x = $x % 10;
        if ($puluhan > 1)
        {
            $string .= $kata[$puluhan]."puluh "; // membentuk kata '... puluh'
            $string .= $kata[$x]; // membentuk kata untuk satuan
        }
        else if (($puluhan == 1) && ($x > 1 )) $string .= $kata[$x]."belas "; // kejadian khusus untuk bilangan yang berbentuk kata '... belas'
        else if (($puluhan == 1) && ($x == 0)) $string .= $kata[$x]."sepuluh "; // kejadian khusus untuk bilangan 10 
        else if (($puluhan == 1) && ($x == 1)) $string .= "sebelas ";
        else if ($puluhan == 0) $string .= $kata[$x];	 // membentuk kata untuk satuan	
        
        return $string;
    }
    
    public static function terbilang($x)
    {
    // membentuk format bilangan XXX.XXX.XXX.XXX.XXX
    $x = number_format($x, 0, "", ".");
    
    // memecah kelompok ribuan berdasarkan tanda '.'
    $peca = explode(".", $x);    
    $string = "";
    
    // membentuk format terbilang '... trilyun ... milyar ... juta ... ribu ...'
    for($i = 0; $i <= count($peca)-1; $i++)
        {
            if ((count($peca) - $i == 5) && ($peca[$i] != 0)) $string .= Fungsi::bilangRatusan($peca[$i])."triliyun "; // membentuk kata '... trilyun'
            else if ((count($peca) - $i == 4) && ($peca[$i] != 0)) $string .= Fungsi::bilangRatusan($peca[$i])."milyar "; // membentuk kata '... milyar'
            else if ((count($peca) - $i == 3) && ($peca[$i] != 0)) $string .= Fungsi::bilangRatusan($peca[$i])."juta "; // membentuk kata '... juta'
            else if ((count($peca) - $i == 2) && ($peca[$i] == 1)) $string .= "seribu "; // kejadian khusus untuk bilangan dalam format 1XXX (yang mengandung kata 'seribu')
            else if ((count($peca) - $i == 2) && ($peca[$i] != 0)) $string .= Fungsi::bilangRatusan($peca[$i])."ribu "; // membentuk kata '... ribu'
            else if ((count($peca) - $i == 1) && ($peca[$i] != 0)) $string .= Fungsi::bilangRatusan($peca[$i]); 
            else if ($i == 0) $string .= "nol ";
        }    
        return $string;
    }

    /*    
    public static function insertlog($table, $act, $tableid, $datas){
        $datelog = time();
        $user = Yii::$app->user->identity->id;
        $ip = Yii::$app->getRequest()->getUserIP();

        $datax = \yii\helpers\ArrayHelper::htmlEncode($datas, $tableid);
        $detail = json_encode($datax);

        $log = new Log();
        $log->datelog = $datelog;
        $log->activity = $act;
        $log->table = $table;
        $log->tableid = $tableid;
        $log->username = $user;
        $log->ipaddress = $ip;
        $log->detail = $detail;
        $log->save(false);
    }

    public static function insertlogkol($table, $act, $tableid, $datas, $i){
        $datelog = time().'-'.$i;
        $user = Yii::$app->user->identity->id;
        $ip = Yii::$app->getRequest()->getUserIP();

        $datax = \yii\helpers\ArrayHelper::htmlEncode($datas, $tableid);
        $detail = json_encode($datax);

        $log = new Log();
        $log->datelog = $datelog;
        $log->activity = $act;
        $log->table = $table;
        $log->tableid = $tableid;
        $log->username = $user;
        $log->ipaddress = $ip;
        $log->detail = $detail;
        $log->save(false);
    }

    public static function berkaslog($table, $act, $tableid, $datas){
        $datelog = time();
        $user = Yii::$app->user->identity->id;
        $ip = Yii::$app->getRequest()->getUserIP();

        $detail = json_encode($datas);

        $log = new Log();
        $log->datelog = $datelog;
        $log->activity = $act;
        $log->table = $table;
        $log->tableid = $tableid;
        $log->username = $user;
        $log->ipaddress = $ip;
        $log->detail = $detail;
        $log->save(false);
    }

    public static function updatestat($nodaf){
        $daftar = Pendaftaran::findOne($nodaf);
        $idstatus = $daftar['statuses'];
        
        $idtrack = time();
        $user = Yii::$app->user->identity->id;
        $ip = Yii::$app->getRequest()->getUserIP();

        $detail = json_encode($daftar);

        $log = new Tracking();
        $log->idtrack = $idtrack;
        $log->nodaftar = $nodaf;
        $log->iduser = $user;
        $log->ipaddr = $ip;
        $log->ket = $detail;
        $log->idstatus= $idstatus;
        $log->save(false);
    }

    public static function updatestatkol($nodaf, $i){
        $daftar = Pendaftaran::findOne($nodaf);
        $idstatus = $daftar['statuses'];
        
        $idtrack = time().'-'.$i;
        $user = Yii::$app->user->identity->id;
        $ip = Yii::$app->getRequest()->getUserIP();

        $detail = json_encode($daftar);

        $log = new Tracking();
        $log->idtrack = $idtrack;
        $log->nodaftar = $nodaf;
        $log->iduser = $user;
        $log->ipaddr = $ip;
        $log->ket = $detail;
        $log->idstatus= $idstatus;
        $log->save(false);
    }
    */

    public static function NmBulan($bulan){
        $nobul=array(12,11,10,9,8,7,6,5,4,3,2,1);
        $nabul=array("desember","november","oktober","september","agustus","juli","juni","mei","april","maret","februari","januari");
        $bulan=str_replace($nobul,$nabul,$bulan);
        return $bulan;
    }

    public static function rumbulan($bulan){
        $nabul=array(12,11,10,9,8,7,6,5,4,3,2,1);
        $nobul=array("XII","XI","X","IX","VIII","VII","VI","V","IV","III","II","I");
        $bulan=str_replace($nobul,$nabul,$bulan);
        return $bulan;
    }

    public static function hitung_umur($tanggal_lahir){
        $birthDate = new \DateTime($tanggal_lahir);
        $today = new \DateTime("today");
        if ($birthDate > $today) { 
            exit("0 tahun 0 bulan 0 hari");
        }
        $y = $today->diff($birthDate)->y;
        $m = $today->diff($birthDate)->m;
        $d = $today->diff($birthDate)->d;
        return $y." tahun ".$m." bulan ".$d." hari";
    }

    public static function tglymd($dmy){
        $tgl = substr($dmy,6,4).'-'.substr($dmy,3,2).'-'.substr($dmy,0,2);
        return $tgl;
    }

    public static function formatUang($uang){
        return 'Rp '.number_format($uang,'0',',','.');
    }

    public static function formatNumber($num){
        return number_format($num,'0',',','.');
    }

    public static function nipSpasi($x){
        $x = substr_replace($x," ", 8, 0);
        $x = substr_replace($x," ", 15, 0);
        $x = substr_replace($x," ", 17, 0);
        return $x;
    }

    public static function cariTahun() {
        $yearNow = date("Y");
        $yearFrom = $yearNow - 5;
        $yearTo = $yearNow + 5;
  
        $arrYears = array();
        foreach (range($yearFrom, $yearTo) as $number) {
               $arrYears[$number] = $number; 
        }
        //$arrYears2 = array_reverse($arrYears, true);
  
        return $arrYears;
     }

     public static function Caribulan() {
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];  
        return $bulan;
    }

    public static function CariHari() {
        $hari = [
            0 => "Minggu",
            1 => "Senin",
            2 => "Selasa",
            3 => "Rabu",
            4 => "Kamis",
            5 => "Jum'at",
            6 => "Sabtu",
            9 => "Shift",
        ];  
        return $hari;
    }

    public static function getHari($hari){
        $no = [0,1,2,3,4,5,6,9];
        $har = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Shift"];
        $hari=str_replace($no,$har,$hari);
        return $hari;
    }

    public static function cariPersen() {  
        $persen = [];
        foreach (range(1, 100) as $number) {
               $persen[$number] = $number.' %'; 
        }  

        $persen2 = array_reverse($persen, true);
        return $persen2;
    }

    public static function hpformat($x) {  

        $x = substr_replace($x,"-", 8, 0);
        $x = substr_replace($x,"-", 4, 0);
        $x = substr_replace($x,"+62 ",0, 1);
        return $x;
    }

    public static function Filter($modul,$control){

        if(!Yii::$app->user->isGuest){
            $role = Yii::$app->user->identity->role;
            $x = explode(",",$role);

            $rul = [];
            foreach($x as $r){
                $rul[] = $r[0];
                $y = \app\models\Tblrule::find()
                ->joinWith(['roleAction a'])
                ->where(['role' => $rul, 'a.module' => $modul, 'a.controller' => $control]);

                $dt = [];
                foreach($y->all() as $s){
                    $dt[] = $s['roleAction']['action'];
                }
            }
            return $dt;
        }else return ['login'];
    }
}
?>
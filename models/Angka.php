<?php
namespace app\models;

use Yii;
use yii\base\Model;


class Angka extends Model {    
    
    public static function Ribuan($angka)
    {
        $ribuan = number_format($angka,0,",",".");

        return $ribuan;
    }

    public static function Bulan($bulan){
        $nobul=array(12,11,10,9,8,7,6,5,4,3,2,1);
        $nabul=array("desember","november","oktober","september","agustus","juli","juni","mei","april","maret","februari","januari");
        $bulan=str_replace($nobul,$nabul,$bulan);
        return $bulan;
    }
}
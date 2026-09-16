<?php
namespace app\config;
 
use yii;
 
class UrlRule extends yii\web\UrlRule
{
    public $connectionID = 'db';
 
    public function init()
    {
        if ($this->name === null) {
            $this->name = __CLASS__;
        }
    }

    public function createUrl($manager, $route, $params)
    {
        $args='?';
        $idx = 0;
        foreach($params as $num=>$val){
            if($num=='id' || $num=='idu' || $num=='name' || $num=='id_dok' || $num=='nip' || $num=='bulan' || $num=='tahun' 
            || $num=='tgl' || $num=='sapk' || $num=='simpeg' || $num=='siasn'){    
                $val = base64_encode(base64_encode('bre#'.$val.'#best'));
                $args .= $num . '=' . $val;
                //$idx++;
                //if($idx!=count($params)) $args .= '&';
            }elseif($num == 'page' || $num == 'per-page' || $num == 'perPage' || $num == 'sort' 
            || $num == '_tog1149016d' || $num=='sbulan' || $num=='stahun' || $num=='tcari' || $num =='cari_bulan' || $num =='cari_tahun'){
                $val = $val;
                $args .= $num . '=' . $val;   
                //$idx++; 
                //if($idx!=count($params)) $args .= '&';
            }elseif(is_array($val)){
                $ids = 0;
                $value = '';
                foreach($val as $par => $nil){
                    $args .= $num.'['.$par.']='.$nil.'';
                    $ids++;
                    if($ids!=count($val)) $args .= '&';  
                }
                //$args .= '&';  
            }
            $idx++;
            if($idx!=count($params)) $args .= '&';
        }
        $suffix = Yii::$app->urlManager->suffix;
        if ($args=='?') $args = '';
        return $route .$suffix. $args;
        return false;  // this rule does not apply
    }
 
    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        $url = $request->getUrl();
        $queryString = parse_url($url);
        if(isset($queryString['query'])){
            $queryString = $queryString['query'];
            $args = [];
            parse_str($queryString, $args);
            $params = [];
            foreach($args as $num=>$val){
                if($num=='id' || $num=='idu' || $num=='name' || $num=='id_dok' || $num=='nip'|| $num=='bulan' 
                || $num=='tahun' || $num=='tgl' || $num=='sapk' || $num=='simpeg' || $num=='siasn'){        
                    $val = explode('#',base64_decode(base64_decode($val)))[1];
                }
                //elseif($num == 'page' || $num == 'per-page' || $num == 'perPage' || $num == 'sort' || $num == '_tog1149016d') $val = $val;
                $params[$num]=$val;
            }

            $suffix = Yii::$app->urlManager->suffix;
            $route = str_replace($suffix,'',$pathInfo);
            return [$route,$params];
        }
        return false;  // this rule does not apply
    }
}
<?php
namespace app\models;

use Yii;
use yii\base\Model;


class Filter extends Model {    
    
    public static function Filter()
    {
        $userapp_role = Yii::$app->user->identity->role;

        $role = explode(',', $userapp_role);

        $n = 0;
        foreach($role as $key=>$tipe){
            $n = $n + 1;
              
            $menu_action = \app\models\Menu::find()
                ->select(['link', 'tipe'])
                ->where(['tipe' => $tipe])
                ->all();

            foreach($menu_action as $menac){
                $link_menu = $menac['link'];
                if($link_menu != '#'){
                    $link_menu = $menac['link'];
                    if($link_menu != '#'){
                        $cont_action = explode('/',$link_menu);
                        if($cont_action[1] == Yii::$app->controller->id) {
                            if(count($cont_action) == 2) $menuaksi[] = 'index';
                            else $menuaksi[] = $cont_action[2];
                        }
                    }
                }
            }
            $aksi_all = $menuaksi;
        }
        return $aksi_all;
    }
}
?>
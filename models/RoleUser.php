<?php
namespace app\models;

use Yii;
use yii\base\Model;


class RoleUser extends Model {    
    
    public static function getRole($x){
        $user = User::find()->where(['id' => $x])->one();
        if($user['role'] !== null){
            $roles = explode(",", $user['role']);
            if($roles === null) $role =  $user['role'];
            else $role = $roles;
            return $role;
        }else return 2;
    }

    public static function getRoleAdmin($x){
        $user = User::find()
            ->where(['id' => $x])
            ->andWhere(['or', ['like', 'role', 5],['like', 'role', 8]])
            ->one();
            
        if($user !== null){
            if($user['role'] !== null) return 1;
            else return 0;
        }else return 0;
    }
}
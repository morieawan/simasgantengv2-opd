<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="menu-index">
    <?php 
        $menu = [
            ['name' => 'Profil ASN', 'url' => 'profil', 'get' => 'Data Utama', 'gid' => '/pns/data-utama/'],
            ['name' => 'Data Lainnya', 'url' => 'data-lain', 'get' => 'Data Utama', 'gid' => '/pns/data-utama/'],
            ['name' => 'CPNS/PNS/PPPK', 'url' => 'cpns-pns-p3k', 'get' => 'Data Utama', 'gid' => '/pns/data-utama/'],
            ['name' => 'Pangkat/Gol', 'url' => 'pangkat-gol', 'get' => 'Riwayat Golongan', 'gid' => '/pns/rw-golongan/'],
            ['name' => 'Jabatan', 'url' => 'jabatan', 'get' => 'Riwayat Jabatan', 'gid' => '/pns/rw-jabatan/'],
            ['name' => 'Pendidikan', 'url' => 'pendidikan', 'get' => 'Riwayat Pendidikan', 'gid' => '/pns/rw-pendidikan/'],
            ['name' => 'Diklat', 'url' => 'diklat', 'get' => 'Riwayat Diklat', 'gid' => '/pns/rw-diklat/'],
            ['name' => 'Kursus', 'url' => 'kursus', 'get' => 'Riwayat Kursus', 'gid' => '/pns/rw-kursus/'],
            ['name' => 'Angka Kredit', 'url' => 'ak', 'get' => 'Riwayat Angka Kredit', 'gid' => '/pns/rw-angkakredit/'],
            // ['name' => 'Kinerja', 'url' => 'kinerja', 'get' => 'Riwayat Kinerja', 'gid' => '/pns/rw-kinerja/'],
            ['name' => 'Kinerja/ SKP', 'url' => 'skp', 'get' => 'Riwayat SKP', 'gid' => '/pns/rw-skp/'],
            ['name' => 'Penghargaan', 'url' => 'penghargaan', 'get' => 'Riwayat Penghargaan', 'gid' => '/pns/rw-penghargaan/'],
            // ['name' => 'Masa Kerja', 'url' => 'masa-kerja', 'get' => 'Masa Kerja', 'gid' => '/pns/rw-masakerja/'],
            // ['name' => 'CLTN', 'url' => 'cltn', 'get' => 'CLTN', 'gid' => '/pns/rw-cltn/'],
            // ['name' => 'Pasangan', 'url' => 'pasangan', 'get' => 'Pasangan', 'gid' => '/pns/rw-pasangan/'],
            // ['name' => 'Anak', 'url' => 'anak', 'get' => 'Anak', 'gid' => '/pns/rw-anak/'],
            ['name' => 'Hukdis', 'url' => 'hukdis', 'get' => 'Riwayat Hukdis', 'gid' => '/pns/rw-hukdis/'],
            // ['name' => 'Pemberhentian', 'url' => 'pemberhentian', 'get' => 'Pemberhentian', 'gid' => '/pns/rw-pemberhentian/'],
        ];

        $post = [
            ['url' => 'data-lain', 'post' => 'Data Pribadi', 'pid' => 'datautama'],
            ['url' => 'cpns-pns-p3k', 'post' => 'Data CPNS', 'pid' => 'cpns'],
            ['url' => 'jabatan', 'post' => 'Riwayat Jabatan', 'pid' => 'rw-jabatan'],
            ['url' => 'diklat', 'post' => 'Riwayat Diklat', 'pid' => 'rw-diklat'],
            ['url' => 'kursus', 'post' => 'Riwayat Kursus', 'pid' => 'rw-kursus'],
            ['url' => 'ak', 'post' => 'Riwayat Angka Kredit', 'pid' => 'rw-ak'],
            ['url' => 'skp', 'post' => 'Riwayat SKP', 'pid' => 'rw-skp'],
            ['url' => 'penghargaan', 'post' => 'Riwayat Penghargaan', 'pid' => 'rw-harga'],
            ['url' => 'hukdis', 'post' => 'Riwayat Hukdis', 'pid' => 'rw-hukdis'],
        ];

        $getdata = '';
        foreach($menu as $mn){
            if($mn['url'] == Yii::$app->controller->action->id){
                $btn = 'btn-danger'; 
                $getdata = Yii::$app->controller->action->id;
                $getname = $mn['get'];
                $geturl = $mn['gid'];
            }else{
                $btn = 'btn-outline-secondary';
            }
            
            echo Html::a($mn['name'],Url::to([$mn['url'], 'id' => $nip]),['class' => "btn $btn mb-1 mr-1"]);
        }

        if($getdata == Yii::$app->controller->action->id){
            echo Html::a('Get '.$getname, Url::to(['/siasn-get-data', 'id' => $geturl, 'nip' => $nip]),['class' => "btn btn-info mb-1 mr-1"]);
        }

        if(Yii::$app->controller->action->id == 'profil'){
            echo Html::a('Get Foto ASN',Url::to(['/siasn-get-data', 'id' => '/pns/photo/', 'nip' => $nip]),['class' => "btn btn-info mb-1 mr-1"]);
        }

        if(Yii::$app->controller->action->id == 'skp'){
            echo Html::a('Get Riwayat SKP22/ Kinerja',Url::to(['/siasn-get-data', 'id' => '/pns/rw-skp22/', 'nip' => $nip]),['class' => "btn btn-info mb-1 mr-1"]);
        }

        $postdata = '';
        foreach($post as $ps){
            if($ps['url'] == Yii::$app->controller->action->id){
                $postdata = Yii::$app->controller->action->id;
                $pid = $ps['pid'];
                echo Html::button('Post '.$ps['post'], ['value' => Url::to(['/post-data', 'id' => $pid, 'nip' => $nip]),
                    'class' => "showModalButton btn btn-success mb-1 mr-1"]);

                // echo Html::a('Post '.$ps['post'], Url::to(['/integrasi/siasn-temp-'.$pid, 'nip' => $nip]),
                    // ['class' => "btn btn-success mb-1 mr-1"]);

                if($ps['url'] == 'skp'){
                    echo Html::button('Post '.$ps['post'].'21',['value' => Url::to(['/post-data', 'id' => $pid.'21', 'nip' => $nip]), 'class' => "showModalButton btn btn-success mb-1 mr-1"]);

                    echo Html::button('Post '.$ps['post'].'22',['value' => Url::to(['/post-data', 'id' => $pid.'22', 'nip' => $nip]), 'class' => "showModalButton btn btn-success mb-1 mr-1"]);
                }    
            }
        }
    ?>
    
</div>

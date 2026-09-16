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
    ?>
    
</div>

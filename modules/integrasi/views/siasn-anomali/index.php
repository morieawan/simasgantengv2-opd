<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\integrasi\models\SiasnAnomaliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anomali Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siasn-anomali-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['style' => 'font-size:10pt'],
        'options' => [
            'class' => 'table-responsive',
            'style'=>'max-width:100%; min-height:100px; overflow: auto; word-wrap: break-word;'
        ],
        'striped' => true,
        'hover' => true,
        'responsiveWrap' => false,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'nipBaru',
           //'idPns',
            'nama',
            //'jenisJabatanId',
            //'jenisJabatan',
            //'jabatanId',
            'jabatanNama',
            //'unorId',
            'unorIndukNama',
            'unorNama',
            //'kedudukanPnsId',
            //'kedudukanPnsNama',
            //'simpeg',
            [
                'attribute' => 'skJabatan',
                'header' => 'Upload SK',
                'format' => 'raw',
                'value' => function($dt){
                    $upj = Html::button('<span class="fas fa-cloud-upload-alt"></span>', ['value' => Url::to(['upload-jab', 'id' => $dt['nipBaru']]), 'title' => 'Upload SK Jabatan/ KP/ Mutasi Terakhir', 'class' => 'showModalButton btn btn-link']);

                    if($dt['skJabatan'] !== null || $dt['skJabatan'] != ''){
                        $prevj = ' '.Html::a('<span class="fas fa-search"></span>', Url::to(['preview-jab', 'id' => $dt['nipBaru']]), ['title' => 'Preview SK', 'class' => 'btn btn-link', 'target' => '_blank']);
                    }else $prevj = '';

                    return $upj.$prevj;
                }
            ],
            // [
            //     'attribute' => 'skKP',
            //     'format' => 'raw',
            //     'value' => function($dt){
            //         $up = Html::button('<span class="fas fa-cloud-upload-alt"></span>', ['value' => Url::to(['upload-kp', 'id' => $dt['nipBaru']]), 'title' => 'Upload SK KP Terakhir', 'class' => 'showModalButton btn-xs btn-danger']);

            //         $prev = ' '.Html::a('<span class="fas fa-search"></span>', Url::to(['preview-kp', 'id' => $dt['nipBaru']]), ['title' => 'Preview SK KP Terakhir', 'class' => 'btn-sm btn-secondary', 'target' => '_blank']);
            //         return $up.$prev;
            //     }
            // ],
            //'updated',
            //'updateBy',
            //'verified',
            //'verifiedBy',
            //'flag',

            // [
            //     'class' => 'kartik\grid\ActionColumn',
            //     'template' => '{update} {delete}',
            //     'buttons' => [
            //         'update' => function ($url) {
            //             return Html::button('<span class="fas fa-pencil-alt"></span>',['value' => Url::to($url), 
            //                 'title' => 'Update', 'class' => 'showModalButton btn btn-link',
            //             ]);
            //         },
            //     ],
            // ],
        ],
    ]); ?>
    <br>
    <div class="card card-outline card-warning">
        <div class="card-header">
            <b>Informasi : </b>    
        </div> <!-- /.card-header -->
        <div class="card-body">
            Bagi pejabat/ pengelola kepegawaian pada perangkat daerah yang telah mendapatkan file data anomali,<br> silahkan melakukan update data dengan cara :
            <ol>
                <li>Entri NIP pada form yang disediakan</li>
                <li>Klik Tombol <b>Search</b> untuk pencarian data atau Klik Tombol <b>Reset</b> untuk membatalkan pencarian data</li>
                <li>Apabila data ditemukan, unggah/ upload file dengan cara klik tombol <b>Upload SK</b> (kolom paling kanan pada tabel)</li>
                <li>Masukkan SK Jabatan/ KP/ Mutasi terakhir pegawai yang bersangkutan (pilih salah satu yang paling terakhir)</li>
                <li>Klik Tombol <b>Simpan</b></li>
                <li>Ketentuan File format <b>PDF</b>, ukuran kurang dari <b>1 MB</b></li>
                <li>Apabila tidak mendapatkan file data anomali yang dikirim via WA, abaikan fitur ini !</li>
            </ol>

        </div><!-- /.card-body -->
    </div><!-- /.card -->

</div>
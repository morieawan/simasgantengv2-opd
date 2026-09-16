<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\bootstrap4\Modal;
use app\models\Angka;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PresHarian */

$this->title = 'ASN UPT '.$namapd.' PENERIMA TPP';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="pres-harian-view">
    
    <?= '<b>PERIODE : '.strtoupper($namabul)." ".$tahun.'</b>' ?>

    <?= Html::a('<i class="fas fa-search"></i> Cari Data', '#', ['title' => 'Cari Data', 'class' => 'btn btn-outline-success float-right mb-1', 'id' => 'search']); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['style' => 'font-size:9pt'],
        'options' => [
            'class' => 'table-responsive',
            'style'=>'max-width:100%; min-height:100px; overflow: auto; word-wrap: break-word;'
        ],
        'showPageSummary' => false,
        'summary' => '',
        'striped' => false,
        'hover' => true,
        'responsiveWrap' => false,
        'columns' => [['headerOptions' => ['width:5%'], 'class' => 'kartik\grid\SerialColumn', 'header' => 'NO'],
            [
                'attribute' => 'id',
                'header' => 'NIP<br>NAMA<br>GOL<br>JABATAN<br>KELAS',
                'headerOptions' => ['width:23%'],
                'format' => 'raw',
                'value' => function($dt){
                    return $dt['nip'].'<br>'.$dt['nama'].'<br>'.$dt['nama_gol'].'<br>'.$dt['nama_jab'].'<br>'.$dt['nama_unor'].'<br>'.$dt['nama_kelas'];
                },
            ],
            [
                'header' => 'PAGU TPP<br>BEBAN KERJA<br>PRESTASI KERJA',
                'format' => 'raw',
                'headerOptions' => ['style' => 'text-align:right; width:12%; '],
                'contentOptions' => ['style' => 'text-align:right;'],
                'value' => function($dt){
                    return Angka::Ribuan($dt['pagu_tpp']).'<br>'.
                          //Angka::Ribuan($dt['beban_kerja']+$dt['produktivitas_kerja']).'<br>'.
                        Angka::Ribuan($dt['beban_kerja']).'<br>'.Angka::Ribuan($dt['produktivitas_kerja']);
                },
            ],
            [
                'header' => 'DISIPLIN<BR>KINERJA<BR>SAKIP',
                'format' => 'raw',
                'headerOptions' => ['style' => 'text-align:right; width:15%;'],
                'contentOptions' => ['style' => 'text-align:right;'],
                'value' => function($dt){
                    return $dt['presensi'].' %, '.Angka::Ribuan($dt['presensi_rp']).'<BR>'.
                        $dt['kinerja'].' %, '.Angka::Ribuan($dt['kinerja_rp']).'<BR>'.
                        Angka::Ribuan($dt['sakip_rp']);
                },
            ],
            [
                'header' => 'HUKDIS<BR>CUTI',
                'format' => 'raw',
                'headerOptions' => ['style' => 'text-align:right; width:5% '],
                'contentOptions' => ['style' => 'text-align:right;'],
                'value' => function($dt){
                    return Angka::Ribuan($dt['hukdis_rp']).'<br>'.Angka::Ribuan($dt['cuti']).'%, '.Angka::Ribuan($dt['cuti_rp']);
                },
            ],
            [
                'header' => 'TPP PEGAWAI<BR>BPJS 4%<BR>JUMLAH KOTOR',
                'format' => 'raw',
                'headerOptions' => ['style' => 'text-align:right; width:10% '],
                'contentOptions' => ['style' => 'text-align:right;'],
                'value' => function($dt){
                    return Angka::Ribuan($dt['tpp_jumlah']).'<br>'.
                            Angka::Ribuan($dt['bpjs4']).'<br>'.
                            Angka::Ribuan($dt['tpp_bruto']);
                },
            ],
            [
                'header' => 'BPJS 4%<BR>BPJS 1%<BR>PPH<BR>JUMLAH POT',
                'format' => 'raw',
                'headerOptions' => ['style' => 'text-align:right; width:10% '],
                'contentOptions' => ['style' => 'text-align:right;'],
                'value' => function($dt){
                    return Angka::Ribuan($dt['bpjs4']).'<br>'.
                    Angka::Ribuan($dt['bpjs1']).'<br>'.
                    Angka::Ribuan($dt['pph_rp']).'<br>'.
                    Angka::Ribuan($dt['pot_jml']);
                    //Angka::Ribuan($dt['tpp_net']).'</b>';
                },
            ],
            [
                'header' => 'TPP DITERIMA<br><br>STATUS',
                'format' => 'raw',
                'headerOptions' => ['width:10%'],
                'contentOptions' => ['style' => 'text-align:right; font-size:12px;'],
                'value' => function($dt){
                    if($dt['status'] == 0) $stat = 'DRAFT'; else $stat = 'FINAL';
                    return '<b>'.Angka::Ribuan($dt['tpp_net'])."<br><br> STATUS $stat</b>";
                },
            ],
        ],
    ]); ?>

</div>

<div id="cari-block" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title">Cari Data</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?= $this->render('_search-tpp', ['model' => $searchModel, 'opd' => $opd]); ?>
            </div>
        </div>
    </div>
</div>

<?php
    Modal::begin([
        'title' => Html::encode($this->title),
        'headerOptions' => ['class' => 'bg-primary'],
        'id' => 'modal',
        'size' => 'modal-lg',
    ]);

    echo "<div id='modalContent'></div>";
    Modal::end();


$script = <<< JS

$('#search').click(function(){
	$("#cari-block").modal('show');
});

$(".konfirmasi").click(function(e) {
    console.log = e;
    e.preventDefault(); // untuk menghentikan href
    e.stopImmediatePropagation();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: 'Setelah Final, data tidak dapat diubah',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya Final',
        customClass: 'swal-wide',
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(href);
        }
    })
});


JS;
$this->registerJs($script);

// $css = <<< CSS
//     .dropdown-item > li > a:hover {
//         background-image: none;
//         background-color: #3085d6;
//     }
// CSS;
// $this->registerCss($css);
?>

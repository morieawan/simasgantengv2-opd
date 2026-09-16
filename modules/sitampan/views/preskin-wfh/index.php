<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\sitampan\models\PreskinWfhSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = "Data ASN Work From Home (WFH)";
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="preskin-wfh-index">
    <h4> Periode : <?= $searchModel['periode']?>    </h4>
    <?= Html::button('<i class="fas fa-search"></i> Cari Data', ['value' => Url::to(array_merge(['search'],Yii::$app->request->queryParams)), 'title' => 'Cari Data', 'class' => 'showModalButton btn btn-primary float-left mb-3']);
    ?>

    <?= Html::button('<i class="fas fa-plus-circle"></i> Tambah', ['value' => Url::to(['create']), 'title' => 'Tambah Data', 'class' => 'showModalButton btn btn-success float-right mb-3']);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'tableOptions' => ['style' => 'font-size:10pt'],
        'responsiveWrap' => false,
        'options' => [
            'class' => 'table-responsive',
            'style'=>'max-width:100%; min-height:100px; overflow: auto; word-wrap: break-word;'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'nip',
                'header' => 'NIP<br>Nama',
                'format' => 'raw',
                'value' => function($dt){
                    return $dt['nip']."<br>".$dt['nama'];
                }
            ],
            [
                'attribute' => 'jab',
                'header' => 'Jabatan<br>Unor',
                'format' => 'raw',
                'value' => function($dt){
                    return $dt['jab']."<br>".$dt['nalok'];
                }
                   
            ],
            [
                'attribute' => 'tgl_list',
                'header' => 'Tgl WFH',
                'format' => 'raw',
                'value' => function ($dt) {
                    if (empty($dt['tgl_list'])) {
                        return null;
                    }

                    $dates = explode(',', $dt['tgl_list']);
                    $buttons = [];

                    foreach ($dates as $tgl) {

                        $label = \app\models\Fungsi::tglkomplit($tgl);

                        $buttons[] = \yii\helpers\Html::a(
                            $label.' <i class="fas fa-times"></i> ',
                            'javascript:void(0)',
                            [
                                'class' => 'btn btn-danger btn-sm btn-delete-tgl mb-1',
                                'data-nip' => $dt['nip'],
                                'data-tgl' => $tgl,
                            ]
                        );
                    }

                    return implode('<br>', $buttons);
                }
            ],
        ],
    ]); ?>

</div>
<script>

$(document).on('click', '.btn-delete-tgl', function () {

    let nip = $(this).data('nip');
    let tgl = $(this).data('tgl');
    let btn = $(this);

    Swal.fire({
        title: 'Yakin?',
        text: 'Data tanggal akan dihapus',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {

            $.post('delete-tgl', {nip: nip, tgl: tgl}, function (res) {
                btn.remove();

                Swal.fire(
                    'Terhapus!',
                    'Data berhasil dihapus.',
                    'success'
                );
            });

        }
    });
});

</script>



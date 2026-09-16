<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use kartik\form\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\kinerja\models\TabPresensi */

$this->title = 'Jadwal Presensi';
$this->params['breadcrumbs'][] = ['label' => 'Presensi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$t = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
$tgl = [];
for($i=1; $i<=$t; $i++) {
    $tgl[$i] = $i;
}

?>

<div class="tab-presensi-form">
    
    <center><h4><b>Jadwal Kerja <?= "$bul $tahun"?></b></h4></center>

    <?php $form = ActiveForm::begin(['id' => 'jadwal-reg']); ?>
    
    <?= $form->field($model, 'nip')->textInput(['id' => 'nip', 'readonly' => true]) ?>
    <?= $form->field($model, 'nama')->textInput(['readonly' => true])->label('Nama') ?>  
    
    <?= $form->field($model, 'jd_masuk')->textInput(['disabled' => true, 'value' => $jk])->label('Hari Kerja') ?>

    <?= '<label class="control-label">Pilih Tanggal Pada Bulan '.$bul.' '.$tahun.'</label>'; ?>
    <?= Select2::widget([
        'name' => 'pilih-tgl',
        'data' => [0 => 'All', '1' => 'Selected'],
        'options' => [
            'selected' => 0,
            'id' => 'pilih-tgl',
        ],
    ]);?>

    <?= $form->field($model, 'tgl')->checkboxButtonGroup($tgl, ['class' => 'btn-group btn-toolbar', 'id' => 'tgl'])
->label(false);?>


    <div class="form-group">
        <?=  Html::submitButton('<i class=\"fas fa-save\"></i> Simpan', [
            'class' => 'btn btn-success jadwal-reset',
            'id' => 'create-jadwal',
            'data-method' => 'post',
        ]) ?>
        <?=  Html::a('<i class=\"fas fa-minus-circle\"></i> Batal',' ', ['class' => 'btn btn-danger', 'data-dismis' => 'modal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

// $urlData = Url::to(['/kinerja/mas-asn/jadwal']);
$script = <<< JS

$(document).ready(function(){
    $("#tgl").hide();
});

$("#pilih-tgl").on("change",function(){
    var pilih = $("#pilih-tgl").val();
    if(pilih == 0) $("#tgl").hide();
    else $("#tgl").show();
});

// $("#jadwal-reg").submit(function(){
//     console.log = e;
//     e.preventDefault(); // untuk menghentikan href
//     e.stopImmediatePropagation();
//     Swal.fire({
//         title: 'Anda akan akan membuat jadwal ini ???',
//         text: 'Jadwal yang sudah ada akan terhapus',
//         icon: 'question',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Oke !',
//         customClass: 'swal-wide',
//     }).then((result) => {
//         if (result.isConfirmed) {
//             return true;
//         }else return false;
//     })
// });

JS;
$this->registerJs($script);
?>

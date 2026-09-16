<?php
use app\modules\bpjs\assets\SvelteAsset; 
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Modul Svelte AdminLTE';

// Registrasikan SvelteAsset khusus di halaman ini saja
SvelteAsset::register($this);
?>

<!-- Bagian ini berada di dalam layout <div class="content-wrapper"> AdminLTE -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= Html::encode($this->title) ?></h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        
        <!-- TARGET MOUNT SVELTE -->
        <div id="svelte-content-root" data-user-id="<?= Yii::$app->user->id ?>">
            <div class="card card-body text-center">
                <p class="text-muted m-0">Memuat komponen Svelte...</p>
            </div>
        </div>

    </div>
</section>
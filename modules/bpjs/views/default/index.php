<?php
use app\modules\bpjs\assets\SvelteAsset;
use yii\helpers\Html;

$this->title = 'Peserta BPJS Keluarga Tambahan';
SvelteAsset::register($this);

$initialRoute = $initialRoute ?? '/peserta';
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <!-- Target Mount Svelte -->
        <div id="svelte-content-root" data-initial-route="<?= Html::encode($initialRoute) ?>"></div>
    </div>
</section>
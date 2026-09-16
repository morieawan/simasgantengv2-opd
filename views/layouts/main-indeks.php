<?php

/** @var yii\web\View $this */
/** @var string $content */

use dominus77\sweetalert2\Alert;
//use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

\app\assets\AppAsset::register($this);

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');


$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
<title><?= Html::encode($this->title).' : '.Yii::$app->name ?></title>
<?php $this->head() ?>
    <style>
        .service-box {
        box-shadow: 0px 0 30px rgba(1, 41, 112, 0.08);
        height: 100%;
        padding: 60px 30px;
        text-align: center;
        transition: 0.3s;
        border-radius: 5px;
        }

        .service-box .icon {
        font-size: 36px;
        padding: 40px 20px;
        border-radius: 4px;
        position: relative;
        margin-bottom: 25px;
        display: inline-block;
        line-height: 0;
        transition: 0.3s;
        }

         .service-box h3 {
        color: #444444;
        font-weight: 700;
        }

         .service-box .read-more {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 16px;
        padding: 8px 20px;
        }

         .service-box .read-more i {
        line-height: 0;
        margin-left: 5px;
        font-size: 18px;
        }

         .service-box.blue {
        border-bottom: 3px solid #2db6fa;
        }

         .service-box.blue .icon {
        color: #2db6fa;
        background: #dbf3fe;
        }

         .service-box.blue .read-more {
        color: #2db6fa;
        }

         .service-box.blue:hover {
        background: #2db6fa;
        }

         .service-box.orange {
        border-bottom: 3px solid #f68c09;
        }

         .service-box.orange .icon {
        color: #f68c09;
        background: #fde3c4;
        }

         .service-box.orange .read-more {
        color: #f68c09;
        }

         .service-box.orange:hover {
        background: #f68c09;
        }

         .service-box.green {
        border-bottom: 3px solid #08da4e;
        }

         .service-box.green .icon {
        color: #08da4e;
        background: #cffddf;
        }

         .service-box.green .read-more {
        color: #08da4e;
        }

         .service-box.green:hover {
        background: #08da4e;
        }

         .service-box.red {
        border-bottom: 3px solid #e9222c;
        }

         .service-box.red .icon {
        color: #e9222c;
        background: #fef7f8;
        }

         .service-box.red .read-more {
        color: #e9222c;
        }

         .service-box.red:hover {
        background: #e9222c;
        }

         .service-box.purple {
        border-bottom: 3px solid #b50edf;
        }

         .service-box.purple .icon {
        color: #b50edf;
        background: #f8e4fd;
        }

         .service-box.purple .read-more {
        color: #b50edf;
        }

         .service-box.purple:hover {
        background: #b50edf;
        }

         .service-box.pink {
        border-bottom: 3px solid #f51f9c;
        }

         .service-box.pink .icon {
        color: #f51f9c;
        background: #feecf7;
        }

         .service-box.pink .read-more {
        color: #f51f9c;
        }

         .service-box.pink:hover {
        background: #f51f9c;
        }

         .service-box:hover h3,
         .service-box:hover p,
         .service-box:hover .read-more {
        color: #fff;
        }

         .service-box:hover .icon {
        background: #fff;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
<?php $this->beginBody(); date_default_timezone_set("Asia/jakarta"); ?>

<header id="header" style="background-color:white;">
    <div class="navbar bg-light" style="background-color:white; background-image: url(<?= Yii::getAlias('@web') ?>/banner-bg-web.png); background-position-x: right;">
        <div class="row">
            <img class="logo_image"	src="<?= Yii::getAlias('@web/banner-red.png') ?>" alt="BKPSDMD Kab. Brebes" height="100">
        </div>
    </div>
    
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-info', 
            'id' => 'navbar-menu',
        ]
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => [
            '<li class="nav-item"><div class="nav-link">'
            . Yii::$app->session['namapengguna'].' - '.Yii::$app->session['nip']
            . '</div></li>'
            . '<li class="nav-item">'
            //. Html::beginForm(['/site/logout'])
            //. Html::beginForm(['#'], 'post', ['id' => 'logout-form'])
            . Html::button(
                '<i class="fas fa-sign-out-alt"></i>',
                ['class' => 'nav-link btn btn-danger logout', 'title' => 'Logout', 'name' => 'logout', 'id' => 'logout-button'],
            )
            //. Html::endForm()
            . '</li>'
        ]
    ]);
    NavBar::end();
    
    ?>
    <div>
</header>

<main id="main" class="flex-shrink-0" role="main">

    <div class="container">
        <?php /*if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif*/ ?>
        <?= Alert::widget(['useSessionFlash' => true]); ?>
        <div class="text">
            &nbsp;
            <?= $content ?>
        </div>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-left text-md-start">BKPSDMD Kabupaten Brebes</div>
            <div class="col-md-6 text-right text-md-end">
                <!-- Menampilkan Jam (Aktif) -->
	            <div id="clock"></div>
            </div>
        </div>
    </div>   
</footer>

<?php

$urlData = Url::to(['/site/sign-out']);
$script = <<< JS

$('#logout-button').click(function () {
    Swal.fire({
        title: 'Apakah anda yakin?',
        icon: 'question',
		text: 'Anda akan keluar aplikasi ini ???',
        showCancelButton: true,
        confirmButtonText: 'Ya, Keluar',
        cancelButtonText: 'Tidak',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        //closeOnConfirm: true,
        //closeOnCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title : 'Terima Kasih',
                text : 'Anda telah menggunakan sistem ini.',
                icon : 'success',
                showConfirmButton : false,
                timer : 1000
            }).then((result) => {
                $.post("{$urlData}");
            });
        } 
    });
        
});

JS;
$this->registerJs($script);
?>

<script type="text/javascript">
    function showTime() {
        var today = new Date();
        var curr_hour = today.getHours();
        var curr_minute = today.getMinutes();
        var curr_second = today.getSeconds();
        
        curr_hour = checkTime(curr_hour);
        curr_minute = checkTime(curr_minute);
        curr_second = checkTime(curr_second);
        document.getElementById('clock').innerHTML=thisDay + ', ' + day + ' ' + months[month] + ' ' + year + ' ' 
        + curr_hour + ":" + curr_minute + ":" + curr_second;
        }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    setInterval(showTime, 500);
    //-->

    // Menampilkan Hari, Bulan dan Tahun
    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth();
    var thisDay = date.getDay(),
        thisDay = myDays[thisDay];
    var yy = date.getYear();
    var year = (yy < 1000) ? yy + 1900 : yy;
    //document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
    //-->
</script>

<script>
    window.onscroll = function() {myFunction()};
    var navbar = document.getElementById("navbar-menu");
    var sticky = navbar.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("fixed-top")
        } else {
            navbar.classList.remove("fixed-top");
        }
    }
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
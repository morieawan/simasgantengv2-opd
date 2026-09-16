<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\gen;

use yii\web\AssetBundle;

/**
 * This declares the asset files required by Gii.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GiiAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/gen/assets';
    public $css = [
        'css/main.css',
        //'css/adminlte.min.css'
    ];
    public $js = [
        'js/bs4-native.min.js',
        //'js/adminlte.min.js',
        'js/gii.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset'
    ];
}

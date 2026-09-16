<?php

namespace app\modules\bpjs\assets; // Sesuaikan namespace modul Anda

use yii\web\AssetBundle;
use Yii;

class SvelteAsset extends AssetBundle
{
    public $basePath = '@webroot/dist/modules/bpjs';
    public $baseUrl = '@web/dist/modules/bpjs';

    public function init()
    {
        parent::init();

        // Cek apakah server Vite sedang berjalan (Mode Dev / HMR)
        $isDevMode = YII_ENV_DEV && $this->isViteDevServerRunning('127.0.0.1', 3000);

        if ($isDevMode) {
            // Dalam mode Dev, panggil script Vite Dev Server
            $this->js = [
                'http://127.0.0.1:5000/@vite/client',
                'http://127.0.0.1:5000/src/main.ts',
            ];
            $this->jsOptions = ['type' => 'module'];
        } else {
            // Dalam mode Production, baca manifest.json hasil 'npm run build'
            $manifestPath = Yii::getAlias($this->basePath . '/.vite/manifest.json');
            if (file_exists($manifestPath)) {
                $manifest = json_decode(file_get_contents($manifestPath), true);
                if (isset($manifest['src/main.ts'])) {
                    $this->js = [$manifest['src/main.ts']['file']];
                    if (!empty($manifest['src/main.ts']['css'])) {
                        $this->css = $manifest['src/main.ts']['css'];
                    }
                }
            }
        }
    }

    private function isViteDevServerRunning($host, $port)
    {
        $connection = @fsockopen($host, $port, $errno, $errstr, 0.2);
        if (is_resource($connection)) {
            fclose($connection);
            return true;
        }
        return false;
    }
}
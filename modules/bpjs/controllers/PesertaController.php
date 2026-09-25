<?php

namespace app\modules\bpjs\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\httpclient\Client;

class PesertaController extends Controller
{
    private $apiBaseUrl = 'http://localhost:9090/v1';

    /**
     * Main SPA Shell (Disajikan 1x saat pertama membuka halaman)
     */
    public function actionIndex()
    {
        
        $sess = [
            'tablok' => Yii::$app->session->get('tablok', ''),
            'nip' => Yii::$app->session->get('nip'),
            'namapengguna' => Yii::$app->session->get('namapengguna'),
        ];

        return $this->render('index', [
            'sess' => $sess,
        ]);
    }

    // ==========================================
    // PARTIAL VIEW LOADERS (SPA TABS)
    // ==========================================

    public function actionTabSearch()
    {
        
        $sess = [
            'tablok' => Yii::$app->session->get('tablok', ''),
        ];
        return $this->renderPartial('_tab_search', ['sess' => $sess]);
    }

    public function actionTabPeserta()
    {
        return $this->renderPartial('_tab_peserta');
    }

    public function actionTabIuran()
    {
        return $this->renderPartial('_tab_iuran');
    }

    // ==========================================
    // BFF ACTION (FORWARD REQUEST TO GO BACKEND)
    // ==========================================

    public function actionSearchPegawai()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $keyword    = $request->get('keyword');
        $subLokasi  = $request->get('sub_lokasi');
        $kodeLokasi = $request->get('kode_lokasi', '');

        // Buat URL lengkap beserta Query Params
        $queryParams = http_build_query([
            'kode_lokasi' => $kodeLokasi,
            'keyword'     => $keyword,
            'sub_lokasi'  => $subLokasi,
        ]);

        // Gunakan 127.0.0.1 untuk menghindari isu IP resolution IPv6 (::1) pada Windows
        $fullUrl = 'http://localhost:9090/v1/pegawai/search?' . $queryParams;

        try {
            $client = new Client([
                'transport' => 'yii\httpclient\CurlTransport' // Pakai cURL transport agar lebih stabil
            ]);
            
            $response = $client->createRequest()
                ->setMethod('GET')
                ->setUrl($fullUrl)
                ->send();

            if ($response->isOk) {
                return $response->data;
            }

            // Jika Go Backend merespons selain status HTTP 200 (misal 400/500)
            return [
                'status'  => 'error',
                'message' => $response->data['message'] ?? 'Response error dari Go Backend.',
            ];

        } catch (\Exception $e) {
            // Catat pesan error asli PHP/cURL ke runtime/logs/app.log
            Yii::error('BFF Error [SearchPegawai]: ' . $e->getMessage(), __METHOD__);
            
            return [
                'status'  => 'error',
                'message' => 'Detail Error: ' . $e->getMessage(), // Tampilkan pesan error asli untuk debugging
            ];
        }
    }

    public function actionGetData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $nip = Yii::$app->request->get('nip');

        if (empty($nip)) {
            return [
                'status' => 'error',
                'message' => 'NIP Pegawai wajib diisi.',
            ];
        }

        try {
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('GET')
                ->setUrl($this->apiBaseUrl . '/bpjs/peserta')
                ->setData(['nip' => $nip])
                ->addHeaders([
                    'Authorization' => 'Bearer ' . Yii::$app->session->get('token'),
                ])
                ->send();

            if ($response->isOk) {
                return $response->data;
            }

            return [
                'status' => 'error',
                'message' => 'Gagal mengambil data BPJS.',
            ];

        } catch (\Exception $e) {
            Yii::error('BFF Error [GetDataBPJS]: ' . $e->getMessage(), __METHOD__);
            return [
                'status' => 'error',
                'message' => 'Gagal terhubung ke layanan BPJS.',
            ];
        }
    }

    /**
     * Action Render Modal Form Tambah Peserta
     */
    public function actionCreate()
    {
        $nip = Yii::$app->request->get('nip');

        // Minta data template/default dari API jika diperlukan
        $model = (object) [
            'id_peserta' => null,
            'nip' => $nip,
            'nama_peserta' => '',
            'hubkel' => '',
            'nik' => '',
            'no_kk' => '',
            'opd' => '',
            'tgl_lahir' => '',
            'jk' => '1',
            'aktif' => '1',
            'alamat' => '',
            'kd_prov' => '',
            'kd_kab' => '',
            'kd_kec' => '',
            'kd_desa' => '',
        ];

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }

        return $this->render('_form', [
            'model' => $model,
        ]);
    }

    /**
     * BFF Action: Simpan Data Peserta (Forward POST ke Microservice)
     */
    public function actionSave()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $postData = Yii::$app->request->post('PesertaForm', []);

        try {
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl($this->apiBaseUrl . '/bpjs/peserta/store')
                ->setData($postData)
                ->addHeaders([
                    'Authorization' => 'Bearer ' . Yii::$app->session->get('token'),
                ])
                ->send();

            if ($response->isOk) {
                return $response->data;
            }

            return [
                'status' => 'error',
                'errors' => $response->data['errors'] ?? 'Gagal menyimpan data.',
            ];

        } catch (\Exception $e) {
            Yii::error('BFF Error [SaveBPJS]: ' . $e->getMessage(), __METHOD__);
            return [
                'status' => 'error',
                'message' => 'Terjadi kesalahan sistem saat menyimpan data.',
            ];
        }
    }
}
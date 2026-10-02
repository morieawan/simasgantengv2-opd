<?php

namespace app\modules\bpjs\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\httpclient\Client;
use yii\helpers\Json;

use app\modules\bpjs\models\PesertaForm;


class PesertaController extends Controller
{
    private $apiBaseUrl = 'http://localhost:9090/v1';

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'get-wilayah' => ['GET'],
                    'get-hubkel'  => ['GET'], // Tambahkan pembatasan verb untuk Hubkel
                ],
            ],
        ]);
    }

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

    /**
     * Partial View Loader untuk Tab Peserta
     */
    public function actionTabPeserta()
    {
        $sess = Yii::$app->session;
        $nip = Yii::$app->request->get('nip') ?? '';
        $nama = Yii::$app->request->get('nama') ?? '';
        
        $pesertaUtama = [];
        $pesertaTambahan = [];
        $pegawai = [
            'nip' => $nip,
            'nama' => $nama,
        ];

        if ($nip) {
            $client = new Client(['baseUrl' => $this->apiBaseUrl]); 

            // 1. Ambil Data Peserta Utama (Simgaji - DB5)
            try {
                $responseUtama = $client->get('/simgaji/keluarga', ['nip' => $nip])->send();
                if ($responseUtama->isOk) {
                    $pesertaUtama = $responseUtama->data['data'] ?? [];
                }
            } catch (\Exception $e) {
                Yii::error("Gagal mengambil data peserta utama: " . $e->getMessage());
            }

            // 2. Ambil Data Peserta BPJS Tambahan (DB21)
            try {
                $responseTambahan = $client->get('/bpjs/peserta', ['nip' => $nip])->send();
                if ($responseTambahan->isOk) {
                    $pesertaTambahan = $responseTambahan->data['data'] ?? [];
                }
            } catch (\Exception $e) {
                Yii::error("Gagal mengambil data peserta tambahan: " . $e->getMessage());
            }
        }

        return $this->renderPartial('_tab_peserta', [
            'pegawai' => $pegawai,
            'pesertaUtama' => $pesertaUtama,
            'pesertaTambahan' => $pesertaTambahan,
        ]);
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
        $kodeLokasi = Yii::$app->session->get('tablok', '');

        // Buat URL lengkap beserta Query Params
        $queryParams = http_build_query([
            'kode_lokasi' => $kodeLokasi,
            'keyword'     => $keyword,
            'sub_lokasi'  => $subLokasi,
        ]);

        // Gunakan 127.0.0.1 untuk menghindari isu IP resolution IPv6 (::1) pada Windows
        $fullUrl = $this->apiBaseUrl.'/pegawai/search?' . $queryParams;
        // return $fullUrl;

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
            return $this->renderAjax('_tab_form_peserta', [
                'model' => $model,
            ]);
        }

        return $this->render('_tab_form_peserta', [
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

    public function actionGetWilayah($parent = '')
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        // Ambil parameter parent jika dipanggil oleh DepDrop (biasanya dikirim via POST/GET depdrop_parents)
        $request = Yii::$app->request;
        $parents = $request->post('depdrop_parents');
        
        if (!empty($parents)) {
            $parent = $parents[0];
        }

        try {
            $client = new \yii\httpclient\Client(['baseUrl' => $this->apiBaseUrl]);
            $response = $client->get('/bpjs/wilayah', ['parent' => $parent])->send();

            if ($response->isOk && !empty($response->data['data'])) {
                $out = [];
                foreach ($response->data['data'] as $item) {
                    $out[] = [
                        'id'   => $item['kode'],
                        'name' => $item['nama'],
                    ];
                }
                return ['output' => $out, 'selected' => ''];
            }

            return ['output' => [], 'selected' => ''];
        } catch (\Exception $e) {
            return ['output' => [], 'selected' => ''];
        }
    }

    public function actionGetHubkel()
    {
        $request = Yii::$app->request;

        if (!$request->isAjax) {
            throw new BadRequestHttpException('Request tidak valid.');
        }

        // Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $client = new Client(['baseUrl' => $this->apiBaseUrl]);
            $response = $client->get('/simgaji/hubkel')->send();

            if ($response->isOk) {
                return $response->data['data'];
            }

            return [
                'status'  => false,
                'message' => $response->data['message'] ?? 'Gagal mengambil data hubkel',
                'data'    => []
            ];
        } catch (\Exception $e) {
            return [
                'status'  => false,
                'message' => $e->getMessage(),
                'data'    => []
            ];
        }
    }

    public function actionTabFormPeserta()
    {
        // if (Yii::$app->request->isAjax) {
            $model = new PesertaForm(); 

            $gethubkel = $this->actionGetHubkel();
            $hubkel = $gethubkel['data'];

            return $this->renderAjax('_tab_form_peserta', [
                'hubkel' => $hubkel,
                'model' => $model,
            ]);
        // }

        throw new \yii\web\BadRequestHttpException('Request tidak valid.');
    }
}
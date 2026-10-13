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
use yii\helpers\ArrayHelper;

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
                    'get-wilayah' => ['POST'],
                    'save-peserta' => ['POST'],
                    'del-peserta' => ['POST'],
                    'get-provinsi' => ['GET'],
                    'get-hubkel'  => ['GET'], 
                ],
            ],
        ]);
    }

    public function beforeAction($action)
    {
        if ($action->id === 'get-wilayah' || $action->id === 'save-peserta') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
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
        if (!Yii::$app->request->isAjax) 
            throw new \yii\web\BadRequestHttpException('Request tidak valid.');

        $sess = [
            'tablok' => Yii::$app->session->get('tablok', ''),
        ];
        return $this->renderAjax('_tab_search', ['sess' => $sess]);
    }

    /**
     * Partial View Loader untuk Tab Peserta
     */
    public function actionTabPeserta()
    {
        // if (!Yii::$app->request->isAjax) 
        //     throw new \yii\web\BadRequestHttpException('Request tidak valid.');
        
        $sess = Yii::$app->session;
        $nip = Yii::$app->request->get('nip') ?? '';
        $nama = Yii::$app->request->get('nama') ?? '';
        
        $pesertaUtama = [];
        $pesertaTambahan = [];
        $pegawai = [
            'nip' => $nip,
            'nama' => $nama,
        ];

        $sess['peserta-nip'] = $nip;
        $sess['peserta-nama'] = $nama;

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

            //get hubkel
            $gethubkel = $this->actionGetHubkel();
            $hubkel = $gethubkel['data'];

            // 2. Ambil Data Peserta BPJS Tambahan (DB21)
            try {
                $responseTambahan = $client->get('/bpjs/peserta', ['nip' => $nip])->send();
                if ($responseTambahan->isOk) {
                    $pesertaTambahan = $responseTambahan->data['data'] ?? [];

                    $hubkelMap = ArrayHelper::map( $hubkel, 'kd_hubkel', 'nm_hubkel' ); 
                    foreach ($pesertaTambahan as &$item) { 
                        $item['nama_hubkel'] = $hubkelMap[$item['hubkel']] ?? '-'; 
                    } unset($item);
                }
            } catch (\Exception $e) {
                Yii::error("Gagal mengambil data peserta tambahan: " . $e->getMessage());
            }
        }

        return $this->renderAjax('_tab_peserta', [
            'pegawai' => $pegawai,
            'pesertaUtama' => $pesertaUtama,
            'pesertaTambahan' => $pesertaTambahan,
        ]);
    }

    public function actionTabIuran()
    {
        if (!Yii::$app->request->isAjax) 
            throw new \yii\web\BadRequestHttpException('Request tidak valid.');
        
        return $this->renderAjax('_tab_iuran');
    }

    // ==========================================
    // BFF ACTION (FORWARD REQUEST TO GO BACKEND)
    // ==========================================

    public function actionSearchPegawai()
    {
        if (!Yii::$app->request->isAjax) 
            throw new \yii\web\BadRequestHttpException('Request tidak valid.');
        
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
            'action'      => 'bpjstambahan',
        ]);

        $fullUrl = $this->apiBaseUrl.'/pegawai/search?' . $queryParams;

        try {
            $client = new Client([
                'transport' => 'yii\httpclient\CurlTransport' 
            ]);
            
            $response = $client->createRequest()
                ->setMethod('GET')
                ->setUrl($fullUrl)
                ->send();

            if ($response->isOk) {
                return $response->data;
            }

            return [
                'status'  => 'error',
                'message' => $response->data['message'] ?? 'Response error dari Go Backend.',
            ];

        } catch (\Exception $e) {
            Yii::error('BFF Error [SearchPegawai]: ' . $e->getMessage(), __METHOD__);
            
            return [
                'status'  => 'error',
                'message' => 'Detail Error: ' . $e->getMessage(), 
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

    public function actionSavePeserta()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $request = Yii::$app->request;

        $model = new PesertaForm();
        $model->id_peserta = '';
        $model->no_kk = '';
        $model->opd = Yii::$app->session->get('tablokb');
        $model->sumber_pembiayaan = '1-2';

        // 1. Load data dari request POST
        if ($model->load($request->post())) {
            
            // 2. Validasi inputan di level BFF (Frontend Contract Validation)
            if (!$model->validate()) {
                return [
                    'success' => false,
                    'message' => 'Validasi data gagal, mohon periksa inputan Anda.',
                    'errors'  => $model->getErrors()
                ];
            }

            if (!empty($model->tgl_lahir)) {
                $date = \DateTime::createFromFormat('d-m-Y', $model->tgl_lahir);

                if ($date !== false) {
                    $model->tgl_lahir = $date->format('Y-m-d');
                }
            }

            $model->jk = (int)$model->jk;
            $model->aktif = (int)$model->aktif;

            // return $model->attributes;
            // 3. Forward Data ke Backend Service / API BPJS (Core BFF Task)
            try {
                $client = new Client(['baseUrl' => $this->apiBaseUrl]); 
                
                $response = $client
                    ->post('/bpjs/peserta/simpan')
                    ->setFormat(\yii\httpclient\Client::FORMAT_JSON)
                    ->setData($model->attributes)
                    // ->addHeaders([
                    //     'Authorization' => 'Bearer ' . Yii::$app->session->get('token')
                    // ])
                    ->send();

                // 4. Transformasi Respon Backend untuk Client Frontend SPA
                if (
                    $response->isOk &&
                    isset($response->data['status']) &&
                    $response->data['status'] === true
                ) {
                    return [
                        'success' => true,
                        'message' => $response->data['data']['message']
                            ?? 'Data peserta berhasil disimpan.',
                        'data' => $response->data['data']['data'] ?? null,
                        'redirectUrl' => \yii\helpers\Url::to(['/bpjs/peserta/index'])
                    ];
                }

                return [
                    'success' => false,
                    'message' => $response->data['message']
                        ?? $response->data['data']['message']
                        ?? 'Gagal menyimpan data ke server BPJS.',
                    'errors' => $response->data['errors'] ?? []
                ];

            } catch (\Exception $e) {
                // Logging error untuk penanganan internal
                Yii::error('BFF Save Peserta Error: ' . $e->getMessage(), __METHOD__);

                return [
                    'success' => false,
                    'message' => 'Terjadi gangguan komunikasi dengan server backend/API.'
                ];
            }
        }

        return [
            'success' => false,
            'message' => 'Data tidak ditemukan atau struktur payload tidak sesuai.'
        ];
    }

    public function actionGetProvinsi($parent = '')
    {
        // if (!Yii::$app->request->isAjax) 
        //     throw new \yii\web\BadRequestHttpException('Request tidak valid.');
        
        $request = Yii::$app->request;
        $parent = $request->get('parent', '');

        // Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $client = new \yii\httpclient\Client(['baseUrl' => $this->apiBaseUrl]);
            $response = $client->get('/bpjs/wilayah', ['parent' => $parent])->send();

            if ($response->isOk) {
                return $response->data['data'];
            }

            return [
                'status'  => false,
                'message' => $response->data['message'] ?? 'Gagal mengambil data provinsi',
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

    public function actionGetHubkel()
    {
        // if (!Yii::$app->request->isAjax) 
        //     throw new \yii\web\BadRequestHttpException('Request tidak valid.');
        
        $request = Yii::$app->request;

        // Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $client = new Client(['baseUrl' => $this->apiBaseUrl]);
            $response = $client->get('/simgaji/hubkel')->send();

            if ($response->isOk) {
                $response = $response->data['data'];
                $kode_dihapus = ["00", "10", "11", "12", "13"];

                $data_tersaring = array_filter($response['data'], function($item) use ($kode_dihapus) {
                    return !in_array($item['kd_hubkel'], $kode_dihapus);
                });

                $response['data'] = array_values($data_tersaring);
                return $response;
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
        // if (!Yii::$app->request->isAjax) 
        //     throw new \yii\web\BadRequestHttpException('Request tidak valid.');
       
        $sess = Yii::$app->session;

        $idPeserta = Yii::$app->request->get('id');
        if ($idPeserta) {
            $cek = $this->actionGetDetail($idPeserta);

            if ($cek['status'] != 'success') {
                throw new \yii\web\NotFoundHttpException('Data peserta tidak ditemukan.');
            }

            $model = new PesertaForm();
            $model->setAttributes($cek['data'], false);

        } else {
            $model = new PesertaForm();
            $model->nip = $sess['peserta-nip'] ?? '';
        }

        $getprov = $this->actionGetProvinsi();
        $prov = $getprov['data'];

        $kab = [];
        if (!empty($model->provinsi)) {
            $kab = $this->actionGetDataWilayah($model->provinsi)['data'];
        }

        // Data kecamatan berdasarkan kabupaten terpilih
        $kec = [];
        if (!empty($model->kabupaten)) {
            $kec = $this->actionGetDataWilayah($model->kabupaten)['data'];
        }

        // Data kelurahan berdasarkan kecamatan terpilih
        $desa = [];
        if (!empty($model->kecamatan)) {
            $desa = $this->actionGetDataWilayah($model->kecamatan)['data'];
        }

        $gethubkel = $this->actionGetHubkel();
        $hubkel = $gethubkel['data'];
        $dataHubkel = [];
        foreach ($hubkel as $item) {
            $dataHubkel[$item['kd_hubkel']] = $item['kd_hubkel'] . ': ' . $item['nm_hubkel'];
        }

        return $this->renderAjax('_tab_form_peserta', [
            'hubkel' => $dataHubkel,
            'prov' => $prov,
            'kab' => $kab,
            'kec' => $kec,
            'desa' => $desa, 
            'model' => $model,
        ]);

    }

    public function actionGetDataWilayah($parent = '')
    {
        try {
            $client = new Client([
                'baseUrl' => $this->apiBaseUrl,
            ]);

            $response = $client->get('/bpjs/wilayah', [
                'parent' => $parent,
            ])->send();

            if ($response->isOk) {
                return $response->data['data'] ?? [];
            }

            return [];
        } catch (\Exception $e) {
            Yii::error(
                'Gagal mengambil data wilayah: ' . $e->getMessage(),
                __METHOD__
            );

            return [];
        }
    }
    
    public function actionGetWilayah()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $parents = Yii::$app->request->post('depdrop_parents', []);

        if (empty($parents) || empty($parents[0])) {
            return [
                'output' => [],
                'selected' => '',
            ];
        }

        $parentId = $parents[0];

        $get = $this->actionGetDataWilayah($parentId);

        // Ambil daftar wilayah dari pembungkus respons API
        $output = $get['data'] ?? [];

        return [
            'output' => is_array($output) ? $output : [],
            'selected' => '',
        ];
    }

    public function actionGetGabunganGajiTpp()
    {
        // if (!Yii::$app->request->isAjax) 
        //     throw new \yii\web\BadRequestHttpException('Request tidak valid.');
        
        Yii::$app->response->format = Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $nip    = $request->get('nip');

        $fullUrl = $this->apiBaseUrl.'/pegawai-gabungan/cek?nip=' . $nip;

        try {
            $client = new Client([
                'transport' => 'yii\httpclient\CurlTransport' 
            ]);
            
            $response = $client->createRequest()
                ->setMethod('GET')
                ->setUrl($fullUrl)
                ->send();

            if ($response->isOk) {
                return $response->data;
            }

            return [
                'status'  => 'error',
                'message' => $response->data['message'] ?? 'Response error dari Go Backend.',
            ];

        } catch (\Exception $e) {
            Yii::error('BFF Error [SearchPegawai]: ' . $e->getMessage(), __METHOD__);
            
            return [
                'status'  => 'error',
                'message' => 'Detail Error: ' . $e->getMessage(), 
            ];
        }
    }

    public function actionGetPeserta($nip)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (empty($nip)) {
            return [
                'status' => 'error',
                'message' => 'Tidak ada data yang dipilih.',
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

                return [
                    'status' => 'success',
                    'data' => $response->data['data'],
                ];
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

    public function actionGetDetail($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (empty($id)) {
            return [
                'status' => 'error',
                'message' => 'Tidak ada data yang dipilih.',
            ];
        }

        try {
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('GET')
                ->setUrl($this->apiBaseUrl . '/bpjs/peserta/' . $id)
                ->addHeaders([
                    'Authorization' => 'Bearer ' . Yii::$app->session->get('token'),
                ])
                ->send();

            if ($response->isOk) {

                return [
                    'status' => 'success',
                    'data' => $response->data['data'],
                ];
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

    public function actionDelPeserta()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');

        if (empty($id)) {
            return [
                'status' => 'error',
                'message' => 'Tidak ada data yang dipilih.',
            ];
        }

        try {
            $client = new Client();

            $response = $client->createRequest()
                ->setMethod('DELETE')
                ->setUrl($this->apiBaseUrl . '/bpjs/peserta/' . rawurlencode((string) $id))
                ->addHeaders([
                    // 'Authorization' => 'Bearer ' . Yii::$app->session->get('token'),
                    'Accept' => 'application/json',
                ])
                // ->setFormat(Client::FORMAT_JSON)
                // ->setResponseFormat(Client::FORMAT_JSON)
                ->send();

            if ($response->isOk) {
                return [
                    'status' => 'success',
                    'message' => $response->data['data']['message']
                        ?? 'Data peserta berhasil dihapus.',
                    'data' => $response->data['data'] ?? null,
                ];
            }

            Yii::error(
                'Delete peserta HTTP ' . $response->statusCode
                . ': ' . $response->content,
                __METHOD__
            );

            return [
                'status' => 'error',
                'message' => $response->data['message']
                    ?? 'Gagal menghapus data peserta.',
            ];
        // } catch (\Throwable $e) {
        //     Yii::error(
        //         'BFF Error [Del Peserta]: ' . $e->getMessage(),
        //         __METHOD__
        //     );

        //     return [
        //         'status' => 'error',
        //         'message' => 'Gagal terhubung ke layanan peserta.',
        //     ];
        // }
        } catch (\Throwable $e) {
            Yii::error(
                'BFF Error [Del Peserta]: '
                . get_class($e)
                . ' - '
                . $e->getMessage()
                . "\n"
                . $e->getTraceAsString(),
                __METHOD__
            );

            return [
                'status' => 'error',
                'message' => 'Gagal terhubung ke layanan peserta.',
            ];
        }
    }
}
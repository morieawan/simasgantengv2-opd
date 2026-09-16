<?php
namespace app\modules\bpjs\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class PesertaController extends Controller
{
    public function actionIndex()
    {
        return $this->render('@app/modules/bpjs/views/default/index', [
            'initialRoute' => '/bpjs-peserta'
        ]);
    }

    public function actionGetData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return [
            'status' => 'success',
            'data' => [
                ['id' => 1, 'bulan' => 'Januari 2026', 'total' => 5000000],
                ['id' => 2, 'bulan' => 'Februari 2026', 'total' => 7500000],
            ]
        ];
    }

    public function actionView($id)
    {
        return ['status' => 'success', 'data' => ['id' => $id]];
    }

    // CREATE
    public function actionCreate()
    {
        $payload = Yii::$app->request->getBodyParams();
        return ['status' => 'success', 'message' => 'Data berhasil ditambah'];
    }

    public function actionUpdate($id)
    {
        $payload = Yii::$app->request->getBodyParams();
        return ['status' => 'success', 'message' => 'Data berhasil diubah'];
    }

    public function actionDelete($id)
    {
        fetch(`/bpjs-peserta/delete?id=${id}`);
        // return ['status' => 'success', 'message' => 'Data berhasil dihapus'];
    }
}
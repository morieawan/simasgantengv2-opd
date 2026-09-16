<?php
namespace app\modules\bpjs\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class IuranController extends Controller
{
    public function actionIndex()
    {
        return $this->render('@app/modules/bpjs/views/default/index', [
            'initialRoute' => '/bpjs-iuran',
        ]);
    }

    public function actionGetData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'status' => 'success',
            'data' => [
                ['id' => 1, 'bulan' => 'Januari', 'total' => 1000],
                ['id' => 2, 'bulan' => 'Februari', 'total' => 1500],
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
        return ['status' => 'success', 'message' => 'Data berhasil dihapus'];
    }
}
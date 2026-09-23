<?php
namespace app\modules\bpjs\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class PesertaController extends Controller
{
    // 1. Render Tampilan Utama Peserta (Tabel + Form Modal)
    public function actionIndex()
    {
        $sess = Yii::$app->session;
        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('index', ['sess' => $sess]);
        }
        return $this->redirect(['/bpjs/default/index']);
    }

    // 2. READ: Ambil Data Peserta (Format JSON)
    public function actionGetData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        // Contoh data dummy (Bisa diganti dengan query ActiveRecord: Peserta::find()->all())
        return [
            'status' => 'success',
            'data' => [
                ['id' => 1, 'nama' => 'Ahmad', 'no_bpjs' => '00012345678', 'kategori' => 'Mandiri'],
                ['id' => 2, 'nama' => 'Budi', 'no_bpjs' => '00087654321', 'kategori' => 'PNS'],
            ]
        ];
    }

    // 3. CREATE / UPDATE: Simpan Data via AJAX
    public function actionSave()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;

        $id = $request->post('id');
        $nama = $request->post('nama');
        $noBpjs = $request->post('no_bpjs');

        // Validation & Save logic ke Database di sini...
        // $model = $id ? Peserta::findOne($id) : new Peserta();
        // $model->load($request->post(), '');
        // if ($model->save()) { ... }

        return [
            'status' => 'success',
            'message' => $id ? 'Data berhasil diperbarui!' : 'Data berhasil ditambahkan!'
        ];
    }

    // 4. DELETE: Hapus Data via AJAX
    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Logic Hapus...
        // Peserta::findOne($id)->delete();

        return [
            'status' => 'success',
            'message' => "Data peserta ID $id berhasil dihapus!"
        ];
    }
}
<?php

namespace app\modules\simpeg\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use yii\web\Session;
use yii\data\ArrayDataProvider;
use yii\base\InvalidParamException;
use yii\helpers\Json;
use yii\helpers\Url;

use app\models\Fungsi;
use app\modules\simpeg\models\EpsMastfip;
use app\models\Tbllog;

/**
 * Default controller for the `simpeg` module
 */
class MastfipController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new EpsMastfip();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('position', [
                'icon' => \dominus77\sweetalert2\Alert::TYPE_SUCCESS, 
                'title' => 'Data berhasil disimpan',
                'showConfirmButton' => false,
                'timer' => 2000
            ]); 

            return $this->redirect(Url::previous());
        }

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model
            ]);
        }else{
            return $this->render('create', [
                'model' => $model
            ]);
        } 
    }
}

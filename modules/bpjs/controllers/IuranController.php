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

use app\modules\bpjs\models\IuranForm;

class IuranController extends Controller
{
    public function actionIndex()
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('index');
        }

        return $this->redirect(['/bpjs/default/index']);
    }
}
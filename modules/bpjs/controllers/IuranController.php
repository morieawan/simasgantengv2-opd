<?php

namespace app\modules\bpjs\controllers;

use Yii;
use yii\web\Controller;

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
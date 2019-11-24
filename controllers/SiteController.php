<?php

namespace app\controllers;

use app\components\DebtInformation;
use Yii;
use yii\web\Controller;
use app\models\GetInfoForm;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $getInfoFormModel = new GetInfoForm();
        $debtInformationModel = new \app\models\DebtInformation();
        if (\Yii::$app->request->isAjax && $getInfoFormModel->load(Yii::$app->request->post())) {
            $debtInformation = new DebtInformation();
            return json_encode($debtInformation->getInformation($getInfoFormModel->inn), true);
        }
        return $this->render('index', ['getInfoFormModel' => $getInfoFormModel, 'debtInformationModel' => $debtInformationModel]);
    }

    /**
     * Сохранение полученной информации
     *
     * @return \yii\web\Response
     */
    public function actionSave()
    {
        $model = new \app\models\DebtInformation();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

}

<?php

namespace app\controllers\admin;

use Yii;
use yii\filters\AccessControl;
use app\controllers\admin\base\AdminController;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class DashboardController extends AdminController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}

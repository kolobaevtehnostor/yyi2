<?php

namespace app\controllers\admin;

use Yii;
use yii\filters\AccessControl;
use app\components\AdminController;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class DashboardController extends AdminController
{
    public function actionIndex()
    {
        return 'admin';
    }
}

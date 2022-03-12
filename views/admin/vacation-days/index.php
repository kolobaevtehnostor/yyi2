<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\VacationDays;

/* @var $this yii\web\View */
/* @var $searchModel  */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vacation Days';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacation-days-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Vacation Days', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'data_start',
            'data_end',
            'status',
            //'update_at',
            //'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, VacationDays $model, $key, $index, $column) {
                  //  dd($action);
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

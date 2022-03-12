<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VacationDays */

$this->title = 'Create Vacation Days';
$this->params['breadcrumbs'][] = ['label' => 'Vacation Days', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacation-days-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

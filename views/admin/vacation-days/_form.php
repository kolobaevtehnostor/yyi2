<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\VacationDays */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacation-days-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'data_start')->widget(DatePicker::classname(), [       
        'options' => [
            'class' => 'form-control' . ($model->hasErrors('data_start') ? ' is-invalid' : ''),
        ],
        'language' => 'ru',
        'dateFormat' => 'dd.M.yyyy',

    ]) ?>


    <?= $form->field($model, 'data_end')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'update_at')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

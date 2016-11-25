<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Candidato */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="candidato-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'partido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'perfil')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Preview', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

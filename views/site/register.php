<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var \app\models\RegisterForm $model */
/** @var array $bairros */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'dataNascimento')->widget(\yii\widgets\MaskedInput::class,[
            'mask' => '99/99/9999'
        ]) ?>
        <?= $form->field($model, 'idBairro')->dropDownList($bairros) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'repeatPassword')->passwordInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-register -->

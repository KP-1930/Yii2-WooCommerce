<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\models\User;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-9">
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p style="color:blue">Please fill out the following fields to Register:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'email') ?>

        <?= $form->field($model, 'gender')->radioList(['male' => 'Male', 'female' => 'Female','other' => 'Other'])->label('Gender'); ?>  

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput(); ?>

        <?= $form->field($model, 'confirm_password')->passwordInput(); ?>

        <?=  $form->field($model, 'role')->dropDownList(['admin' => 'Admin', 'user' => 'User'],['prompt'=>'Select Option']); ?>


        <div class="form-group">
            <div class="col-lg-3">
                 <a href="index" class="btn btn-danger">Cancel</a>
            </div>
            <div class="col-lg-3">
                <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'register']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
</div>

<div class="col-lg-3">
<img src="../uploads/registration.jpg" height="300" width="300">
</div>

<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-9">
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p style="color:blue">Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <div class="col-lg-3">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            <div class="col-lg-3">
                 <a href="index" class="btn btn-danger">Cancel</a>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-3">
                <a href="forgot-password">Forgot Password</a>
            </div>
        </div> 

        

    <?php ActiveForm::end(); ?>

    
</div>
</div>


<div class="col-lg-3">
<img src="../uploads/login.png" height="300" width="400">
</div>

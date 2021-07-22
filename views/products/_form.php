<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;











/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>
<?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

<?=  $form->field($model, 'category')->dropDownList(['gents' => 'Gents', 'women' => 'Women','kids' => 'Kids'],['prompt'=>'Select Option']); ?>

<?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'quantity')->textInput(['maxlength' => true]) ?>


<?= $form->field($model, 'image')->fileInput(['id' => 'imgInp']); ?>
<img id="blah" src="#" alt="image" width="100" height="100"/>




<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'image',
                'label' => 'Old Image',
                'value'=>'../uploads/' .$model->image,
                'format' => ['image',['width'=>'100','height'=>'100']],
                
            ],
        ],
    ]) ?>  

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <a href="index" class="btn btn-primary">Back</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>
<script>

$(document).ready(function() {
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
             $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});
});

</script>

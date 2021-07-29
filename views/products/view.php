<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use session;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

?>

<?= Yii::$app->session->getFlash('success') ?>
<?= Yii::$app->session->getFlash('error') ?>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<a href="index" class="btn btn-primary float-right" style="float:right;margin-bottom:30px;">BACK</a>
<div class="products-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'product_name',
            'category',
            'price',
            'quantity',
            //'image',
            [
                'attribute'=>'image',
                'value'=>'../uploads/' .$model->image,
                'format' => ['image',['width'=>'100','height'=>'100']],
                
            ],
        ],
    ]) ?>

    <div style="text-align:center;">
        <?= Html::a('<i class="fas fa-shopping-cart"></i> Add To Cart',['products/add-cart','id' => $model->id], ['class' => 'btn btn-info', 'title' => 'Add To Cart','style'=> 'text-align:center;']) ?>
    </div>



</div>



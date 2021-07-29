<?php


use yii\widgets\DetailView;
use ruskid\stripe\StripeCheckout;




?>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<h2>Cart</h2>



<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'product_name',
        'category',
        'price',
        // 'quantity',
        [
            'attribute'=>'image',
            'value'=>'../uploads/' .$model->image,
            'format' => ['image',['width'=>'100','height'=>'100']],
            
        ],
    ],
]) ?>

<div style="text-align:center">
<label for="total">Quantity</label>

<div class="number">
    <button class="minus btn btn-success">-</button>
	<input type="number" value="1" min="0"  style="text-align:center"/ id="add">
    <button class="plus btn btn-success">+</button>
</div>
</div>

<div style="text-align:center;margin-top:15px;margin-right:20px;">
<form class="form-inline">
  <div class="form-group">
    <label for="total">Total</label>
    <input type="number" class="form-control" id="total" readonly = 'true' style="text-align:center;color:green;">
  </div>
</form>
</div>





<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['method' => 'post'],'action' => ['products/update','id' => $model->id]]); ?>

<div style="text-align:center;margin-top:15px;">
<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
  data-name="TEST User"
  data-description="Testing"
  data-amount="<?php echo "$model->updated_price";?>
  data-locale="auto">

 </script>
 </div>
 <?php ActiveForm::end(); 
 
 ?>

<div style="text-align:center;margin-top:15px;">
<a href="../products" class="btn btn-info">Cancel payment</a>
</div>







 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>
<script>
	$(document).ready(function() {
             //on change value
            $("#add").on("input", function() {
                var qtyCount = $(this).val();
                let total = (qtyCount * <?php echo $model->price; ?>);
                $('#total').val(total);
                saveTotalAmount(total,id = <?php echo $model->id; ?>);
            });
            
            //on click button
			$('.minus').click(function () {
				var $input = $(this).parent().find('input');
				var count = parseInt($input.val()) - 1;
                $('#total').val(count * <?php echo $model->price; ?>);
                saveTotalAmount(count * <?php echo $model->price; ?>,id = <?php echo $model->id; ?>);
				count = count < 1 ? 0 : count;
                if (count == 0) {
                   $('#total').val(0); 
                }
				 $input.val(count);

				$input.change();
				return false;
			});
			$('.plus').click(function () {
				var $input = $(this).parent().find('input');
				$input.val(parseInt($input.val()) + 1);
                var vals = $('#add').val();
				$input.change();
                $('#total').val(vals * <?php echo $model->price; ?>);
                saveTotalAmount(vals * <?php echo $model->price; ?>,id = <?php echo $model->id; ?>);
                
				return false;
			});

        $('#total').val(<?php echo $model->price; ?>);



            function saveTotalAmount(amount,id) {
                // ajax call
                var data = amount;
                var url = '<?php echo \Yii::$app->getUrlManager()->createUrl('products/ajax') ?>';
                $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: { data: data , id:id },
                success: function(data){
                console.log(data);
                },
                error: function(){
                console.log("failure");
                }
                
            })

            }



            
    });


      

</script>




     


   



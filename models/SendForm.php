<?php

namespace app\models;
use Yii;

class SendForm extends \yii\db\ActiveRecord
{   

   public function insertCharge()
   {

     \Stripe\Stripe::setApiKey(Yii::$app->stripe->secret_key);

      $request = Yii::$app->request;

      $token = $request->post('stripeToken');

      //$token  = $_POST['stripeToken'];

      $customer = \Stripe\Customer::create(array(
          'email' => 'ahirkp1997@gmail.com',
          'source'  => $token
      ));

      $charge = \Stripe\Charge::create(array(
          'customer' => $customer->id,
          'amount'   => '<?php echo $model->updated_price; ?>',
          'currency' => 'INR'
      ));

   }//end function

}//end class

?>
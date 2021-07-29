<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $product_name
 * @property string $category
 * @property string $price
 * @property string $quantity
 * @property string $image
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    const IMAGE_PLACEHOLDER = '../uploads/default_user.jpg';

    
    public static function tableName()
        {
            return 'products';
        }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_name','category','price','quantity','image'],'required','message' => '{attribute} is required'],
            [['product_name'],'unique'],
            [['image'],'file'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_name' => 'Product Name',
            'category' => 'Product Category',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'image' => 'Image',
        ];
    }


        public function getDisplayImage() {
            if (empty($model->image)) {
                // if you do not want a placeholder
                $image = null;

                // else if you want to display a placeholder
                $image = Html::img(self::IMAGE_PLACEHOLDER, [
                    'alt'=>Yii::t('app', 'No avatar yet'),
                    'title'=>Yii::t('app', 'Upload your avatar by selecting browse below'),
                    'class'=>'file-preview-image'
                    // add a CSS class to make your image styling consistent
                ]);
            }
            else {
                $image = Html::img(Yii::$app->urlManager->baseUrl . '/' . $model->image, [
                    'alt'=>Yii::t('app', 'Avatar for ') . $model->product_name,
                    'title'=>Yii::t('app', 'Click remove button below to remove this image'),
                    'class'=>'file-preview-image'
                    // add a CSS class to make your image styling consistent
                ]);
            }

            // enclose in a container if you wish with appropriate styles
            return ($image == null) ? null : 
                Html::tag('div', $image, ['class' => 'file-preview-frame']); 
        }


        // public function deleteImage() {
        //     $image = Yii::$app->basePath . '/uploads/' . $this->image;
        //     if (unlink($image)) {
        //         $this->image = null;
        //         $this->save();
        //         return true;
        //     }
        //     return false;
        // }


    

   
}

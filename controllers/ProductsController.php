<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Products;
use app\models\SendForm;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use app\models\ProductsSearch;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use session;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    /**
     * {@inheritdoc}
     */

    

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if(Yii::$app->user->can('create-product')) {

            $model = new Products();

        if ($model->load(Yii::$app->request->post())) {

            $model->image = UploadedFile::getInstance($model,'image');
            
            $fileName = time().'.'.$model->image->extension; 

            $model->image->saveAs('uploads/'.$fileName);
            
            $model->image = $fileName;

            $model->save();
            Yii::$app->session->setFlash('success', "Product created successfully."); 
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);

        }
        else {

            throw new ForbiddenHttpException("You Are Not Perform This Action...");
            
        }
        
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        
        if(Yii::$app->user->can('update-product')) {

            if ($model->load(Yii::$app->request->post()) ) {
            $model->image = UploadedFile::getInstance($model,'image');
            
            $fileName = time().'.'.$model->image->extension; 

            $model->image->saveAs('uploads/'.$fileName);
            
            $model->image = $fileName;

            $model->save();
            Yii::$app->session->setFlash('success', "Product Updated successfully."); 

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

        } else {

            throw new ForbiddenHttpException("You Are Not Perform This Action... ");
            
        }
        
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        
        if(Yii::$app->user->can('delete-product')) {    
            $model = $this->findModel($id);  
            $oldThumb = Yii::$app->basePath . '/web/uploads/' . $model->image;
            unlink($oldThumb);
            $model->delete();
            Yii::$app->session->setFlash('error', "Product Deleted successfully."); 

  
            return $this->redirect(['index']);
        }
        else {
            throw new ForbiddenHttpException("You Are Not Perform This Action... ");

        }

    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAddCart($id) {

        return $this->render('add-cart', [
            'model' => $this->findModel($id),
        ]);

    }



    public function actionSend()

    {
        
        $model = new SendForm();

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->insertCharge(); 
                //Yii::$app->session->setFlash('Successfully charged $20.00!');
                return $this->render('send-confirm', ['model' => $model]);
            } else {
                return $this->render('add-cart', [
                    'model' => $model,
                ]);
            }

    }

    
    public function actionAjax()
    {
        $model =  Products::findOne(Yii::$app->request->post('id'));
        if (Yii::$app->request->post('data')){
            $model->updated_price = Yii::$app->request->post('data');
            $model->save();
            $data = $model->updated_price;
        }
        else {
            $data = "Ajax Does Not  Work!";
        }
        return $data;
    }

    
    // public function actionDeleteImage($id) {
    //     $model = Products::findOne($id);
    //     unlink(Yii::$app->basePath . '/uploads/' . $model->image);
    //     $this->findModel($id)->delete();
    //     return $this->redirect(['index']);  
    // }

      
    
}

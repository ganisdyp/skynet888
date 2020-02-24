<?php

namespace backend\modules\content\controllers;

use Yii;
use yii\base\Model;
use common\models\Product;
use common\models\ProductPhoto;
use common\models\ProductOwner;
use backend\modules\content\models\ProductSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $modelDetails = [];
        $formDetails = Yii::$app->request->post('ProductPhoto', []);
        foreach ($formDetails as $i => $formDetail) {
            $modelDetail = new ProductPhoto(['scenario' => ProductPhoto::SCENARIO_BATCH_UPDATE]);
            $modelDetail->setAttributes($formDetail);
            $modelDetails[] = $modelDetail;
        }

        //handling if the addRow button has been pressed
        if (Yii::$app->request->post('addRowPhoto') == 'true') {
            $model->load(Yii::$app->request->post());
            $modelDetails[] = new ProductPhoto(['scenario' => ProductPhoto::SCENARIO_BATCH_UPDATE]);
            $modelDetails[] = new ProductPhoto(['scenario' => ProductPhoto::SCENARIO_BATCH_UPDATE]);

            return $this->render('create', [
                'model' => $model,
                'modelDetails' => $modelDetails,
            ]);
        }

        if ($model->load(Yii::$app->request->post())) {


            if ($model->validate()) {

                //print_r($model);
                $file = UploadedFile::getInstance($model, 'main_photo_file');
                if (isset($file->size) && $file->size != 0) {

                    $unique_name = "product_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/product/' . $path);
                }
                $model->save();
                //  print_r($model);
                if (Model::validateMultiple($modelDetails)) {


                    foreach ($modelDetails as $c => $modelDetail) {

                        ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'product_photo');
                        if (isset(${'profile_file' . $c}->size) && ${'profile_file' . $c}->size != 0) {

                            $unique_name = "product_" . date("Y-m-d_H-i-s") . "_". uniqid();
                            $path = $unique_name . ".{${'profile_file' . $c}->extension}";
                            $modelDetail->photo_url = $path;
                            ${'profile_file' . $c}->saveAs('uploads/product/related_photo/' . $path);
                            $modelDetail->product_id = $model->id;
                            $modelDetail->save();
                        }

                    }

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'modelDetails' => $modelDetails,
            //'modelDetails2' => $modelDetails2,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelDetails = $model->productPhotos;
      //  $modelDetails2 = $model->productOwners;

        $formDetails = Yii::$app->request->post('ProductPhoto', []);
      //  $formDetails2 = Yii::$app->request->post('ProductOwner', []);
        foreach ($formDetails as $i => $formDetail) {
            //loading the models if they are not new
            if (isset($formDetail['id']) && isset($formDetail['updateType']) && $formDetail['updateType'] != ProductPhoto::UPDATE_TYPE_CREATE) {
                //making sure that it is actually a child of the main model
                $modelDetail = ProductPhoto::findOne(['id' => $formDetail['id'], 'product_id' => $model->id]);
                $modelDetail->setScenario(ProductPhoto::SCENARIO_BATCH_UPDATE);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[$i] = $modelDetail;
                //validate here if the modelDetail loaded is valid, and if it can be updated or deleted
            } else {
                $modelDetail = new ProductPhoto(['scenario' => ProductPhoto::SCENARIO_BATCH_UPDATE]);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[] = $modelDetail;
            }

        }


        //handling if the addRow button has been pressed
        if (Yii::$app->request->post('addRowPhoto') == 'true') {
            $modelDetails[] = new ProductPhoto(['scenario' => ProductPhoto::SCENARIO_BATCH_UPDATE]);
            $modelDetails[] = new ProductPhoto(['scenario' => ProductPhoto::SCENARIO_BATCH_UPDATE]);

            return $this->render('update', [
                'model' => $model,
                'modelDetails' => $modelDetails,
               // 'modelDetails2' => $modelDetails2
            ]);
        }
      /*  if (Yii::$app->request->post('addRowOwner') == 'true') {
            $modelDetails2[] = new ProductOwner(['scenario' => ProductOwner::SCENARIO_BATCH_UPDATE]);
            return $this->render('update', [
                'model' => $model,
                'modelDetails' => $modelDetails,
                'modelDetails2' => $modelDetails2
            ]);
        }*/

        if ($model->load(Yii::$app->request->post())) {


            if (Model::validateMultiple($modelDetails) && $model->validate()) {
                $file = UploadedFile::getInstance($model, 'main_photo_file');
                //print_r($file);
                if (isset($file->size) && $file->size !== 0) {
                    //   $model->main_photo = $file->baseName . '.' . $file->extension;
                    //   $file->saveAs('uploads/product/' . $file->baseName . '.' . $file->extension);
                    $old_name = $model->main_photo;
                    $unique_name = "product_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/product/' . $path);
                    if (isset($old_name)) {
                        unlink('uploads/product/' . $old_name);
                    } else {
                        // Do nothing
                    }
                }
                $model->save();
                foreach ($modelDetails as $c => $modelDetail) {
                    //details that has been flagged for deletion will be deleted
                    if ($modelDetail->updateType == ProductPhoto::UPDATE_TYPE_DELETE) {
                        $modelDetail->delete();
                    } else {
                        //new or updated records go here
                        ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'product_photo');
                        if (isset(${'profile_file' . $c}->size) && ${'profile_file' . $c}->size != 0) {
                            //    $modelDetail->photo_url = ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension;
                            //   ${'profile_file' . $c}->saveAs('uploads/product/related_photo/' . ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension);
                            $old_name = $modelDetail->photo_url;
                            $unique_name = "product_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                            $path = $unique_name . ".{${'profile_file' . $c}->extension}";
                            $modelDetail->photo_url = $path;
                            ${'profile_file' . $c}->saveAs('uploads/product/related_photo/' . $path);
                            if (isset($old_name)) {
                                unlink('uploads/product/related_photo/' . $old_name);
                            } else {
                                // Do nothing
                            }
                            $modelDetail->product_id = $model->id;
                            $modelDetail->save();
                        }

                    }
                }
               /* foreach ($modelDetails2 as $c => $modelDetail2) {
                    //details that has been flagged for deletion will be deleted
                    if ($modelDetail2->updateType == ProductOwner::UPDATE_TYPE_DELETE) {
                        $modelDetail2->delete();
                    } else {
                        //new or updated records go here

                        $modelDetail2->product_id = $model->id;
                        $modelDetail2->save();
                    }
                }*/
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }


        return $this->render('update', [
            'model' => $model,
            'modelDetails' => $modelDetails,
          //  'modelDetails2' => $modelDetails2
        ]);

    }
    /* public function actionUpdate($id)
     {
         $model = $this->findModel($id);
         $modelDetails = $model->productPhotos;

         $formDetails = Yii::$app->request->post('ProductPhoto', []);
         foreach ($formDetails as $i => $formDetail) {
             //loading the models if they are not new
             if (isset($formDetail['id']) && isset($formDetail['updateType']) && $formDetail['updateType'] != ProductPhoto::UPDATE_TYPE_CREATE) {
                 //making sure that it is actually a child of the main model
                 $modelDetail = ProductPhoto::findOne(['id' => $formDetail['id'], 'product_id' => $model->id]);
                 $modelDetail->setScenario(ProductPhoto::SCENARIO_BATCH_UPDATE);
                 $modelDetail->setAttributes($formDetail);
                 $modelDetails[$i] = $modelDetail;
                 //validate here if the modelDetail loaded is valid, and if it can be updated or deleted
             } else {
                 $modelDetail = new ProductPhoto(['scenario' => ProductPhoto::SCENARIO_BATCH_UPDATE]);
                 $modelDetail->setAttributes($formDetail);
                 $modelDetails[] = $modelDetail;
             }

         }

         //handling if the addRow button has been pressed
         if (Yii::$app->request->post('addRow') == 'true') {
             $modelDetails[] = new ProductPhoto(['scenario' => ProductPhoto::SCENARIO_BATCH_UPDATE]);
             return $this->render('update', [
                 'model' => $model,
                 'modelDetails' => $modelDetails
             ]);
         }
         if ($model->load(Yii::$app->request->post())) {
             $file = UploadedFile::getInstance($model, 'main_photo_file');
             //print_r($file);
             if (isset($file->size) && $file->size !== 0) {
                 $model->main_photo = $file->baseName . '.' . $file->extension;
                 $file->saveAs('uploads/product/' . $file->baseName . '.' . $file->extension);
             }
             $model->save();
             if (Model::validateMultiple($modelDetails)) {
             //    print_r($modelDetails);
                 foreach ($modelDetails as $c => $modelDetail) {

                     //details that has been flagged for deletion will be deleted
                     if ($modelDetail->updateType == ProductPhoto::UPDATE_TYPE_DELETE) {
                         $modelDetail->delete();
                     } else {
                         //new or updated records go here
                         ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'product_photo');
                         if (${'profile_file' . $c}->size != 0) {
                             $modelDetail->photo_url = ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension;
                             ${'profile_file' . $c}->saveAs('uploads/product/related_photo/' . ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension);
                         }
                         $modelDetail->product_id = $model->id;
                         $modelDetail->save();
                     }
                 }
                 return $this->redirect(['view', 'id' => $model->id]);
             }

         }

         return $this->render('update', [
             'model' => $model,
             'modelDetails' => $modelDetails,
         ]);
     }*/

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $product_langs = $this->findModel($id)->getProductLangs()->where(['product_id' => $id])->all();
        foreach ($product_langs as $product_lang) {
            $product_lang->delete();
        }
        $product_photos = $this->findModel($id)->getProductPhotos()->where(['product_id' => $id])->all();
        foreach ($product_photos as $product_photo) {
            unlink('uploads/product/related_photo/' . $product_photo->photo_url);
            $product_photo->delete();
        }
        if (isset($this->findModel($id)->main_photo)) {
            unlink('uploads/product/' . $this->findModel($id)->main_photo);
        } else {

        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::find()->multilingual()->where(['product.id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }


}

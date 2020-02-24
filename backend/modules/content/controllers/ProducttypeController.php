<?php

namespace backend\modules\content\controllers;

use Yii;
use common\models\ProductType;
use backend\modules\content\models\ProductTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductTypeController implements the CRUD actions for ProductType model.
 */
class ProducttypeController extends Controller
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
     * Lists all ProductType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductType model.
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
     * Creates a new ProductType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductType();

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'main_photo_file');
            if (isset($file->size) && $file->size != 0) {
                //  $model->main_photo = $file->baseName . '.' . $file->extension;
                $unique_name = "product-type_" . date("Y-m-d_H-i-s") . "_". uniqid();
                $path = $unique_name . ".{$file->extension}";
                $model->main_photo = $path;
                $file->saveAs('uploads/product_type/' . $path);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $file = UploadedFile::getInstance($model, 'main_photo_file');

            if (isset($file->size) && $file->size !== 0) {

                $old_name = $model->main_photo;
                $unique_name = "product-type_" . date("Y-m-d_H-i-s") . "_". uniqid();
                $path = $unique_name . ".{$file->extension}";
                $model->main_photo = $path;
                $file->saveAs('uploads/product_type/' . $path);
                if (isset($old_name)) {
                    unlink('uploads/product_type/' . $old_name);
                } else {
                    //Do nothing
                }

                //  $model->main_photo = $file->baseName . '.' . $file->extension;
                //  $file->saveAs('uploads/product_type/' . $file->baseName . '.' . $file->extension);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $producttype_langs = $this->findModel($id)->getProductTypeLangs()->where(['product_type_id' => $id])->all();
        foreach ($producttype_langs as $producttype_lang) {
            $producttype_lang->delete();
        }
        if (isset($this->findModel($id)->main_photo)) {
            unlink('uploads/product_type/' . $this->findModel($id)->main_photo);
        } else {
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductType::find()->multilingual()->where(['product_type.id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}

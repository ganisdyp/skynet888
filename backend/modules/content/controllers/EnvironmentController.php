<?php

namespace backend\modules\content\controllers;

use Yii;
use yii\base\Model;
use common\models\Environment;
use common\models\EnvironmentPhoto;
use backend\modules\content\models\EnvironmentSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * EnvironmentController implements the CRUD actions for Environment model.
 */
class EnvironmentController extends Controller
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
     * Lists all Environment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EnvironmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Environment model.
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
     * Creates a new Environment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Environment();
        $modelDetails = [];
        $formDetails = Yii::$app->request->post('EnvironmentPhoto', []);
        foreach ($formDetails as $i => $formDetail) {
            $modelDetail = new EnvironmentPhoto(['scenario' => EnvironmentPhoto::SCENARIO_BATCH_UPDATE]);
            $modelDetail->setAttributes($formDetail);
            $modelDetails[] = $modelDetail;
        }

        //handling if the addRow button has been pressed
        if (Yii::$app->request->post('addRowPhoto') == 'true') {
            $model->load(Yii::$app->request->post());
            $modelDetails[] = new EnvironmentPhoto(['scenario' => EnvironmentPhoto::SCENARIO_BATCH_UPDATE]);
            $modelDetails[] = new EnvironmentPhoto(['scenario' => EnvironmentPhoto::SCENARIO_BATCH_UPDATE]);

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

                    $unique_name = "environment_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/environment/' . $path);
                }
                $model->save();
                //  print_r($model);
                if (Model::validateMultiple($modelDetails)) {


                    foreach ($modelDetails as $c => $modelDetail) {

                        ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'environment_photo');
                        if (isset(${'profile_file' . $c}->size) && ${'profile_file' . $c}->size != 0) {

                            $unique_name = "environment_" . date("Y-m-d_H-i-s") . "_". uniqid();
                            $path = $unique_name . ".{${'profile_file' . $c}->extension}";
                            $modelDetail->photo_url = $path;
                            ${'profile_file' . $c}->saveAs('uploads/environment/related_photo/' . $path);
                            $modelDetail->environment_id = $model->id;
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
     * Updates an existing Environment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelDetails = $model->environmentPhotos;

        $formDetails = Yii::$app->request->post('EnvironmentPhoto', []);
        foreach ($formDetails as $i => $formDetail) {
            //loading the models if they are not new
            if (isset($formDetail['id']) && isset($formDetail['updateType']) && $formDetail['updateType'] != EnvironmentPhoto::UPDATE_TYPE_CREATE) {
                //making sure that it is actually a child of the main model
                $modelDetail = EnvironmentPhoto::findOne(['id' => $formDetail['id'], 'environment_id' => $model->id]);
                $modelDetail->setScenario(EnvironmentPhoto::SCENARIO_BATCH_UPDATE);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[$i] = $modelDetail;
                //validate here if the modelDetail loaded is valid, and if it can be updated or deleted
            } else {
                $modelDetail = new EnvironmentPhoto(['scenario' => EnvironmentPhoto::SCENARIO_BATCH_UPDATE]);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[] = $modelDetail;
            }

        }


        //handling if the addRow button has been pressed
        if (Yii::$app->request->post('addRowPhoto') == 'true') {
            $modelDetails[] = new EnvironmentPhoto(['scenario' => EnvironmentPhoto::SCENARIO_BATCH_UPDATE]);
            $modelDetails[] = new EnvironmentPhoto(['scenario' => EnvironmentPhoto::SCENARIO_BATCH_UPDATE]);

            return $this->render('update', [
                'model' => $model,
                'modelDetails' => $modelDetails,
               // 'modelDetails2' => $modelDetails2
            ]);
        }

        if ($model->load(Yii::$app->request->post())) {


            if (Model::validateMultiple($modelDetails) && $model->validate()) {
                $file = UploadedFile::getInstance($model, 'main_photo_file');
                //print_r($file);
                if (isset($file->size) && $file->size !== 0) {
                    //   $model->main_photo = $file->baseName . '.' . $file->extension;
                    //   $file->saveAs('uploads/environment/' . $file->baseName . '.' . $file->extension);
                    $old_name = $model->main_photo;
                    $unique_name = "environment_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/environment/' . $path);
                    if (isset($old_name)) {
                        unlink('uploads/environment/' . $old_name);
                    } else {
                        // Do nothing
                    }
                }
                $model->save();
                foreach ($modelDetails as $c => $modelDetail) {
                    //details that has been flagged for deletion will be deleted
                    if ($modelDetail->updateType == EnvironmentPhoto::UPDATE_TYPE_DELETE) {
                        $modelDetail->delete();
                    } else {
                        //new or updated records go here
                        ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'environment_photo');
                        if (isset(${'profile_file' . $c}->size) && ${'profile_file' . $c}->size != 0) {
                            //    $modelDetail->photo_url = ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension;
                            //   ${'profile_file' . $c}->saveAs('uploads/environment/related_photo/' . ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension);
                            $old_name = $modelDetail->photo_url;
                            $unique_name = "environment_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                            $path = $unique_name . ".{${'profile_file' . $c}->extension}";
                            $modelDetail->photo_url = $path;
                            ${'profile_file' . $c}->saveAs('uploads/environment/related_photo/' . $path);
                            if (isset($old_name)) {
                                unlink('uploads/environment/related_photo/' . $old_name);
                            } else {
                                // Do nothing
                            }
                            $modelDetail->environment_id = $model->id;
                            $modelDetail->save();
                        }

                    }
                }
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
         $modelDetails = $model->environmentPhotos;

         $formDetails = Yii::$app->request->post('EnvironmentPhoto', []);
         foreach ($formDetails as $i => $formDetail) {
             //loading the models if they are not new
             if (isset($formDetail['id']) && isset($formDetail['updateType']) && $formDetail['updateType'] != EnvironmentPhoto::UPDATE_TYPE_CREATE) {
                 //making sure that it is actually a child of the main model
                 $modelDetail = EnvironmentPhoto::findOne(['id' => $formDetail['id'], 'environment_id' => $model->id]);
                 $modelDetail->setScenario(EnvironmentPhoto::SCENARIO_BATCH_UPDATE);
                 $modelDetail->setAttributes($formDetail);
                 $modelDetails[$i] = $modelDetail;
                 //validate here if the modelDetail loaded is valid, and if it can be updated or deleted
             } else {
                 $modelDetail = new EnvironmentPhoto(['scenario' => EnvironmentPhoto::SCENARIO_BATCH_UPDATE]);
                 $modelDetail->setAttributes($formDetail);
                 $modelDetails[] = $modelDetail;
             }

         }

         //handling if the addRow button has been pressed
         if (Yii::$app->request->post('addRow') == 'true') {
             $modelDetails[] = new EnvironmentPhoto(['scenario' => EnvironmentPhoto::SCENARIO_BATCH_UPDATE]);
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
                 $file->saveAs('uploads/environment/' . $file->baseName . '.' . $file->extension);
             }
             $model->save();
             if (Model::validateMultiple($modelDetails)) {
             //    print_r($modelDetails);
                 foreach ($modelDetails as $c => $modelDetail) {

                     //details that has been flagged for deletion will be deleted
                     if ($modelDetail->updateType == EnvironmentPhoto::UPDATE_TYPE_DELETE) {
                         $modelDetail->delete();
                     } else {
                         //new or updated records go here
                         ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'environment_photo');
                         if (${'profile_file' . $c}->size != 0) {
                             $modelDetail->photo_url = ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension;
                             ${'profile_file' . $c}->saveAs('uploads/environment/related_photo/' . ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension);
                         }
                         $modelDetail->environment_id = $model->id;
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
     * Deletes an existing Environment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $environment_langs = $this->findModel($id)->getEnvironmentLangs()->where(['environment_id' => $id])->all();
        foreach ($environment_langs as $environment_lang) {
            $environment_lang->delete();
        }
        $environment_photos = $this->findModel($id)->getEnvironmentPhotos()->where(['environment_id' => $id])->all();
        foreach ($environment_photos as $environment_photo) {
            unlink('uploads/environment/related_photo/' . $environment_photo->photo_url);
            $environment_photo->delete();
        }
        if (isset($this->findModel($id)->main_photo)) {
            unlink('uploads/environment/' . $this->findModel($id)->main_photo);
        } else {

        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Environment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Environment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Environment::find()->multilingual()->where(['environment.id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }


}

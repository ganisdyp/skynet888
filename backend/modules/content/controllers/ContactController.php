<?php

namespace backend\modules\content\controllers;

use Yii;
use yii\base\Model;
use common\models\Contact;
use common\models\ContactPhoto;
use backend\modules\content\models\ContactSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ContactContentController implements the CRUD actions for ContactContent model.
 */
class ContactController extends Controller
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
     * Lists all ContactContent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContactContent model.
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

    public function actionCreate()
    {
        $model = new Contact();
        $modelDetails = [];
        $formDetails = Yii::$app->request->post('ContactPhoto', []);
        foreach ($formDetails as $i => $formDetail) {
            $modelDetail = new ContactPhoto(['scenario' => ContactPhoto::SCENARIO_BATCH_UPDATE]);
            $modelDetail->setAttributes($formDetail);
            $modelDetails[] = $modelDetail;
        }

        //handling if the addRow button has been pressed
        if (Yii::$app->request->post('addRowPhoto') == 'true') {
            $model->load(Yii::$app->request->post());
            $modelDetails[] = new ContactPhoto(['scenario' => ContactPhoto::SCENARIO_BATCH_UPDATE]);
            $modelDetails[] = new ContactPhoto(['scenario' => ContactPhoto::SCENARIO_BATCH_UPDATE]);

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

                    $unique_name = "contact_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/contact/' . $path);
                }
                $model->save();
                //  print_r($model);
                if (Model::validateMultiple($modelDetails)) {


                    foreach ($modelDetails as $c => $modelDetail) {

                        ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'contact_photo');
                        if (isset(${'profile_file' . $c}->size) && ${'profile_file' . $c}->size != 0) {

                            $unique_name = "contact_" . date("Y-m-d_H-i-s") . "_". uniqid();
                            $path = $unique_name . ".{${'profile_file' . $c}->extension}";
                            $modelDetail->photo_url = $path;
                            ${'profile_file' . $c}->saveAs('uploads/contact/related_photo/' . $path);
                            $modelDetail->contact_id = $model->id;
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
     * Updates an existing ContactContent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelDetails = $model->contactPhotos;

        $formDetails = Yii::$app->request->post('ContactPhoto', []);
        foreach ($formDetails as $i => $formDetail) {
            //loading the models if they are not new
            if (isset($formDetail['id']) && isset($formDetail['updateType']) && $formDetail['updateType'] != ContactPhoto::UPDATE_TYPE_CREATE) {
                //making sure that it is actually a child of the main model
                $modelDetail = ContactPhoto::findOne(['id' => $formDetail['id'], 'contact_id' => $model->id]);
                $modelDetail->setScenario(ContactPhoto::SCENARIO_BATCH_UPDATE);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[$i] = $modelDetail;
                //validate here if the modelDetail loaded is valid, and if it can be updated or deleted
            } else {
                $modelDetail = new ContactPhoto(['scenario' => ContactPhoto::SCENARIO_BATCH_UPDATE]);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[] = $modelDetail;
            }

        }


        //handling if the addRow button has been pressed
        if (Yii::$app->request->post('addRowPhoto') == 'true') {
            $modelDetails[] = new ContactPhoto(['scenario' => ContactPhoto::SCENARIO_BATCH_UPDATE]);
            $modelDetails[] = new ContactPhoto(['scenario' => ContactPhoto::SCENARIO_BATCH_UPDATE]);

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
                    //   $file->saveAs('uploads/contact/' . $file->baseName . '.' . $file->extension);
                    $old_name = $model->main_photo;
                    $unique_name = "contact_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/contact/' . $path);
                    if (isset($old_name)) {
                        if($old_name==''){

                        }else {
                            unlink('uploads/contact/' . $old_name);
                        }
                    } else {
                        // Do nothing
                    }
                }
                $model->save();
                foreach ($modelDetails as $c => $modelDetail) {
                    //details that has been flagged for deletion will be deleted
                    if ($modelDetail->updateType == ContactPhoto::UPDATE_TYPE_DELETE) {
                        $modelDetail->delete();
                    } else {
                        //new or updated records go here
                        ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'contact_photo');
                        if (isset(${'profile_file' . $c}->size) && ${'profile_file' . $c}->size != 0) {
                            //    $modelDetail->photo_url = ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension;
                            //   ${'profile_file' . $c}->saveAs('uploads/contact/related_photo/' . ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension);
                            $old_name = $modelDetail->photo_url;
                            $unique_name = "contact_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                            $path = $unique_name . ".{${'profile_file' . $c}->extension}";
                            $modelDetail->photo_url = $path;
                            ${'profile_file' . $c}->saveAs('uploads/contact/related_photo/' . $path);
                            if (isset($old_name)) {

                                unlink('uploads/contact/related_photo/' . $old_name);
                            } else {
                                // Do nothing
                            }
                            $modelDetail->contact_id = $model->id;
                            $modelDetail->save();
                        }

                    }
                }
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => '<i class="fa fa-check"></i> Update Succesfully',
                    'options' => ['class' => 'alert-success']
                ]);
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }


        return $this->render('update', [
            'model' => $model,
            'modelDetails' => $modelDetails,
            //  'modelDetails2' => $modelDetails2
        ]);

    }

    /**
     * Deletes an existing ContactContent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ContactContent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contact::find()->multilingual()->where(['contact.id'=>$id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}

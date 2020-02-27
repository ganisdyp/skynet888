<?php

namespace backend\modules\content\controllers;

use Yii;
use yii\base\Model;
use common\models\Project;
use common\models\ProjectPhoto;
use backend\modules\content\models\ProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
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
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
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
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Project();
        $modelDetails = [];

        $formDetails = Yii::$app->request->post('ProjectPhoto', []);
        foreach ($formDetails as $i => $formDetail) {
            $modelDetail = new ProjectPhoto(['scenario' => ProjectPhoto::SCENARIO_BATCH_UPDATE]);
            $modelDetail->setAttributes($formDetail);
            $modelDetails[] = $modelDetail;
        }
        if (Yii::$app->request->post('addRowPhoto') == 'true') {
            $model->load(Yii::$app->request->post());
            $modelDetails[] = new ProjectPhoto(['scenario' => ProjectPhoto::SCENARIO_BATCH_UPDATE]);
            return $this->render('create', [
                'model' => $model,
                'modelDetails' => $modelDetails,

            ]);
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $file = UploadedFile::getInstance($model, 'main_photo_file');
                if (isset($file->size) && $file->size !== 0) {
                    $unique_name = "project_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    // $model->main_photo = $file->baseName . '.' . $file->extension;
                    $file->saveAs('uploads/project/' . $path);
                }
                $model->save();
                if (Model::validateMultiple($modelDetails)) {


                    foreach ($modelDetails as $c => $modelDetail) {

                        ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'project_photo');

                        if (isset(${'profile_file' . $c}->size) && ${'profile_file' . $c}->size != 0) {

                            $unique_name = "project_" . date("Y-m-d_H-i-s") . "_". uniqid();
                            $path = $unique_name . ".{${'profile_file' . $c}->extension}";
                            $modelDetail->photo_url = $path;

                            //     $modelDetail->photo_url = ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension;
                            ${'profile_file' . $c}->saveAs('uploads/project/related_photo/' . $path);
                        }
                        $modelDetail->project_id = $model->id;
                        $modelDetail->save();
                    }

                    return $this->redirect(['view', 'id' => $model->id]);
                }

            }

            /* return $this->redirect(['view', 'id' => $model->id]);*/
        }

        return $this->render('create', [
            'model' => $model,
            'modelDetails' => $modelDetails,
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelDetails = $model->projectPhotos;
        $formDetails = Yii::$app->request->post('ProjectPhoto', []);

        foreach ($formDetails as $i => $formDetail) {
            //loading the models if they are not new
            if (isset($formDetail['id']) && isset($formDetail['updateType']) && $formDetail['updateType'] != ProjectPhoto::UPDATE_TYPE_CREATE) {
                //making sure that it is actually a child of the main model
                $modelDetail = ProjectPhoto::findOne(['id' => $formDetail['id'], 'project_id' => $model->id]);
                $modelDetail->setScenario(ProjectPhoto::SCENARIO_BATCH_UPDATE);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[$i] = $modelDetail;
                //validate here if the modelDetail loaded is valid, and if it can be updated or deleted
            } else {
                $modelDetail = new ProjectPhoto(['scenario' => ProjectPhoto::SCENARIO_BATCH_UPDATE]);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[] = $modelDetail;
            }

        }
        //handling if the addRow button has been pressed
        if (Yii::$app->request->post('addRowPhoto') == 'true') {
            $modelDetails[] = new ProjectPhoto(['scenario' => ProjectPhoto::SCENARIO_BATCH_UPDATE]);
            return $this->render('update', [
                'model' => $model,
                'modelDetails' => $modelDetails,
            ]);
        }

        if ($model->load(Yii::$app->request->post())) {
            if (Model::validateMultiple($modelDetails) && $model->validate()) {
                $file = UploadedFile::getInstance($model, 'main_photo_file');
                //print_r($file);
                if (isset($file->size) && $file->size !== 0) {
                    $old_name = $model->main_photo;
                    $unique_name = "project_" . date("Y-m-d_H-i-s") . "_". uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/project/' . $path);
                    if (isset($old_name)) {
                        unlink('uploads/project/' . $old_name);
                    } else {
                        // Do nothing
                    }
                    //  $model->main_photo = $file->baseName . '.' . $file->extension;
                    //  $file->saveAs('uploads/project/' . $file->baseName . '.' . $file->extension);
                }
                $model->save();
                foreach ($modelDetails as $c => $modelDetail) {
                    //details that has been flagged for deletion will be deleted
                    if ($modelDetail->updateType == ProjectPhoto::UPDATE_TYPE_DELETE) {
                        $modelDetail->delete();
                    } else {
                        //new or updated records go here
                        ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'project_photo');
                        if (isset(${'profile_file' . $c}->size) && ${'profile_file' . $c}->size != 0) {

                            $old_name = $modelDetail->photo_url;
                            $unique_name = "project_" . date("Y-m-d_H-i-s") . "_". uniqid();
                            $path = $unique_name . ".{${'profile_file' . $c}->extension}";
                            $modelDetail->photo_url = $path;
                            ${'profile_file' . $c}->saveAs('uploads/project/related_photo/' . $path);
                            if (isset($old_name)) {
                                unlink('uploads/project/related_photo/' . $old_name);
                            } else {
                                // Do nothing
                            }
                            // $modelDetail->photo_url = ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension;
                            // ${'profile_file' . $c}->saveAs('uploads/project/related_photo/' . ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension);
                        }
                        $modelDetail->project_id = $model->id;
                        $modelDetail->save();
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', ['model' => $model,
            'modelDetails' => $modelDetails,]);
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionDelete($id)
    {


        $project_langs = $this->findModel($id)->getProjectLangs()->where(['project_id' => $id])->all();
        foreach ($project_langs as $project_lang) {
            $project_lang->delete();
        }

        $project_photos = $this->findModel($id)->getProjectPhotos()->where(['project_id' => $id])->all();
        foreach ($project_photos as $project_photo) {
            unlink('uploads/project/related_photo/' . $project_photo->photo_url);
            $project_photo->delete();
        }
        if (isset($this->findModel($id)->main_photo)) {
            unlink('uploads/project/' . $this->findModel($id)->main_photo);
        } else {

        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = Project::find()->multilingual()->where(['project.id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}

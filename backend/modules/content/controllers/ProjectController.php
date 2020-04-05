<?php

namespace backend\modules\content\controllers;

use common\models\Story;
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
                return $this->redirect(['view', 'id' => $model->id]);

            }
        }

        return $this->render('create', [
            'model' => $model
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
    //    $story = new Story();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $file = UploadedFile::getInstance($model, 'main_photo_file');
                //print_r($file);
                if (isset($file->size) && $file->size !== 0) {
                    $old_name = $model->main_photo;
                    $unique_name = "project_" . date("Y-m-d_H-i-s") . "_". uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/project/' . $path);
                    if (isset($old_name)) {
                        if($old_name==''){

                        }else {
                            unlink('uploads/project/' . $old_name);
                        }
                    } else {
                        // Do nothing
                    }
                    //  $model->main_photo = $file->baseName . '.' . $file->extension;
                    //  $file->saveAs('uploads/project/' . $file->baseName . '.' . $file->extension);
                }
                $model->save();

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
      //      'story' => $story
            ]);
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

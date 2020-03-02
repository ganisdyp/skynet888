<?php

namespace backend\modules\content\controllers;

use backend\modules\content\models\ProjectSearch;
use Yii;
use yii\base\Model;
use common\models\Story;
use backend\modules\content\models\StorySearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * StoryController implements the CRUD actions for Story model.
 */
class StoryController extends Controller
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
     * Lists all Story models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Story model.
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
     * Creates a new Story model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Story();


        if ($model->load(Yii::$app->request->post())) {


            if ($model->validate()) {

                //print_r($model);
                $file = UploadedFile::getInstance($model, 'main_photo_file');
                if (isset($file->size) && $file->size != 0) {

                    $unique_name = "story_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/story/' . $path);
                }
                $model->save();

                return $this->redirect(['view', 'id' => $model->id]);

            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Story model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post())) {


            if ($model->validate()) {
                $file = UploadedFile::getInstance($model, 'main_photo_file');
                //print_r($file);
                if (isset($file->size) && $file->size !== 0) {
                    //   $model->main_photo = $file->baseName . '.' . $file->extension;
                    //   $file->saveAs('uploads/story/' . $file->baseName . '.' . $file->extension);
                    $old_name = $model->main_photo;
                    $unique_name = "story_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/story/' . $path);
                    if (isset($old_name)) {
                        unlink('uploads/story/' . $old_name);
                    } else {
                        // Do nothing
                    }
                }
                $model->save();

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }


        return $this->render('update', [
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing Story model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $story_langs = $this->findModel($id)->getStoryLangs()->where(['story_id' => $id])->all();
        foreach ($story_langs as $story_lang) {
            $story_lang->delete();
        }

        if (isset($this->findModel($id)->main_photo)) {
            unlink('uploads/story/' . $this->findModel($id)->main_photo);
        } else {

        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Story model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Story the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Story::find()->multilingual()->where(['story.id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }

    function actionLoadstory()
    {

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();;
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $out = [];
            if (isset($data['project_id'])) {
                $project_id = $data['project_id'];
                  $searchModel_project = new ProjectSearch();
                  $dataProvider_project = $searchModel_project->search(Yii::$app->request->queryParams);
                  $project = $dataProvider_project->query->where(['id' => $project_id])->one();
                  $story = $project->story;

                    if (isset($story)) {
                        $story = $story->id.' ||| '.$story->name;
                    } else {
                        $story = null;
                    }
                $out[] = $story;
            }
            return $out;
        }
    }

}

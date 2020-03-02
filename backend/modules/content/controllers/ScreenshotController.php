<?php

namespace backend\modules\content\controllers;

use backend\modules\content\models\ProjectSearch;
use Yii;
use yii\base\Model;
use common\models\Screenshot;
use backend\modules\content\models\ScreenshotSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ScreenshotController implements the CRUD actions for Screenshot model.
 */
class ScreenshotController extends Controller
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
     * Lists all Screenshot models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ScreenshotSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Screenshot model.
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
     * Creates a new Screenshot model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Screenshot();


        if ($model->load(Yii::$app->request->post())) {


            if ($model->validate()) {

                //print_r($model);
                $file = UploadedFile::getInstance($model, 'main_photo_file');
                if (isset($file->size) && $file->size != 0) {

                    $unique_name = "screenshot_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/screenshot/' . $path);
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
     * Updates an existing Screenshot model.
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
                    //   $file->saveAs('uploads/screenshot/' . $file->baseName . '.' . $file->extension);
                    $old_name = $model->main_photo;
                    $unique_name = "screenshot_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/screenshot/' . $path);
                    if (isset($old_name)) {
                        unlink('uploads/screenshot/' . $old_name);
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
     * Deletes an existing Screenshot model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        if (isset($this->findModel($id)->main_photo)) {
            unlink('uploads/screenshot/' . $this->findModel($id)->main_photo);
        } else {

        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Screenshot model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Screenshot the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Screenshot::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    function actionLoadscreenshot()
    {

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();;
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $out = [];
            if (isset($data['project_id'])) {
                $project_id = $data['project_id'];
                $searchModel_screenshot = new ScreenshotSearch();
                $dataProvider_screenshot = $searchModel_screenshot->search(Yii::$app->request->queryParams);
                $screenshots = $dataProvider_screenshot->query->where(['project_id' => $project_id])->all();
                if (isset($screenshots)) {
                    foreach ($screenshots as $screenshot) {

                        $out[] = $screenshot->id.' ||| '.$screenshot->main_photo;
                    }
                } else {
                    $screenshots = null;
                    $out[] = $screenshots;
                }

            }
            return $out;
        }
    }

}

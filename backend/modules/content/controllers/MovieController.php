<?php

namespace backend\modules\content\controllers;

use Yii;
use yii\base\Model;
use common\models\Movie;
use common\models\MoviePhoto;
use backend\modules\content\models\MovieSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MovieController implements the CRUD actions for Movie model.
 */
class MovieController extends Controller
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
     * Lists all Movie models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MovieSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Movie model.
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
     * Creates a new Movie model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Movie();
        $modelDetails = [];
        $formDetails = Yii::$app->request->post('MoviePhoto', []);
        foreach ($formDetails as $i => $formDetail) {
            $modelDetail = new MoviePhoto(['scenario' => MoviePhoto::SCENARIO_BATCH_UPDATE]);
            $modelDetail->setAttributes($formDetail);
            $modelDetails[] = $modelDetail;
        }

        //handling if the addRow button has been pressed
        if (Yii::$app->request->post('addRowPhoto') == 'true') {
            $model->load(Yii::$app->request->post());
            $modelDetails[] = new MoviePhoto(['scenario' => MoviePhoto::SCENARIO_BATCH_UPDATE]);
            $modelDetails[] = new MoviePhoto(['scenario' => MoviePhoto::SCENARIO_BATCH_UPDATE]);

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

                    $unique_name = "movie_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/movie/' . $path);
                }
                $model->save();
                //  print_r($model);
                if (Model::validateMultiple($modelDetails)) {


                    foreach ($modelDetails as $c => $modelDetail) {

                        ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'movie_photo');
                        if (isset(${'profile_file' . $c}->size) && ${'profile_file' . $c}->size != 0) {

                            $unique_name = "movie_" . date("Y-m-d_H-i-s") . "_". uniqid();
                            $path = $unique_name . ".{${'profile_file' . $c}->extension}";
                            $modelDetail->photo_url = $path;
                            ${'profile_file' . $c}->saveAs('uploads/movie/related_photo/' . $path);
                            $modelDetail->movie_id = $model->id;
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
     * Updates an existing Movie model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelDetails = $model->moviePhotos;

        $formDetails = Yii::$app->request->post('MoviePhoto', []);
        foreach ($formDetails as $i => $formDetail) {
            //loading the models if they are not new
            if (isset($formDetail['id']) && isset($formDetail['updateType']) && $formDetail['updateType'] != MoviePhoto::UPDATE_TYPE_CREATE) {
                //making sure that it is actually a child of the main model
                $modelDetail = MoviePhoto::findOne(['id' => $formDetail['id'], 'movie_id' => $model->id]);
                $modelDetail->setScenario(MoviePhoto::SCENARIO_BATCH_UPDATE);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[$i] = $modelDetail;
                //validate here if the modelDetail loaded is valid, and if it can be updated or deleted
            } else {
                $modelDetail = new MoviePhoto(['scenario' => MoviePhoto::SCENARIO_BATCH_UPDATE]);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[] = $modelDetail;
            }

        }


        //handling if the addRow button has been pressed
        if (Yii::$app->request->post('addRowPhoto') == 'true') {
            $modelDetails[] = new MoviePhoto(['scenario' => MoviePhoto::SCENARIO_BATCH_UPDATE]);
            $modelDetails[] = new MoviePhoto(['scenario' => MoviePhoto::SCENARIO_BATCH_UPDATE]);

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
                    //   $file->saveAs('uploads/movie/' . $file->baseName . '.' . $file->extension);
                    $old_name = $model->main_photo;
                    $unique_name = "movie_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/movie/' . $path);
                    if (isset($old_name)) {
                        unlink('uploads/movie/' . $old_name);
                    } else {
                        // Do nothing
                    }
                }
                $model->save();
                foreach ($modelDetails as $c => $modelDetail) {
                    //details that has been flagged for deletion will be deleted
                    if ($modelDetail->updateType == MoviePhoto::UPDATE_TYPE_DELETE) {
                        $modelDetail->delete();
                    } else {
                        //new or updated records go here
                        ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'movie_photo');
                        if (isset(${'profile_file' . $c}->size) && ${'profile_file' . $c}->size != 0) {
                            //    $modelDetail->photo_url = ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension;
                            //   ${'profile_file' . $c}->saveAs('uploads/movie/related_photo/' . ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension);
                            $old_name = $modelDetail->photo_url;
                            $unique_name = "movie_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                            $path = $unique_name . ".{${'profile_file' . $c}->extension}";
                            $modelDetail->photo_url = $path;
                            ${'profile_file' . $c}->saveAs('uploads/movie/related_photo/' . $path);
                            if (isset($old_name)) {
                                unlink('uploads/movie/related_photo/' . $old_name);
                            } else {
                                // Do nothing
                            }
                            $modelDetail->movie_id = $model->id;
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
         $modelDetails = $model->moviePhotos;

         $formDetails = Yii::$app->request->post('MoviePhoto', []);
         foreach ($formDetails as $i => $formDetail) {
             //loading the models if they are not new
             if (isset($formDetail['id']) && isset($formDetail['updateType']) && $formDetail['updateType'] != MoviePhoto::UPDATE_TYPE_CREATE) {
                 //making sure that it is actually a child of the main model
                 $modelDetail = MoviePhoto::findOne(['id' => $formDetail['id'], 'movie_id' => $model->id]);
                 $modelDetail->setScenario(MoviePhoto::SCENARIO_BATCH_UPDATE);
                 $modelDetail->setAttributes($formDetail);
                 $modelDetails[$i] = $modelDetail;
                 //validate here if the modelDetail loaded is valid, and if it can be updated or deleted
             } else {
                 $modelDetail = new MoviePhoto(['scenario' => MoviePhoto::SCENARIO_BATCH_UPDATE]);
                 $modelDetail->setAttributes($formDetail);
                 $modelDetails[] = $modelDetail;
             }

         }

         //handling if the addRow button has been pressed
         if (Yii::$app->request->post('addRow') == 'true') {
             $modelDetails[] = new MoviePhoto(['scenario' => MoviePhoto::SCENARIO_BATCH_UPDATE]);
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
                 $file->saveAs('uploads/movie/' . $file->baseName . '.' . $file->extension);
             }
             $model->save();
             if (Model::validateMultiple($modelDetails)) {
             //    print_r($modelDetails);
                 foreach ($modelDetails as $c => $modelDetail) {

                     //details that has been flagged for deletion will be deleted
                     if ($modelDetail->updateType == MoviePhoto::UPDATE_TYPE_DELETE) {
                         $modelDetail->delete();
                     } else {
                         //new or updated records go here
                         ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'movie_photo');
                         if (${'profile_file' . $c}->size != 0) {
                             $modelDetail->photo_url = ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension;
                             ${'profile_file' . $c}->saveAs('uploads/movie/related_photo/' . ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension);
                         }
                         $modelDetail->movie_id = $model->id;
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
     * Deletes an existing Movie model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $movie_langs = $this->findModel($id)->getMovieLangs()->where(['movie_id' => $id])->all();
        foreach ($movie_langs as $movie_lang) {
            $movie_lang->delete();
        }
        $movie_photos = $this->findModel($id)->getMoviePhotos()->where(['movie_id' => $id])->all();
        foreach ($movie_photos as $movie_photo) {
            unlink('uploads/movie/related_photo/' . $movie_photo->photo_url);
            $movie_photo->delete();
        }
        if (isset($this->findModel($id)->main_photo)) {
            unlink('uploads/movie/' . $this->findModel($id)->main_photo);
        } else {

        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Movie model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Movie the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Movie::find()->multilingual()->where(['movie.id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }


}

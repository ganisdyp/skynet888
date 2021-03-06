<?php

namespace backend\modules\content\controllers;

use Yii;
use yii\base\Model;
use common\models\Character;
use common\models\CharacterPhoto;
use backend\modules\content\models\CharacterSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CharacterController implements the CRUD actions for Character model.
 */
class CharacterController extends Controller
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
     * Lists all Character models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CharacterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Character model.
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
     * Creates a new Character model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Character();
        $modelDetails = [];
        $formDetails = Yii::$app->request->post('CharacterPhoto', []);
        foreach ($formDetails as $i => $formDetail) {
            $modelDetail = new CharacterPhoto(['scenario' => CharacterPhoto::SCENARIO_BATCH_UPDATE]);
            $modelDetail->setAttributes($formDetail);
            $modelDetails[] = $modelDetail;
        }

        //handling if the addRow button has been pressed
        if (Yii::$app->request->post('addRowPhoto') == 'true') {
            $model->load(Yii::$app->request->post());
            $modelDetails[] = new CharacterPhoto(['scenario' => CharacterPhoto::SCENARIO_BATCH_UPDATE]);
            $modelDetails[] = new CharacterPhoto(['scenario' => CharacterPhoto::SCENARIO_BATCH_UPDATE]);

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

                    $unique_name = "character_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/character/' . $path);
                }
                $model->save();
                //  print_r($model);
                if (Model::validateMultiple($modelDetails)) {


                    foreach ($modelDetails as $c => $modelDetail) {

                        ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'character_photo');
                        if (isset(${'profile_file' . $c}->size) && ${'profile_file' . $c}->size != 0) {

                            $unique_name = "character_" . date("Y-m-d_H-i-s") . "_". uniqid();
                            $path = $unique_name . ".{${'profile_file' . $c}->extension}";
                            $modelDetail->photo_url = $path;
                            ${'profile_file' . $c}->saveAs('uploads/character/related_photo/' . $path);
                            $modelDetail->character_id = $model->id;
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
     * Updates an existing Character model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelDetails = $model->characterPhotos;

        $formDetails = Yii::$app->request->post('CharacterPhoto', []);
        foreach ($formDetails as $i => $formDetail) {
            //loading the models if they are not new
            if (isset($formDetail['id']) && isset($formDetail['updateType']) && $formDetail['updateType'] != CharacterPhoto::UPDATE_TYPE_CREATE) {
                //making sure that it is actually a child of the main model
                $modelDetail = CharacterPhoto::findOne(['id' => $formDetail['id'], 'character_id' => $model->id]);
                $modelDetail->setScenario(CharacterPhoto::SCENARIO_BATCH_UPDATE);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[$i] = $modelDetail;
                //validate here if the modelDetail loaded is valid, and if it can be updated or deleted
            } else {
                $modelDetail = new CharacterPhoto(['scenario' => CharacterPhoto::SCENARIO_BATCH_UPDATE]);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[] = $modelDetail;
            }

        }


        //handling if the addRow button has been pressed
        if (Yii::$app->request->post('addRowPhoto') == 'true') {
            $modelDetails[] = new CharacterPhoto(['scenario' => CharacterPhoto::SCENARIO_BATCH_UPDATE]);
            $modelDetails[] = new CharacterPhoto(['scenario' => CharacterPhoto::SCENARIO_BATCH_UPDATE]);

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
                    //   $file->saveAs('uploads/character/' . $file->baseName . '.' . $file->extension);
                    $old_name = $model->main_photo;
                    $unique_name = "character_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/character/' . $path);
                    if (isset($old_name)) {
                        if($old_name==''){

                        }else{
                        unlink('uploads/character/' . $old_name);
                        }
                    } else {
                        // Do nothing
                    }
                }
                $model->save();
                foreach ($modelDetails as $c => $modelDetail) {
                    //details that has been flagged for deletion will be deleted
                    if ($modelDetail->updateType == CharacterPhoto::UPDATE_TYPE_DELETE) {
                        $modelDetail->delete();
                    } else {
                        //new or updated records go here
                        ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'character_photo');
                        if (isset(${'profile_file' . $c}->size) && ${'profile_file' . $c}->size != 0) {
                            //    $modelDetail->photo_url = ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension;
                            //   ${'profile_file' . $c}->saveAs('uploads/character/related_photo/' . ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension);
                            $old_name = $modelDetail->photo_url;
                            $unique_name = "character_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                            $path = $unique_name . ".{${'profile_file' . $c}->extension}";
                            $modelDetail->photo_url = $path;
                            ${'profile_file' . $c}->saveAs('uploads/character/related_photo/' . $path);
                            if (isset($old_name)) {
                                unlink('uploads/character/related_photo/' . $old_name);
                            } else {
                                // Do nothing
                            }
                            $modelDetail->character_id = $model->id;
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
         $modelDetails = $model->characterPhotos;

         $formDetails = Yii::$app->request->post('CharacterPhoto', []);
         foreach ($formDetails as $i => $formDetail) {
             //loading the models if they are not new
             if (isset($formDetail['id']) && isset($formDetail['updateType']) && $formDetail['updateType'] != CharacterPhoto::UPDATE_TYPE_CREATE) {
                 //making sure that it is actually a child of the main model
                 $modelDetail = CharacterPhoto::findOne(['id' => $formDetail['id'], 'character_id' => $model->id]);
                 $modelDetail->setScenario(CharacterPhoto::SCENARIO_BATCH_UPDATE);
                 $modelDetail->setAttributes($formDetail);
                 $modelDetails[$i] = $modelDetail;
                 //validate here if the modelDetail loaded is valid, and if it can be updated or deleted
             } else {
                 $modelDetail = new CharacterPhoto(['scenario' => CharacterPhoto::SCENARIO_BATCH_UPDATE]);
                 $modelDetail->setAttributes($formDetail);
                 $modelDetails[] = $modelDetail;
             }

         }

         //handling if the addRow button has been pressed
         if (Yii::$app->request->post('addRow') == 'true') {
             $modelDetails[] = new CharacterPhoto(['scenario' => CharacterPhoto::SCENARIO_BATCH_UPDATE]);
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
                 $file->saveAs('uploads/character/' . $file->baseName . '.' . $file->extension);
             }
             $model->save();
             if (Model::validateMultiple($modelDetails)) {
             //    print_r($modelDetails);
                 foreach ($modelDetails as $c => $modelDetail) {

                     //details that has been flagged for deletion will be deleted
                     if ($modelDetail->updateType == CharacterPhoto::UPDATE_TYPE_DELETE) {
                         $modelDetail->delete();
                     } else {
                         //new or updated records go here
                         ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'character_photo');
                         if (${'profile_file' . $c}->size != 0) {
                             $modelDetail->photo_url = ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension;
                             ${'profile_file' . $c}->saveAs('uploads/character/related_photo/' . ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension);
                         }
                         $modelDetail->character_id = $model->id;
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
     * Deletes an existing Character model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $character_langs = $this->findModel($id)->getCharacterLangs()->where(['character_id' => $id])->all();
        foreach ($character_langs as $character_lang) {
            $character_lang->delete();
        }
        $character_photos = $this->findModel($id)->getCharacterPhotos()->where(['character_id' => $id])->all();
        foreach ($character_photos as $character_photo) {
            unlink('uploads/character/related_photo/' . $character_photo->photo_url);
            $character_photo->delete();
        }
        if (isset($this->findModel($id)->main_photo)) {
            unlink('uploads/character/' . $this->findModel($id)->main_photo);
        } else {

        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Character model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Character the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Character::find()->multilingual()->where(['character.id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }

    function actionLoadcharacter()
    {

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();;
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $out = [];
            if (isset($data['project_id'])) {
                $project_id = $data['project_id'];
                $searchModel_character = new CharacterSearch();
                $dataProvider_character = $searchModel_character->search(Yii::$app->request->queryParams);
                $characters = $dataProvider_character->query->where(['project_id' => $project_id])->all();
                if (isset($characters)) {
                    foreach ($characters as $character) {

                        $out[] = $character->id.' ||| '.$character->main_photo;
                    }
                } else {
                    $characters = null;
                    $out[] = $characters;
                }

            }
            return $out;
        }
    }

}

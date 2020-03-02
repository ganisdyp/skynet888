<?php

namespace common\models;

use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $main_photo
 *
 * @property Blog[] $activities
 * @property ProjectLang[] $projectLangs
 * @property Character[] $characters
 */
class Project extends \yii\db\ActiveRecord
{
    public $main_photo_file;

    public function behaviors()
    {
        return [
            'ml' => [
                'class' => MultilingualBehavior::className(),
                'languages' => [
                    'th' => 'Thai',
                    'en' => 'English',
                ],
                'requireTranslations' => true,
                'langClassName' => ProjectLang::className(),
                'defaultLanguage' => 'en',
                'langForeignKey' => 'project_id',
                'tableName' => "{{%project_lang}}",
                'attributes' => ['name', 'description']

            ],
            //  TimestampBehavior::className(),
            //  BlameableBehavior::className(),
        ];
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['name', 'description'], 'required'],
            [['main_photo', 'name', 'status'], 'string', 'max' => 100],
            [['main_photo_file'], 'file', 'skipOnEmpty' => true, 'on' => 'update', 'extensions' => 'jpg,png,gif'],
            [['description'], 'string'],


        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'id' => Yii::t('common', 'ID'),
            'main_photo' => Yii::t('common', 'Main Photo'),
            'status' => Yii::t('common', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectLangs()
    {
        return $this->hasMany(ProjectLang::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStory()
    {
        return $this->hasOne(Story::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacters()
    {
        return $this->hasMany(Character::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnvironments()
    {
        return $this->hasMany(Environment::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovies()
    {
        return $this->hasMany(Movie::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScreenshots()
    {
        return $this->hasMany(Screenshot::className(), ['project_id' => 'id']);
    }

    public function getProjectPhotos()
    {
        return $this->hasMany(ProjectPhoto::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blog::className(), ['project_id' => 'id']);
    }

}

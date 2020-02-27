<?php

namespace common\models;

use Yii;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;

/**
 * This is the model class for table "story".
 *
 * @property int $id
 * @property int $project_id
 * @property int $story_type_id
 * @property string $date_published
 * @property string $main_photo
 * @property string $keyword
 * @property int $media_type
 * @property string $from_date
 * @property string $to_date
 *
 * @property Project $project
 * @property StoryLang[] $storyLangs
 * @property StoryPhoto[] $storyPhotos
 */
class Story extends \yii\db\ActiveRecord
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
                'langClassName' => StoryLang::className(),
                'defaultLanguage' => 'en',
                'langForeignKey' => 'story_id',
                'tableName' => "{{%story_lang}}",
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
        return 'story';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id','name', 'description'], 'required'],
            [['project_id','media_type'], 'integer'],
            [['date_published'], 'safe'],
            [['description'], 'string'],
            [['main_photo', 'name'], 'string', 'max' => 100],
            [['main_photo_file'],'file','skipOnEmpty' => true, 'on' => 'update', 'extensions' => 'jpg,png,gif'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'project_id' => Yii::t('common', 'Project ID'),
            'date_published' => Yii::t('common', 'Date Published'),
            'main_photo' => Yii::t('common', 'Main Photo'),
            'media_type' => Yii::t('common', 'Media Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoryLangs()
    {
        return $this->hasMany(StoryLang::className(), ['story_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoryPhotos()
    {
        return $this->hasMany(StoryPhoto::className(), ['story_id' => 'id']);
    }
}

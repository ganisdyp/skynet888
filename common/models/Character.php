<?php

namespace common\models;

use Yii;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;

/**
 * This is the model class for table "character".
 *
 * @property int $id
 * @property int $project_id
 * @property int $character_type_id
 * @property string $date_published
 * @property string $main_photo
 * @property string $keyword
 * @property int $media_type
 * @property string $from_date
 * @property string $to_date
 *
 * @property Project $project
 * @property CharacterLang[] $characterLangs
 * @property CharacterPhoto[] $characterPhotos
 */
class Character extends \yii\db\ActiveRecord
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
                'langClassName' => CharacterLang::className(),
                'defaultLanguage' => 'en',
                'langForeignKey' => 'character_id',
                'tableName' => "{{%character_lang}}",
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
        return 'character';
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
    public function getCharacterLangs()
    {
        return $this->hasMany(CharacterLang::className(), ['character_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacterPhotos()
    {
        return $this->hasMany(CharacterPhoto::className(), ['character_id' => 'id']);
    }
}

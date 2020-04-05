<?php

namespace common\models;

use Yii;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;

/**
 * This is the model class for table "home_content".
 *
 * @property int $id
 * @property string $date_published
 *
 * @property HomeLang[] $homeLangs
 * @property HomePhoto[] $homePhotos
 */
class Home extends \yii\db\ActiveRecord
{
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
                'langClassName' => HomeLang::className(),
                'defaultLanguage' => 'en',
                'langForeignKey' => 'home_id',
                'tableName' => "{{%home_lang}}",
                'attributes' => ['content']

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
        return 'home';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['content'], 'string'],
            [['date_published'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'date_published' => Yii::t('common', 'Date Published'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHomeLangs()
    {
        return $this->hasMany(HomeLang::className(), ['home_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHomePhotos()
    {
        return $this->hasMany(HomePhoto::className(), ['home_id' => 'id']);
    }
}

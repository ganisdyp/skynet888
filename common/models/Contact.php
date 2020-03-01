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
 * @property ContactLang[] $contactLangs
 * @property AboutPhoto[] $contactPhotos
 */
class Contact extends \yii\db\ActiveRecord
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
                'langClassName' => ContactLang::className(),
                'defaultLanguage' => 'en',
                'langForeignKey' => 'contact_id',
                'tableName' => "{{%contact_lang}}",
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
        return 'contact';
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
    public function getContactLangs()
    {
        return $this->hasMany(ContactLang::className(), ['contact_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactPhotos()
    {
        return $this->hasMany(ContactPhoto::className(), ['contact_id' => 'id']);
    }
}

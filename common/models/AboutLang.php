<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "home_content_lang".
 *
 * @property int $id
 * @property string $content
 * @property string $language
 * @property int $about_id
 *
 * @property About $about
 */
class AboutLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'about_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'language', 'about_id'], 'required'],
            [['about_id'], 'integer'],
            [['content'], 'string'],
            [['language'], 'string', 'max' => 10],
          //  [['id', 'home_content_id'], 'unique', 'targetAttribute' => ['id', 'home_content_id']],
            [['about_id'], 'exist', 'skipOnError' => true, 'targetClass' => About::className(), 'targetAttribute' => ['about_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'content' => Yii::t('common', 'Content'),
            'language' => Yii::t('common', 'Language'),
            'about_id' => Yii::t('common', 'About ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbout()
    {
        return $this->hasOne(About::className(), ['id' => 'about_id']);
    }
}

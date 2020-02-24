<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "home_content_lang".
 *
 * @property int $id
 * @property string $headline
 * @property string $content
 * @property string $language
 * @property int $home_content_id
 *
 * @property HomeContent $homeContent
 */
class HomeContentLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'home_content_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['headline', 'content', 'language', 'home_content_id'], 'required'],
            [['home_content_id'], 'integer'],
            [['content','headline'], 'string'],
            [['language'], 'string', 'max' => 10],
          //  [['id', 'home_content_id'], 'unique', 'targetAttribute' => ['id', 'home_content_id']],
            [['home_content_id'], 'exist', 'skipOnError' => true, 'targetClass' => HomeContent::className(), 'targetAttribute' => ['home_content_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'headline' => Yii::t('common', 'Headline'),
            'content' => Yii::t('common', 'Content'),
            'language' => Yii::t('common', 'Language'),
            'home_content_id' => Yii::t('common', 'Home Content ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHomeContent()
    {
        return $this->hasOne(HomeContent::className(), ['id' => 'home_content_id']);
    }
}

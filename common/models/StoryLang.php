<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "story_lang".
 *
 * @property int $id
 * @property int $story_id
 * @property string $name
 * @property string $description
 * @property string $language
 *
 * @property Story $story
 */
class StoryLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'story_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['story_id', 'name', 'description', 'language'], 'required'],
            [['story_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['language'], 'string', 'max' => 10],
            [['story_id'], 'exist', 'skipOnError' => true, 'targetClass' => Story::className(), 'targetAttribute' => ['story_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'story_id' => Yii::t('common', 'Story ID'),
            'name' => Yii::t('common', 'Name'),
            'description' => Yii::t('common', 'Description'),
            'language' => Yii::t('common', 'Language'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStory()
    {
        return $this->hasOne(Story::className(), ['id' => 'story_id']);
    }
}

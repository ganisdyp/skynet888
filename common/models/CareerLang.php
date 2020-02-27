<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "home_content_lang".
 *
 * @property int $id
 * @property string $content
 * @property string $language
 * @property int $career_id
 *
 * @property Career $career
 */
class CareerLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'career_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'language', 'career_id'], 'required'],
            [['career_id'], 'integer'],
            [['content'], 'string'],
            [['language'], 'string', 'max' => 10],
          //  [['id', 'home_content_id'], 'unique', 'targetAttribute' => ['id', 'home_content_id']],
            [['career_id'], 'exist', 'skipOnError' => true, 'targetClass' => Career::className(), 'targetAttribute' => ['career_id' => 'id']],
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
            'career_id' => Yii::t('common', 'Career ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCareer()
    {
        return $this->hasOne(Career::className(), ['id' => 'career_id']);
    }
}

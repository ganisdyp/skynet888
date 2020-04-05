<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "home_content_lang".
 *
 * @property int $id
 * @property string $content
 * @property string $language
 * @property int $home_id
 *
 * @property Home $home
 */
class HomeLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'home_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'language', 'home_id'], 'required'],
            [['home_id'], 'integer'],
            [['content'], 'string'],
            [['language'], 'string', 'max' => 10],
          //  [['id', 'home_content_id'], 'unique', 'targetAttribute' => ['id', 'home_content_id']],
            [['home_id'], 'exist', 'skipOnError' => true, 'targetClass' => Home::className(), 'targetAttribute' => ['home_id' => 'id']],
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
            'home_id' => Yii::t('common', 'Home ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHome()
    {
        return $this->hasOne(Home::className(), ['id' => 'home_id']);
    }
}

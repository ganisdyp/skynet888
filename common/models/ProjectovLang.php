<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "home_content_lang".
 *
 * @property int $id
 * @property string $content
 * @property string $language
 * @property int $projectov_id
 *
 * @property Projectov $projectov
 */
class ProjectovLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projectov_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'language', 'projectov_id'], 'required'],
            [['projectov_id'], 'integer'],
            [['content'], 'string'],
            [['language'], 'string', 'max' => 10],
          //  [['id', 'home_content_id'], 'unique', 'targetAttribute' => ['id', 'home_content_id']],
            [['projectov_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projectov::className(), 'targetAttribute' => ['projectov_id' => 'id']],
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
            'projectov_id' => Yii::t('common', 'Projectov ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectov()
    {
        return $this->hasOne(Projectov::className(), ['id' => 'projectov_id']);
    }
}

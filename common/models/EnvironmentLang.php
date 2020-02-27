<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "environment_lang".
 *
 * @property int $id
 * @property int $environment_id
 * @property string $name
 * @property string $description
 * @property string $language
 *
 * @property Environment $environment
 */
class EnvironmentLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'environment_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['environment_id', 'name', 'description', 'language'], 'required'],
            [['environment_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['language'], 'string', 'max' => 10],
            [['environment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Environment::className(), 'targetAttribute' => ['environment_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'environment_id' => Yii::t('common', 'Environment ID'),
            'name' => Yii::t('common', 'Name'),
            'description' => Yii::t('common', 'Description'),
            'language' => Yii::t('common', 'Language'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnvironment()
    {
        return $this->hasOne(Environment::className(), ['id' => 'environment_id']);
    }
}

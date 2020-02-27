<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "character_lang".
 *
 * @property int $id
 * @property int $character_id
 * @property string $name
 * @property string $description
 * @property string $language
 *
 * @property Character $character
 */
class CharacterLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'character_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['character_id', 'name', 'description', 'language'], 'required'],
            [['character_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['language'], 'string', 'max' => 10],
            [['character_id'], 'exist', 'skipOnError' => true, 'targetClass' => Character::className(), 'targetAttribute' => ['character_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'character_id' => Yii::t('common', 'Character ID'),
            'name' => Yii::t('common', 'Name'),
            'description' => Yii::t('common', 'Description'),
            'language' => Yii::t('common', 'Language'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacter()
    {
        return $this->hasOne(Character::className(), ['id' => 'character_id']);
    }
}

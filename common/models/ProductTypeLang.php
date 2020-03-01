<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "character_type_lang".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $character_type_id
 * @property string $language
 *
 * @property CharacterType $characterType
 */
class CharacterTypeLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'character_type_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'character_type_id', 'language'], 'required'],
            [['description'], 'string'],
            [['character_type_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['language'], 'string', 'max' => 10],
            [['character_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CharacterType::className(), 'targetAttribute' => ['character_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'name' => Yii::t('common', 'Name'),
            'description' => Yii::t('common', 'Description'),
            'character_type_id' => Yii::t('common', 'Character Type ID'),
            'language' => Yii::t('common', 'Language'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacterType()
    {
        return $this->hasOne(CharacterType::className(), ['id' => 'character_type_id']);
    }
}

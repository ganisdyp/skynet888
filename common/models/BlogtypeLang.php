<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_type_lang".
 *
 * @property int $id
 * @property int $blog_type_id
 * @property string $name
 * @property string $description
 * @property string $language
 *
 * @property Blogtype $blogType
 */
class BlogtypeLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_type_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blog_type_id', 'name', 'language'], 'required'],
            [['blog_type_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['language'], 'string', 'max' => 10],
            [['blog_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Blogtype::className(), 'targetAttribute' => ['blog_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'blog_type_id' => Yii::t('common', 'Blog Type ID'),
            'name' => Yii::t('common', 'Name'),
            'description' => Yii::t('common', 'Description'),
            'language' => Yii::t('common', 'Language'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogType()
    {
        return $this->hasOne(Blogtype::className(), ['id' => 'blog_type_id']);
    }
}

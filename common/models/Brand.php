<?php

namespace common\models;

use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property int $id
 * @property string $code
 * @property string $main_photo
 *
 * @property Blog[] $activities
 * @property BrandLang[] $brandLangs
 * @property Product[] $products
 */
class Brand extends \yii\db\ActiveRecord
{
    public $main_photo_file;
    public function behaviors()
    {
        return [
            'ml' => [
                'class' => MultilingualBehavior::className(),
                'languages' => [
                    'th' => 'Thai',
                    'en' => 'English',
                ],
                'requireTranslations' => true,
                'langClassName' => BrandLang::className(),
                'defaultLanguage' => 'en',
                'langForeignKey' => 'brand_id',
                'tableName' => "{{%brand_lang}}",
                'attributes' => ['name', 'description']

            ],
          //  TimestampBehavior::className(),
          //  BlameableBehavior::className(),
        ];
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['code','name','description'], 'required'],
            [['code'], 'string', 'max' => 45],
            [['main_photo','name'], 'string', 'max' => 100],
            [['main_photo_file'],'file','skipOnEmpty' => true, 'on' => 'update', 'extensions' => 'jpg,png,gif'],
            [['description'], 'string'],


        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'id' => Yii::t('common', 'ID'),
            'code' => Yii::t('common', 'Code'),
            'main_photo' => Yii::t('common', 'Main Photo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrandLangs()
    {
        return $this->hasMany(BrandLang::className(), ['brand_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['brand_id' => 'id']);
    }

    public function getBrandPhotos()
    {
        return $this->hasMany(BrandPhoto::className(), ['brand_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Blog::className(), ['brand_id' => 'id']);
    }
}

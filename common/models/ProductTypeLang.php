<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_type_lang".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $product_type_id
 * @property string $language
 *
 * @property ProductType $productType
 */
class ProductTypeLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_type_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'product_type_id', 'language'], 'required'],
            [['description'], 'string'],
            [['product_type_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['language'], 'string', 'max' => 10],
            [['product_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['product_type_id' => 'id']],
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
            'product_type_id' => Yii::t('common', 'Product Type ID'),
            'language' => Yii::t('common', 'Language'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductType()
    {
        return $this->hasOne(ProductType::className(), ['id' => 'product_type_id']);
    }
}

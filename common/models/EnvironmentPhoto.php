<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "environment_photo".
 *
 * @property int $id
 * @property string $photo_url
 * @property int $environment_id
 *
 * @property Environment $environment
 */
class EnvironmentPhoto extends \yii\db\ActiveRecord
{

    const UPDATE_TYPE_CREATE = 'create';
    const UPDATE_TYPE_UPDATE = 'update';
    const UPDATE_TYPE_DELETE = 'delete';
    const SCENARIO_BATCH_UPDATE = 'batchUpdate';
    private $_updateType;
    public $environment_photo;
    public function getUpdateType()
    {
        if (empty($this->_updateType)) {
            if ($this->isNewRecord) {
                $this->_updateType = self::UPDATE_TYPE_CREATE;
            } else {
                $this->_updateType = self::UPDATE_TYPE_UPDATE;
            }
        }
        return $this->_updateType;
    }
    public function setUpdateType($value)
    {
        $this->_updateType = $value;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'environment_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['updateType', 'required', 'on' => self::SCENARIO_BATCH_UPDATE],
            ['updateType',
                'in',
                'range' => [self::UPDATE_TYPE_CREATE, self::UPDATE_TYPE_UPDATE, self::UPDATE_TYPE_DELETE],
                'on' => self::SCENARIO_BATCH_UPDATE
            ],
            [['environment_id'], 'required','except' => self::SCENARIO_BATCH_UPDATE],
            [['environment_id'], 'integer'],
            [['environment_photo'],'file','skipOnEmpty' => true, 'on' => 'update', 'extensions' => 'jpg,png,gif'],
            [['photo_url'], 'string', 'max' => 100],
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
            'photo_url' => Yii::t('common', 'Environment Url'),
            'environment_id' => Yii::t('common', 'Environment ID'),
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

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "screenshot".
 *
 * @property int $id
 * @property int $project_id
 * @property string $date_published
 * @property int $media_type
 * @property string $main_photo
 *
 * @property Project $project
 */
class Screenshot extends \yii\db\ActiveRecord
{
    public $main_photo_file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'screenshot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id'], 'required'],
            [['project_id', 'media_type'], 'integer'],
            [['date_published'], 'safe'],
            [['main_photo'], 'string', 'max' => 100],
            [['main_photo_file'],'file','skipOnEmpty' => true, 'on' => 'update', 'extensions' => 'jpg,png,gif'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'date_published' => 'Date Published',
            'media_type' => 'Media Type',
            'main_photo' => 'Main Photo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}

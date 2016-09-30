<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property integer $task_type_id
 * @property integer $name
 *
 * @property TaskType $taskType
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['task_type_id', 'required', 'message' => 'Please add default task type'],
            ['name', 'required'],
            [['task_type_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['task_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskType::className(), 'targetAttribute' => ['task_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_type_id' => 'Task Type',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskType()
    {
        return $this->hasOne(TaskType::className(), ['id' => 'task_type_id']);
    }
}

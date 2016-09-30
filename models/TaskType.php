<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task_type".
 *
 * @property integer $id
 * @property string $name
 * @property integer $position
 * @property integer $is_default
 *
 * @property Task[] $tasks
 */
class TaskType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'position'], 'required'],
            [['position', 'is_default'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'position' => 'Position',
            'is_default' => 'is_default',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['task_type_id' => 'id']);
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes){
        parent::afterSave($insert, $changedAttributes);
        if($this->is_default) {
            TaskType::updateAll(['is_default' => 0], 'id!=:id', [':id' => $this->id]);
        }
    }

}

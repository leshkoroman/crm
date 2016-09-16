<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task_types".
 *
 * @property integer $id
 * @property string $name
 */
class TaskTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @inheritdoc
     * @return TaskTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaskTypesQuery(get_called_class());
    }
}

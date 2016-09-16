<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "manager_task".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_agent
 * @property integer $status
 * @property integer $id_type_task
 * @property string $date_add
 * @property integer $date_to
 * @property string $comment
 */
class ManagerTask extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manager_task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_agent', 'status', 'id_type_task', 'date_to', 'comment'], 'required'],
            [['id_user', 'id_agent', 'status', 'id_type_task', 'date_to'], 'integer'],
            [['date_add'], 'safe'],
            [['comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_agent' => 'Id Agent',
            'status' => 'Status',
            'id_type_task' => 'Id Type Task',
            'date_add' => 'Date Add',
            'date_to' => 'Date To',
            'comment' => 'Comment',
        ];
    }

    /**
     * @inheritdoc
     * @return ManagerTaskQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ManagerTaskQuery(get_called_class());
    }
}

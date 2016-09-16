<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "manager_comments".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_agent
 * @property string $comment
 * @property string $date_add
 */
class ManagerComments extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'manager_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id_user', 'id_agent', 'comment'], 'required'],
            [['id_user', 'id_agent'], 'integer'],
            [['date_add'], 'safe'],
            [['comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_agent' => 'Id Agent',
            'comment' => 'Comment',
            'date_add' => 'Date Add',
        ];
    }

    /**
     * @inheritdoc
     * @return ManagerCommentsQuery the active query used by this AR class.
     */
    public static function find() {
        return new ManagerCommentsQuery(get_called_class());
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
    
    public function getAgent() {
        return $this->hasOne(Agents::className(), ['id' => 'id_agent']);
    }

}

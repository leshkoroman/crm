<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users_access_control".
 *
 * @property integer $id
 * @property integer $id_system 1 - mera 2 - vitrina
 * @property integer $id_user
 * @property string $date_begin
 * @property string $firstname
 * @property string $surname
 * @property string $middlename
 * @property string $phone_1
 * @property string $phone_2
 * @property string $phone_3
 * @property integer $date_end_object
 * @property integer $date_end_calls
 */
class MeraUsersAccessControl extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'users_access_control';
    }


    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db2');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id_system', 'id_user', 'firstname', 'surname', 'middlename', 'phone_1', 'phone_2', 'phone_3', 'date_end_object', 'date_end_calls'], 'required'],
            [['id_system', 'id_user', 'date_end_object', 'date_end_calls'], 'integer'],
            [['date_begin'], 'safe'],
            [['firstname', 'surname', 'middlename'], 'string', 'max' => 50],
            [['phone_1', 'phone_2', 'phone_3'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'id_system' => '1-мера, 2-витрина',
            'id_user' => 'Агент', // с таблички merapoisk_settings.users  model Agents
            'date_begin' => 'Дата создания',
            //'date_end' => 'Дата окончания', не используем
            //'sum' => 'Sum', не используем
            //'date_add' => 'Date Add', не используем
            'firstname' => 'Имя',
            'surname' => 'Фамилия',
            'middlename' => 'Отчество',
            'phone_1' => 'тел 1',
            'phone_2' => 'тел 2',
            'phone_3' => 'тел 1',
            //'email_password' => 'Email Password', не используем
            //'date_end_client' => 'Date End Client', не используем
            'date_end_object' => 'Дата доступа к объектам',
            'date_end_calls' => 'Дата доступа к рекламе',
        ];
    }

    /**
     * @inheritdoc
     * @return MeraUsersAccessControlQuery the active query used by this AR class.
     */
    public static function find() {
        return new MeraUsersAccessControlQuery(get_called_class());
    }

}

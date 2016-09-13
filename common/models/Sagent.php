<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sagent".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $phone
 * @property string $email
 * @property string $domain
 * @property string $type_name
 * @property string $agent_info
 * @property string $vk_app_id
 * @property string $date_add
 * @property string $agent_header
 * @property string $phone_2
 * @property integer $status
 * @property string $site_header1
 * @property string $site_header2
 * @property string $g_link
 * @property string $v_link
 * @property string $t_link
 * @property string $f_link
 */
class Sagent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sagent';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user',], 'required'],
            [['id_user', 'status'], 'integer'],
            [['agent_info'], 'string'],
            [['date_add'], 'safe'],
            [['phone', 'type_name', 'vk_app_id'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
            [['domain'], 'string', 'max' => 80],
            [['agent_header'], 'string', 'max' => 250],
            [['phone_2'], 'string', 'max' => 300],
            [['site_header1', 'site_header2'], 'string', 'max' => 1000],
            [['g_link', 'v_link', 't_link', 'f_link'], 'string', 'max' => 150],
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
            'phone' => 'Phone',
            'email' => 'Email (для заявок)',
            'domain' => 'домен',
            'type_name' => 'Type Name',
            'agent_info' => 'Скрипты, метрика...',
            'vk_app_id' => 'Vk App ID',
            'date_add' => 'Date Add',
            'agent_header' => 'Agent Header',
            'phone_2' => 'Phone 2',
            'status' => 'Статус',
            'site_header1' => 'Оглавления 1',
            'site_header2' => 'Оглавления 2',
            'g_link' => 'Google',
            'v_link' => 'VK',
            't_link' => 'Tvitter',
            'f_link' => 'Facebook',
        ];
    }

    /**
     * @inheritdoc
     * @return SagentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SagentQuery(get_called_class());
    }
}

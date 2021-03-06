<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property integer $id_sex
 * @property string $surname
 * @property string $name
 * @property string $patronymic
 * @property string $phone
 * @property string $email
 * @property string $password
 * @property string $hash
 * @property integer $id_type
 * @property string $date_add
 * @property integer $online
 * @property string $last_computer_info
 * @property string $count_times_view_objects
 * @property integer $objects_rent_limit_phones_daily
 * @property string $count_times_view_objects_archive
 * @property integer $objects_rent_limit_phones_daily_archive
 * @property integer $objects_rent_module
 * @property integer $calls_module
 * @property string $objects_rent_phones
 * @property string $mail_service_email
 * @property string $mail_service_password
 * @property string $mail_service_type
 * @property integer $notify_module
 * @property integer $id_domain
 * @property integer $xml_feed_on_off
 * @property integer $xml_feed_max
 * @property string $vk_login
 * @property string $vk_password
 * @property integer $xml_feed_count_max
 * @property string $ap_login
 * @property string $ap_password
 * @property integer $who_created
 */
class Agents extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'users';
    }

    public function getMeraOnOff() {
        if (isset($this->meraUsersAccessControl->date_end_object) && $this->meraUsersAccessControl->date_end_object > time() && $this->objects_rent_module == 1) {
            return 'вкл';
        } else {
            return 'выкл.';
        }
    }

    public function getSpy() {
        return (isset($this->spyStatistics->date) && $this->spyStatistics->date) ? $this->spyStatistics->date : 'не входил';
    }

    public function getData_to() {
        return date('Y-m-d', $this->meraUsersAccessControl->date_end_object);
    }

    public function getDomain() {
        return (isset($this->meraDomains->domain_name) && $this->meraDomains->domain_name) ? $this->meraDomains->domain_name : 'все';
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
            [['name', 'xml_feed_on_off', 'xml_feed_max', 'who_created'], 'required'],
            [['id_sex', 'id_type', 'online', 'objects_rent_limit_phones_daily', 'objects_rent_limit_phones_daily_archive', 'objects_rent_module', 'calls_module', 'notify_module', 'id_domain', 'xml_feed_on_off', 'xml_feed_max', 'xml_feed_count_max', 'who_created'], 'integer'],
            [['date_add'], 'safe'],
            [['objects_rent_phones'], 'string'],
            [['username', 'surname', 'name', 'patronymic', 'phone'], 'string', 'max' => 50],
            [['email', 'password', 'count_times_view_objects', 'count_times_view_objects_archive', 'mail_service_type'], 'string', 'max' => 100],
            ['email', 'email'],
            [['hash'], 'string', 'max' => 32],
            [['last_computer_info'], 'string', 'max' => 2000],
            [['mail_service_email', 'mail_service_password'], 'string', 'max' => 150],
            [['vk_login', 'vk_password'], 'string', 'max' => 250],
            [['ap_login', 'ap_password'], 'string', 'max' => 255],
            ['mail_service_type', 'in', 'range' => ['yandex', 'gmail', 'mail.ru']],
            ['who_created', 'default', 'value' => ($this->isNewRecord) ? Yii::$app->user->identity->id : $this->who_created],
            ['xml_feed_on_off', 'default', 'value' => 0],
            ['objects_rent_module', 'default', 'value' => 0],
            ['password', 'default', 'value' => ($this->isNewRecord) ? date('d', time()) . date('m', time()) . date('Y', time()) . date('H', time()) . date('i', time()) . date('s', time()) : $this->password],
            ['objects_rent_limit_phones_daily', 'default', 'value' => ($this->isNewRecord) ? 90 : $this->objects_rent_limit_phones_daily],
            ['objects_rent_limit_phones_daily_archive', 'default', 'value' => ($this->isNewRecord) ? 300 : $this->objects_rent_limit_phones_daily_archive],
            ['xml_feed_count_max', 'default', 'value' => ($this->isNewRecord) ? 500 : $this->xml_feed_count_max],
            ['calls_module', 'default', 'value' => ($this->isNewRecord) ? 1 : $this->calls_module],
            ['id_type', 'default', 'value' => ($this->isNewRecord) ? 1 : $this->id_type],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'id_sex' => 'Пол',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
            'phone' => 'Телефон',
            'email' => 'Email',
            'password' => 'Мерапоиск пароль',
            'hash' => 'Hash',
            'id_type' => 'Тип пользователя в кабинете',
            'date_add' => 'Дата создания',
            //'access' => 'Access', не используем
            'online' => 'Статус (онлайн/офлайн)',
            'last_computer_info' => 'Last Computer Info',
            //'count_times_view_clients' => 'Count Times View Clients',//// не используем
            //'clients_rent_limit_phones_daily' => 'Clients Rent Limit Phones Daily',//// не используем
            //'clients_rent_module' => 'Clients Rent Module',//// не используем
            // 'clients_rent_phones' => 'Clients Rent Phones', //// не используем
            'count_times_view_objects' => 'Текущее кол. просмотров новых. объектов сегодня',
            'objects_rent_limit_phones_daily' => 'Макс. кол. новых. объеков в день',
            'count_times_view_objects_archive' => 'Текущее кол. просмотров арх. объектов сегодня',
            'objects_rent_limit_phones_daily_archive' => 'Макс. кол. архивн. объеков в день',
            'objects_rent_module' => 'Модуль аренда',
            //'count_times_view_objects_sale' => 'Count Times View Objects Sale', //// не используем
            //'objects_sale_limit_phones_daily' => 'не используем', //// не используем
            'calls_module' => 'Рекламный модуль',
            'objects_rent_phones' => 'Просмотренные телефоны',
            'mail_service_email' => 'Подпись рассилки',
            'mail_service_password' => 'Пароль к почте',
            'mail_service_type' => 'Почтовий сервис',
            'notify_module' => 'Модуль оповещений',
            'id_domain' => 'Домен',
            //'xml_feed_time_to' => 'Доспуп к фидам до', //// не используем
            'xml_feed_on_off' => 'Фиды вкл./выкл.',
            'xml_feed_max' => 'Количество фидов',
            'vk_login' => 'ВК Логин',
            'vk_password' => 'ВК Пароль',
            'xml_feed_count_max' => 'Количество объектов в фиде',
            'ap_login' => 'Ап Логин',
            'ap_password' => 'АП Пароль',
            'who_created' => 'Менеджер',
            'data_to' => 'дата до',
            'spy' => 'дата входа',
            'meraOnOff' => 'вкл./выкл.'
        ];
    }

    /**
     * @inheritdoc
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find() {
        return new UsersQuery(get_called_class());
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'who_created']);
    }

    public function getMeraUsersAccessControl() {
        return $this->hasOne(MeraUsersAccessControl::className(), ['id_user' => 'id'])->where(['id_system' => 1]);
    }

    public function getVisitkaUsersAccessControl() {
        return $this->hasOne(MeraUsersAccessControl::className(), ['id_user' => 'id'])->where(['id_system' => 2]);
    }

    public function getSagent() {
        return $this->hasOne(Sagent::className(), ['user_id' => 'id']);
    }

    public function getMeraDomains() {
        return $this->hasOne(MeraDomains::className(), ['id' => 'id_domain']);
    }

    public function getSpyStatistics() {
        return $this->hasOne(SpyStatistics::className(), ['user' => 'id'])->orderBy("date DESC");
    }

}

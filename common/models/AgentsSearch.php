<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Agents;

/**
 * AgentsSearch represents the model behind the search form about `common\models\Agents`.
 */
class AgentsSearch extends Agents {

    public $data_to;
    public $domain;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'id_sex', 'id_type', 'online', 'objects_rent_limit_phones_daily', 'objects_rent_limit_phones_daily_archive', 'objects_rent_module', 'calls_module', 'notify_module', 'id_domain', 'xml_feed_time_to', 'xml_feed_on_off', 'xml_feed_max', 'xml_feed_count_max'], 'integer'],
            [['username', 'surname', 'name', 'patronymic', 'phone', 'email', 'password', 'hash', 'date_add', 'last_computer_info', 'count_times_view_objects', 'count_times_view_objects_archive', 'objects_rent_phones', 'mail_service_email', 'mail_service_password', 'mail_service_type', 'vk_login', 'vk_password', 'ap_login', 'ap_password'], 'safe'],
            [['data_to', 'domain'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = Agents::find()
                ->where(['not in', 'users.id', [1, 2, 3]])
                ->andWhere(['id_type' => 1]);
        $UserInfo = \Yii::$app->user->identity;
        if ($UserInfo->role != "30") {
            $query = $query->andWhere(['who_created' => $UserInfo->id]);
        }

        $query->joinWith(['meraUsersAccessControl', 'meraDomains']);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'data_to' => [
                    'asc' => ['users_access_control.date_end_object' => SORT_ASC],
                    'desc' => ['users_access_control.date_end_object' => SORT_DESC],
                    'label' => 'Дата до',
                ],
                'domain' => [
                    'asc' => ['mera_domains.domain_name' => SORT_ASC],
                    'desc' => ['mera_domains.domain_name' => SORT_DESC],
                    'label' => 'домен',
                ],
            ]
        ]);


        if (!($this->load($params) && $this->validate())) {
            /**
             * Жадная загрузка данных модели Страны
             * для работы сортировки.
             */
            //$query->joinWith(['meraUsersAccessControl']);
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'users.id' => $this->id,
            'id_sex' => $this->id_sex,
            'id_type' => $this->id_type,
            'date_add' => $this->date_add,
            'online' => $this->online,
            'objects_rent_limit_phones_daily' => $this->objects_rent_limit_phones_daily,
            'objects_rent_limit_phones_daily_archive' => $this->objects_rent_limit_phones_daily_archive,
            'objects_rent_module' => $this->objects_rent_module,
            'calls_module' => $this->calls_module,
            'notify_module' => $this->notify_module,
            'id_domain' => $this->id_domain,
            'xml_feed_time_to' => $this->xml_feed_time_to,
            'xml_feed_on_off' => $this->xml_feed_on_off,
            'xml_feed_max' => $this->xml_feed_max,
            'xml_feed_count_max' => $this->xml_feed_count_max,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'surname', $this->surname])
                ->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'patronymic', $this->patronymic])
                ->andFilterWhere(['like', 'phone', $this->phone])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'hash', $this->hash])
                ->andFilterWhere(['like', 'last_computer_info', $this->last_computer_info])
                ->andFilterWhere(['like', 'count_times_view_objects', $this->count_times_view_objects])
                ->andFilterWhere(['like', 'count_times_view_objects_archive', $this->count_times_view_objects_archive])
                ->andFilterWhere(['like', 'objects_rent_phones', $this->objects_rent_phones])
                ->andFilterWhere(['like', 'mail_service_email', $this->mail_service_email])
                ->andFilterWhere(['like', 'mail_service_password', $this->mail_service_password])
                ->andFilterWhere(['like', 'mail_service_type', $this->mail_service_type])
                ->andFilterWhere(['like', 'vk_login', $this->vk_login])
                ->andFilterWhere(['like', 'vk_password', $this->vk_password])
                ->andFilterWhere(['like', 'ap_login', $this->ap_login])
                ->andFilterWhere(['like', 'ap_password', $this->ap_password]);
        session_start();
        if (isset($_GET['AgentsSearch']['data_to']) && $_GET['AgentsSearch']['data_to']) {
            $_SESSION['from'] = strtotime($_GET['AgentsSearch']['data_to'] . ' 00:00:01');
            $_SESSION['to'] = strtotime($_GET['AgentsSearch']['data_to'] . ' 23:59:59');  // get session variable 'name2'

            $query->joinWith(['meraUsersAccessControl' => function ($q) {
                    $q->where('users_access_control.date_end_object >= ' . $_SESSION['from'] . ' AND users_access_control.date_end_object <= ' . $_SESSION['to']);
                }]);
        }
        if (isset($_GET['AgentsSearch']['domain']) && $_GET['AgentsSearch']['domain']) {
            if ($_GET['AgentsSearch']['domain'] != 'все') {                
                $_SESSION['domain_search'] = trim(strip_tags($_GET['AgentsSearch']['domain']));
                $query->joinWith(['meraDomains' => function ($q) {
                        $q->where('mera_domains.domain_name = "' . $_SESSION['domain_search'] . '"');
                    }]);
            }
        }
        
        return $dataProvider;
    }

}

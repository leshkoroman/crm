<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "spy_statistics".
 *
 * @property integer $id
 * @property string $user
 * @property string $picture
 * @property integer $id_object
 * @property string $error
 * @property string $userIp
 * @property string $userBrowser
 * @property string $userOs
 * @property string $userLanguage
 * @property string $date
 * @property string $countryName
 * @property string $cityName
 * @property string $latitude
 * @property string $longitude
 */
class SpyStatistics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spy_statistics';
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
            [['user', 'picture', 'id_object', 'error', 'userIp', 'userBrowser', 'userOs', 'userLanguage', 'countryName', 'cityName', 'latitude', 'longitude'], 'required'],
            [['id_object'], 'integer'],
            [['date'], 'safe'],
            [['user', 'picture'], 'string', 'max' => 150],
            [['error', 'userBrowser'], 'string', 'max' => 250],
            [['userIp', 'userOs'], 'string', 'max' => 100],
            [['userLanguage', 'latitude', 'longitude'], 'string', 'max' => 50],
            [['countryName', 'cityName'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => 'User',
            'picture' => 'Picture',
            'id_object' => 'Id Object',
            'error' => 'Error',
            'userIp' => 'User Ip',
            'userBrowser' => 'User Browser',
            'userOs' => 'User Os',
            'userLanguage' => 'User Language',
            'date' => 'Date',
            'countryName' => 'Country Name',
            'cityName' => 'City Name',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }

    /**
     * @inheritdoc
     * @return SpyStatisticsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SpyStatisticsQuery(get_called_class());
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mera_tarif".
 *
 * @property integer $id
 * @property string $name
 * @property integer $price
 * @property integer $on_off
 * @property string $description
 * @property integer $archive
 * @property integer $new
 * @property integer $count_new_phones
 * @property integer $count_archive_phones
 * @property integer $reklama
 * @property integer $xml
 * @property integer $my_objects
 * @property integer $xml_feed_max
 * @property integer $xml_feed_count_max
 * @property integer $vitrina
 * @property integer $hit
 * @property integer $number
 * @property integer $days
 */
class MeraTarif extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mera_tarif';
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
            [['name', 'price', 'description', 'my_objects', 'vitrina', 'hit', 'number', 'days'], 'required'],
            [['price', 'on_off', 'archive', 'new', 'count_new_phones', 'count_archive_phones', 'reklama', 'xml', 'my_objects', 'xml_feed_max', 'xml_feed_count_max', 'vitrina', 'hit', 'number', 'days'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
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
            'price' => 'Price',
            'on_off' => 'On Off',
            'description' => 'Description',
            'archive' => 'Archive',
            'new' => 'New',
            'count_new_phones' => 'Count New Phones',
            'count_archive_phones' => 'Count Archive Phones',
            'reklama' => 'Reklama',
            'xml' => 'Xml',
            'my_objects' => 'My Objects',
            'xml_feed_max' => 'Xml Feed Max',
            'xml_feed_count_max' => 'Xml Feed Count Max',
            'vitrina' => 'Vitrina',
            'hit' => 'Hit',
            'number' => 'Number',
            'days' => 'Days',
        ];
    }

    /**
     * @inheritdoc
     * @return MeraTarifQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MeraTarifQuery(get_called_class());
    }
}

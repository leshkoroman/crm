<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mera_domains".
 *
 * @property integer $id
 * @property string $domain_name
 * @property integer $status
 * @property string $image
 */
class MeraDomains extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mera_domains';
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
            [['domain_name', 'status', 'image'], 'required'],
            [['status'], 'integer'],
            [['domain_name', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'domain_name' => 'Domain Name',
            'status' => 'Status',
            'image' => 'Image',
        ];
    }

    /**
     * @inheritdoc
     * @return MeraDomainsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MeraDomainsQuery(get_called_class());
    }
}

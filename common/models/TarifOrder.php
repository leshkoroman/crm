<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tarif_order".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_tarif
 * @property integer $sum
 * @property integer $status
 * @property string $data_request
 * @property string $data_answer
 */
class TarifOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tarif_order';
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
            [['id_user', 'sum', 'status', 'data_request', 'data_answer'], 'required'],
             [['id_tarif'],'required', 'on' => 'setTarif'],
            [['id_user', 'id_tarif', 'sum', 'status'], 'integer'],
            [['data_request', 'data_answer'], 'safe'],
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
            'id_tarif' => 'Тариф',
            'sum' => 'Sum',
            'status' => 'Status',
            'data_request' => 'Data Request',
            'data_answer' => 'Data Answer',
        ];
    }

    /**
     * @inheritdoc
     * @return TarifOrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TarifOrderQuery(get_called_class());
    }
}

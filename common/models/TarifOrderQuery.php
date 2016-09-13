<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TarifOrder]].
 *
 * @see TarifOrder
 */
class TarifOrderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TarifOrder[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TarifOrder|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

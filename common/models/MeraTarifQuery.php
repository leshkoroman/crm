<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[MeraTarif]].
 *
 * @see MeraTarif
 */
class MeraTarifQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MeraTarif[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MeraTarif|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

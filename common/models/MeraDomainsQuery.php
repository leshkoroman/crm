<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[MeraDomains]].
 *
 * @see MeraDomains
 */
class MeraDomainsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MeraDomains[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MeraDomains|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

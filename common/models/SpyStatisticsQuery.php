<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[SpyStatistics]].
 *
 * @see SpyStatistics
 */
class SpyStatisticsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SpyStatistics[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SpyStatistics|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Sagent]].
 *
 * @see Sagent
 */
class SagentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Sagent[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Sagent|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

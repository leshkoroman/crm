<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ManagerComments]].
 *
 * @see ManagerComments
 */
class ManagerCommentsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ManagerComments[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ManagerComments|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

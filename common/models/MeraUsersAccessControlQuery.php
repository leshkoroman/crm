<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[MeraUsersAccessControl]].
 *
 * @see MeraUsersAccessControl
 */
class MeraUsersAccessControlQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MeraUsersAccessControl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MeraUsersAccessControl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

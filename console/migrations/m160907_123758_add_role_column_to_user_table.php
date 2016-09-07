<?php

use yii\db\Migration;

/**
 * Handles adding role to table `user`.
 */
class m160907_123758_add_role_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'role', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'role');
    }
}

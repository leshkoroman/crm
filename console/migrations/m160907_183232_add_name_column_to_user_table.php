<?php

use yii\db\Migration;

/**
 * Handles adding name to table `user`.
 */
class m160907_183232_add_name_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'name', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'name');
    }
}

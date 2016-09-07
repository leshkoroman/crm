<?php

use yii\db\Migration;

/**
 * Handles adding main_photo to table `user`.
 */
class m160907_184121_add_main_photo_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'main_photo', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'main_photo');
    }
}

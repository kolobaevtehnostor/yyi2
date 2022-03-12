<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vacation_days}}`.
 */
class m220307_013911_create_vacation_days_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vacation_days}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'data_start' => $this->dateTime()->notNull(),
            'data_end' => $this->dateTime()->notNull(),
            'status' => $this->tinyInteger(),
            'update_at' => $this->dateTime(),
            'created_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vacation_days}}');
    }
}

<?php

namespace yuncms\message\migrations;

use yii\db\Migration;

class M170206090415Create_message_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%message}}', [
            'id' => $this->primaryKey(),
            'from_id' => $this->integer()->unsigned()->notNull(),
            'user_id' => $this->integer()->unsigned()->notNull(),
            'parent' => $this->integer(),
            'message' => $this->string(750)->notNull(),
            'status' => $this->boolean()->defaultValue(false),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey('{{%message_ibfk_1}}', '{{%message}}', 'from_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%message_ibfk_2}}', '{{%message}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');

    }

    public function down()
    {
        $this->dropTable('{{%message}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

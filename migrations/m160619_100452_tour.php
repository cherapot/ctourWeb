<?php

use yii\db\Migration;

class m160619_100452_tour extends Migration
{
    public function up()
    {
    	$this->createTable('tour', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'name' => $this->string(100)->notNull(),
            'org' => $this->string(100)->notNull(),
            'tel' => $this->string(25)->notNull(),
            'address' => $this->string(100)->notNull(),
            'info' => $this->text()->notNull(),
            'site' => $this->string(100)->notNull(),
            'date' => $this->string(100)->notNull(),
            'status' => $this->integet(1)->notNull(),
            'image' => $this->text()->notNull(),
        ]);
    }

    public function down()
    {
        echo "m160619_100452_tour cannot be reverted.\n";
        $this->dropTable('tour');
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

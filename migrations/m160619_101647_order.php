<?php

use yii\db\Migration;

class m160619_101647_order extends Migration
{
    public function up()
    {
        $this->createTable('tour', [
            'id' => $this->primaryKey(),
            'id_tour' => $this->integer()->notNull(),
            'id_user' => $this->integer()->notNull(),
            'id_owner' => $this->integer()->notNull(),
            'tour_name' => $this->string(100)->notNull(),
            'name' => $this->string(100)->notNull(),
            'tel' => $this->string(25)->notNull(),
            'count' => $this->integet(3)->notNull(),
            'email' => $this->string(100)->notNull(),
            'info' => $this->text()->notNull(),
            'date_tour' => $this->string(100)->notNull(),
            'date' => $this->string(100)->notNull(),
            'status' => $this->integet(1)->notNull(),
        ]);
    }

    public function down()
    {
        echo "m160619_101647_order cannot be reverted.\n";
        $this->dropTable('order');   
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

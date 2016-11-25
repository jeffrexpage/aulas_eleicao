<?php

use yii\db\Migration;

class m161125_182017_CreateTableHashtag extends Migration
{
    public function up()
    {
        $this->createTable('hashtag',[
            'id' => $this->primaryKey(),
            'nome' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('hashtag');
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

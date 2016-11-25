<?php

use yii\db\Migration;

class m161109_214816_CreateTableBairro extends Migration
{
    public function up()
    {
        $this->createTable('bairro', [
            'id' => $this->primaryKey(),
            'nome' => $this->string()->notNull(),
        ]);

        
    }

    public function down()
    {
        $this->dropTable('bairro');
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

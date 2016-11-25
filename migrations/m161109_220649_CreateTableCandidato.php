<?php

use yii\db\Migration;

class m161109_220649_CreateTableCandidato extends Migration
{
    public function up()
    {
        $this->createTable('candidato', [
            'id' => $this->primaryKey(),
            'nome' => $this->string()->notNull(),
            'numero' => $this->string()->notNull(),
            'partido' => $this->string()->notNull(),
            'perfil' => $this->text()
        ]);
    }

    public function down()
    {
        $this->dropTable('candidato');
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

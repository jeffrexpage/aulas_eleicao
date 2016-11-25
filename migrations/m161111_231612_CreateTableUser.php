<?php

use yii\db\Migration;

class m161111_231612_CreateTableUser extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'id_candidato' => $this->integer(),
            'id_bairro' => $this->integer()->notNull(),
            'data_nascimento' => $this->date()->notNull(),
            'access_token' => $this->string()->notNull(),
            'auth_key' => $this->string()->notNull()
        ]);

        $this->addForeignKey(
            'fk_user_candidato',
            'user',
            'id_candidato',
            'candidato',
            'id'
        );

        $this->addForeignKey(
            'fk_user_bairro',
            'user',
            'id_bairro',
            'bairro',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_user_candidato','user');
        $this->dropForeignKey('fk_user_bairro','user');
        $this->dropTable('user');
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

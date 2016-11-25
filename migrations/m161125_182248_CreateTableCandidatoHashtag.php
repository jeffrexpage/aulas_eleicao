<?php

use yii\db\Migration;

class m161125_182248_CreateTableCandidatoHashtag extends Migration
{
    public function up()
    {
        $this->createTable('candidato_hashtag',[
            'id_hashtag' => $this->integer(),
            'id_candidato' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk_candidato_hashtag_candidato',
            'candidato_hashtag',
            'id_candidato',
            'candidato',
            'id'
        );

        $this->addForeignKey(
            'fk_candidato_hashtag_hashtag',
            'candidato_hashtag',
            'id_hashtag',
            'hashtag',
            'id'
        );
    }

    public function down()
    {
        $this->dropTable('candidato_hashtag');
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

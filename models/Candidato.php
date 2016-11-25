<?php

namespace app\models;

use app\models\validators\Filters;

/**
 * This is the model class for table "candidato".
 *
 * @property integer $id
 * @property string $nome
 * @property string $numero
 * @property string $partido
 * @property string $perfil
 *
 * @property User[] $users
 */
class Candidato extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'candidato';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            // campos obrigatórios
            [['nome', 'numero', 'partido'], 'required'],

            // normalizando o nome
            [
                ['nome'],
                'filter',
                'filter' => function($value) {
                    return Filters::normalizeString($value);
                }
            ],

            [['numero'],'match','pattern' => '/[0-9]{5}/'],

            // perfil é uma string
            [['perfil'], 'string'],

            [['nome', 'numero', 'partido'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'numero' => 'Numero',
            'partido' => 'Partido',
            'perfil' => 'Perfil',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id_candidato' => 'id']);
    }

    public function getPerfilView(){
        $perfil = $this->perfil;

        // negrito
        $perfil = preg_replace('/\*(.*?)\*/','<b>$1</b>',$perfil);

        // italico
        $perfil = preg_replace('/\/(.*?)\//','<i>$1</i>',$perfil);

        // sublinhado
        $perfil = preg_replace('/_(.*?)_/','<u>$1</u>',$perfil);



        return $perfil;
    }
}

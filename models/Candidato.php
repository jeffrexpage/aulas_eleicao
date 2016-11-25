<?php

namespace app\models;

use Yii;

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
            [['nome', 'numero', 'partido'], 'required'],
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
}

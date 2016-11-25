<?php

namespace app\models;

use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegisterForm extends Model
{
    public $username;
    public $dataNascimento;
    public $idBairro;
    public $password;
    public $repeatPassword = true;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

            // todos os campos são obrigatórios
            [['username', 'dataNascimento', 'idBairro', 'password', 'repeatPassword'], 'required'],

            // nome de usuário deve ter apenas letras e numeros, iniciando por uma letra, e ter
            // no mínimo 4 caracteres
            [['username'],'match','pattern' => '/[A-Za-z][A-Za-z0-9_]{3,}/'],

            // data de nascimento deve ser convertida para um timestamp, antes de ser inserida no banco.
            ['dataNascimento', 'date', 'timestampAttribute' => 'dataNascimento'],

            // id do bairro deve ser um número inteiro
            [['idBairro'],'integer'],

            // password and repeatPassword must be equal
            [['password'], 'compare', 'compareAttribute' => 'repeatPassword'],

        ];
    }
}

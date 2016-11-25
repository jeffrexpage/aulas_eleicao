<?php

namespace app\models;

use app\models\validators\Filters;
use Yii;
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
    public $repeatPassword;

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
            [['username'], 'match', 'pattern' => '/[A-Za-z][A-Za-z0-9_]{3,}/'],

            // nome do usuário deve ser único
            [['username'],'userExists'],

            // validar se a data veio no formato pt (d/m/Y)
            [['dataNascimento'], 'match', 'pattern' => '/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/'],

            // converter a data para um unix timestamp
            [['dataNascimento'], 'filter', 'filter' => function ($value) {
                return Filters::datePt2Unix($value);
            }],

            // id do bairro deve ser um número inteiro
            [['idBairro'], 'integer'],

            // password and repeatPassword must be equal
            [['repeatPassword'], 'compare', 'compareAttribute' => 'password'],

        ];
    }

    public function userExists($attribute){
        if(User::findByUsername($this->$attribute)){
            $this->addError($attribute,'O usuário já foi utilizado.');
        }
    }

    public function attributeLabels()
    {
        return [
            'idBairro' => 'Bairro',
            'password' => 'Senha',
            'repeatPassword' => 'Repetir a Senha'
        ];
    }

    public function register()
    {

        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->password_hash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $user->id_candidato = null;
            $user->id_bairro = $this->idBairro;
            $user->data_nascimento = $this->dataNascimento;
            $user->access_token = Yii::$app->getSecurity()->generateRandomString();
            $user->auth_key = Yii::$app->getSecurity()->generateRandomString();
            if ($user->save()) {
                Yii::$app->user->login($user, 3600 * 24 * 30);
                return true;
            }
            return false;
        }
        return false;
    }
}

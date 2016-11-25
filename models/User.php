<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property integer $id_candidato
 * @property integer $id_bairro
 * @property string $data_nascimento
 * @property string $access_token
 * @property string $auth_key
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'id_bairro', 'data_nascimento', 'access_token', 'auth_key'], 'required'],

            [['id'],'unique'],
            [['username'],'unique'],
            [['access_token'],'unique'],


            [['id_candidato', 'id_bairro'], 'integer'],
            [['data_nascimento'], 'safe'],
            [['username', 'password_hash', 'access_token', 'auth_key'], 'string', 'max' => 255],
            [
                ['data_nascimento'],
                'validarIdade',
                'params' =>  ['idadeMinima' => 18]
            ]
        ];
    }

    public function validarIdade($attribute,$params)
    {

        $idadeMinima = $params['idadeMinima'];
        $dataNascimento = \Datetime::createFromFormat(
            'Y-m-d',
            $this->$attribute
        );

        $hoje = new \Datetime();
        $intervalo = \Dateinterval::createFromDateString(
            "$idadeMinima years"
        );

        if($dataNascimento > $hoje->sub($intervalo)){
            $this->addError($attribute,"Você precisa ser maior de $idadeMinima anos");
        }

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'id_candidato' => 'Id Candidato',
            'id_bairro' => 'Id Bairro',
            'data_nascimento' => 'Data Nascimento',
            'access_token' => 'Access Token',
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return self::find()->where(['id' => $id])->one();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::find()->where(['access_token' => $token])->one();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::find()->where(['username' => $username])->one();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app
                    ->getSecurity()
                    ->validatePassword($password, $this->password_hash);
    }

    public function getBairro(){
        return $this->hasOne(Bairro::class,['id' => 'id_bairro']);
    }
}

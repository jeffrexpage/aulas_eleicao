<?php

namespace app\models;

use Yii;
use app\models\validators\Filters;

/**
 * This is the model class for table "bairro".
 *
 * @property integer $id
 * @property string $nome
 */
class Bairro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bairro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                ['nome'],
                'filter',
                'filter' => function($value) {
                    return Filters::normalizeString($value);
                }
            ],
            [
                ['nome'], 
                'required'
            ],
            [
                ['nome'], 
                'string', 
                'min' => 3,
                'max' => 255
            ],
            [
                ['nome'],
                'unique'
            ],
            [
                ['nome'],
                'match',
                'pattern' => '/^[A-Z0-9 ]+$/',
                'message' => 'Nome só pode conter letras maiúsculas.',
                'enableClientValidation' => false
            ]
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
        ];
    }

    public function getUsuarios()
    {
        return $this->hasMany(User::class,['id_bairro' => 'id']);
    }
}

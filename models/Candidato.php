<?php

namespace app\models;

use app\models\validators\Filters;
use yii\db\ActiveQuery;
use yii\helpers\Html;

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
 * @property Hashtag[] $hashtags
 * @property string $perfilView
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
                'filter' => function ($value) {
                    return Filters::normalizeString($value);
                }
            ],

            [['numero'], 'match', 'pattern' => '/[0-9]{5}/'],

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

    /**
     * @return ActiveQuery
     */
    public function getHashtags()
    {
        return $this
            ->hasMany(Hashtag::className(), ['id' => 'id_hashtag'])
            ->viaTable('candidato_hashtag', ['id_candidato' => 'id']);
    }

    public function getPerfilView()
    {
        $perfil = $this->perfil;

        // negrito
        $perfil = preg_replace('/\*([^*]+?)\*/', '<b>$1</b>', $perfil);

        // italico
        $perfil = preg_replace('/%([^%]+?)%/', '<i>$1</i>', $perfil);

        // sublinhado
        $perfil = preg_replace('/_([^_]+?)_/', '<u>$1</u>', $perfil);

        // hashtag
        preg_match_all('/\#([A-Za-z0-9_]+)/', $perfil, $hashtags);

        foreach ($hashtags[1] as $hashtag) {

            $objHashtag = $this->getHashtags()->where(['nome' => $hashtag])->one();
            $id = $objHashtag->id;

            $perfil = str_replace("#$hashtag", Html::a(
                "#$hashtag",
                [
                    'hashtag/view',
                    'id' => $id
                ]
            ), $perfil);
        }

        return $perfil;
    }

    /**
     * @return void
     */
    public function linkHashtags()
    {

        // buscando as hashtags
        preg_match_all('/\#([A-Za-z0-9_]+)/', $this->perfil, $hashtags);

        // percorrendo as hashtags encontradas no texto
        foreach ($hashtags[1] as $nomeHashtag) {

            // busca a hashtag
            $hashtag = Hashtag::find()->where(['nome' => $nomeHashtag])->one();

            // se não existir, cria a hashtag
            if(is_null($hashtag)){
                $hashtag = new Hashtag();
                $hashtag->nome = $nomeHashtag;
                $hashtag->save();
            }

            // faz o link com o candidato
            $this->link('hashtags',$hashtag);

            // busca hashtags linkadas com o candidato, que não estão no texto
            $unlinkHashtags = $this->getHashtags()->where(['not in','nome',$hashtags[1]])->all();
            foreach($unlinkHashtags as $unlinkHashtag) {
                $this->unlink('hashtags', $unlinkHashtag);
            }

        }

    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->linkHashtags();
        parent::afterSave($insert, $changedAttributes);
    }
}

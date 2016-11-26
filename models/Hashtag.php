<?php

namespace app\models;

/**
 * This is the model class for table "hashtag".
 *
 * @property integer $id
 * @property string $nome
 *
 * @property Candidato[] $candidatos
 */
class Hashtag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hashtag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'unique'],
            [['nome'], 'string', 'max' => 255],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidatos()
    {
        return $this
            ->hasMany(Candidato::className(), ['id' => 'id_candidato'])
            ->viaTable('candidato_hashtag', ['id_hashtag' => 'id']);
    }
}

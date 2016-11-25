<?php

namespace app\models;

/**
 * This is the model class for table "hashtag".
 *
 * @property integer $id
 * @property string $nome
 *
 * @property CandidatoHashtag[] $candidatoHashtags
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
    public function getCandidatoHashtags()
    {
        return $this->hasMany(CandidatoHashtag::className(), ['id_hashtag' => 'id']);
    }
}

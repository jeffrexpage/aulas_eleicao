<?php

namespace app\controllers;

use app\models\Candidato;
use app\models\Hashtag;

class HashtagController extends \yii\web\Controller
{
    public function actionView($id)
    {

        /** @var Hashtag $hashtag */
        $hashtag = Hashtag::find()->where(['id' => $id])->one();

        /** @var Candidato[] $candidatos */
        $candidatos = $hashtag->candidatos;

        return $this->render('view',[
            'hashtag' => $hashtag->nome,
            'candidatos' => $candidatos
        ]);
    }

}

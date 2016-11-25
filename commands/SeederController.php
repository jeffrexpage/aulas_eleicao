<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use app\models\User;
use app\models\Bairro;
use Yii;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SeederController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'seeder')
    {
        echo $message . "\n";
    }

    public function actionUser(){

        $bairro = Bairro::find()->where(['nome' => 'CENTRO'])->one();

        if(is_null($bairro)) {
            $bairro = new Bairro();
            $bairro->nome = 'CENTRO';
            $bairro->save();    
        }

    	$user = new User();
    	$user->username = 'admin';
    	$user->password_hash = Yii::$app
    							->getSecurity()
    							->generatePasswordHash('admin');
		$user->id_bairro = $bairro->id;
		$user->data_nascimento = '1900-01-01';
		$user->access_token = Yii::$app
								->getSecurity()
								->generateRandomString();
		$user->auth_key = Yii::$app
								->getSecurity()
								->generateRandomString();
		if(!$user->save()){
			var_dump($user->getErrors());
		}
    }
}

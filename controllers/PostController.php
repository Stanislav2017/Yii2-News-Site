<?php
/**
 * Created by PhpStorm.
 * User: stanislav
 * Date: 01.10.2018
 * Time: 11:47
 */

namespace app\controllers;

use app\models\Post;
use yii\web\Controller;

class PostController extends Controller
{
    public function actionIndex()
    {
       $model = Post::find()->all();
       return $this->render('index', [
           'model' => $model
       ]);
    }
}
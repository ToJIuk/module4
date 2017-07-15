<?php
/**
 * Created by PhpStorm.
 * User: Lyudmila
 * Date: 15.07.17
 * Time: 16:05
 */

namespace app\modules\admin\controllers;


use yii\base\Controller;

class ColorController extends Controller
{
    public $layout = 'admin';

    public function actionBody(){

        return $this->render('body');
    }

}
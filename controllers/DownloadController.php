<?php
/**
 * Created by PhpStorm.
 * User: redmenote
 * Date: 06.01.16
 * Time: 14:47
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Tour;
use app\models\AddForm;

class DownloadController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04.04.16
 * Time: 0:08
 */

namespace app\controllers;

use app\models\Gallery;
use app\models\OrderMobile;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Tour;
use yii\web\Response;

class ApiController extends Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'only' => ['view', ''],  // in a controller
                // if in a module, use the following IDs for user actions
                // 'only' => ['user/view', 'user/index']
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        //Yii::$app->response->format = Response::FORMAT_HTML;
        return $this->render('index');
    }

    public function actionGettour()
    {
        $query = Tour::find()
            ->where(['status' => 1]);
        //->all();

        $pagination = new Pagination([
            'defaultPageSize' => 15,
            'totalCount' => $query->count(),
        ]);

        $tours = $query->orderBy('name')
            ->select(['id', 'name', 'info', 'image', 'date'])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            //->one();
            ->all();

        Yii::$app->response->format = Response::FORMAT_JSON;

        //return $tours;
        return ['param' => $tours];


        return $this->render('getTour', [
            'tours' => $tours,
            'pagination' => $pagination,
        ]);
    }

    public function actionGetmore($id)
    {
        $query = Tour::find()
            ->where(['status' => 1, 'id' => $id]);
        //->all();



        $tours = $query
            ->select(['id', 'name', 'info', 'image',
                'org', 'tel', 'address', 'site', 'date'])
            ->one();
            //->all();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return $tours;
        //return ['param' => $tours];


        return $this->render('getTour', [
            'tours' => $tours,
            'pagination' => $pagination,
        ]);
    }

    public function actionOrder()
    {
        $model = new OrderMobile();


        if ($model->load(Yii::$app->request->post()))
        {
            $gal = new Gallery();
            $gal->id_tour = 42;
            $gal->path = "net";
            $gal->save(false);
        }
        {/*
            $post = Yii::$app->request->post();
            $model->id_tour = $post['id_tour'];
            $model->name = $post['name'];
            $model->tel = $post['tel'];
            $model->count = $post['count'];
            $model->email = $post['email'];
            $model->info = $post['info'];
            $model->date_tour = $post['date_tour'];
*/
            $gal = new Gallery();
            $gal->id_tour = 42;
            $gal->path = "net";
            $gal->save(false);




            $order = $model->add();
            if (!$order)
            {
                Yii::$app->session->setFlash('error', 'Ошибка при валидации');
                Yii::error('Ошибка при валидации');

            }
            return 'ok';
        }

    }

}

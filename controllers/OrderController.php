<?php
/**
 * Created by PhpStorm.
 * User: redmenote
 * Date: 07.02.16
 * Time: 23:38
 */
namespace app\controllers;

use app\models\OrderForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Tour;
use app\models\Order;
use app\models\Search;

class OrderController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'complete', 'new', 'all', 'search', 'result', 'confirm'],
                'rules' => [
                    [
                        'actions' => ['index', 'complete', 'new', 'all', 'search', 'result', 'confirm'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {

        $orders = Order::find()
            ->select('id_tour')
            ->where(['id_user' => Yii::$app->user->id])
            ->all();

        $i=0;
        if(!$orders)
        {
            $this->redirect('tour/',302);
        }
        foreach($orders as $t)
        {
            $ids[$i] = $t->id_tour;
            $i++;
        }

        $query = Tour::find()
            ->where(['id' => $ids]);
            //->all();


        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);

        $tours = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();



        return $this->render('index', [
            'tours' => $tours,
            'pagination' => $pagination,
        ]);

    }


    public function actionComplete()
    {
        $query = Order::find()
            ->where(['id_owner' => Yii::$app->user->id])
            ->andWhere(['status'=>1]);

        $pagination = new Pagination([
            'defaultPageSize' => 15,
            'totalCount' => $query->count(),
        ]);

        $orders = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('completeorder', [
            'orders' => $orders,
            'pagination' => $pagination,
        ]);
    }

    public function actionNew()
    {

        $query = Order::find()
            ->where(['id_owner' => Yii::$app->user->id])
            ->andWhere(['status'=>0]);

        $pagination = new Pagination([
            'defaultPageSize' => 15,
            'totalCount' => $query->count(),
        ]);

        $orders = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('neworder', [
            'orders' => $orders,
            'pagination' => $pagination,
        ]);
    }

    public function actionAll()
    {
        $query = Order::find()
            ->where(['id_owner' => Yii::$app->user->id]);

        $pagination = new Pagination([
            'defaultPageSize' => 15,
            'totalCount' => $query->count(),
        ]);

        $orders = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('allorder', [
            'orders' => $orders,
            'pagination' => $pagination,
        ]);
    }

    public function actionSearch()
    {
        $model = new Search();

        return $this->render('search', [
            'model' => $model,
        ]);
    }


    public function actionResult()
    {

        $model = new Search();

        if ($model->load(Yii::$app->request->get()))
        {
            $query = $model->orderSearch();
            if (!$query)
            {
                Yii::$app->session->setFlash('error', 'Ошибка при валидации');
                Yii::error('Ошибка при валидации');
                return $this->goHome();
            }

            $pagination = new Pagination([
                'defaultPageSize' => 3,
                'totalCount' => $query->count(),
            ]);

            $orders = $query
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

            return $this->render('result', [
                'orders' => $orders,
                'pagination' => $pagination,
            ]);
        }

        return $this->render('search', [
            'model' => $model,
        ]);
    }

    public  function actionConfirm($id)
    {
        $confirm = new OrderForm();
        $confirm->confirm($id);

        return $this->redirect('complete', 302);
    }

}

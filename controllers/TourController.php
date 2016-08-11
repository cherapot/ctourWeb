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
use yii\filters\AccessControl;
use yii\data\Pagination;
use app\models\Tour;
use app\models\AddForm;
use app\models\UploadForm;
use app\models\OrderForm;
use yii\web\UploadedFile;
use yii\web\User;
use app\models\Gallery;
use app\models\Search;
use app\models\CommentForm;

class TourController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['add', 'update', 'delete', 'my'],
                'rules' => [
                    [
                        'actions' => ['add', 'update', 'delete', 'my'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $query = Tour::find()
            ->where(['status' => 1]);
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


    public function actionAdd()
    {

        $model = new AddForm();
        $load = new UploadForm();


        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $tour = $model->add();
            if (!$tour)
            {
                Yii::$app->session->setFlash('error', 'Ошибка при валидации');
                Yii::error('Ошибка при валидации');
                return $this->goHome();
            }

        }


        if (Yii::$app->request->isPost) {
            $load->imageFiles = UploadedFile::getInstances($load, 'imageFiles');
            if ($load->upload($tour->id)) {
                // file is uploaded successfully
                return $this->redirect('my', 302);
            }
        }




        return $this->render('add', [
            'model' => $model,
            'load' => $load,
        ]);

    }

    public function actionMy()
    {
        $query = Tour::find()
            ->where(['id_user' =>  Yii::$app->user->id]);
        //->all();

        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);

        $tours = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy(['id' => SORT_DESC])
            ->all();


        return $this->render('my', [
            'tours' => $tours,
            'pagination' => $pagination,
        ]);
    }


    public function actionMore($id)
    {

        $model = new CommentForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $comment = $model->addComment($id);
            if (!$comment)
            {
                Yii::$app->session->setFlash('error', 'Ошибка при валидации');
                Yii::error('Ошибка при валидации');
                return $this->refresh();
            }

        }

        $tour = Tour::findOne($id);
        //->all();
        $gallery = Gallery::find()
        ->where(['id_tour' => $id])->all();
        $comments = $model->getComments($id);


        return $this->render('more', [
            'tour' => $tour,
            'gallery' => $gallery,
            'model' => $model,
            'comments' => $comments,
        ]);

    }


    public function actionDelete($id)
    {
        $tour = Tour::findOne($id);

        if(Yii::$app->user->id == $tour->id_user)
        $tour->delete();

        return $this->redirect(['index']);
    }


    public function actionUpdate($id)
    {

        $model = new AddForm();

        $load = new UploadForm();


        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $tour = $model->upgrade($id);
            if (!$tour)
            {
                Yii::$app->session->setFlash('error', 'Ошибка при валидации');
                Yii::error('Ошибка при валидации');
                return $this->goHome();
            }

        }
        $tour = Tour::findOne($id);

        if(Yii::$app->user->id == $tour->id_user)
        return $this->render('update', [
            'model' => $model,
            'tour' => $tour,
            'load' => $load,
        ]);

        $this->goBack();

    }


    public function actionSearch($public_search)
    {
        $model = new Search();
        $model->search = $public_search;

        if ($public_search) {
            $query = $model->publicSearch($public_search);
            if (!$query) {
                Yii::$app->session->setFlash('error', 'Ошибка при валидации');
                Yii::error('Ошибка при валидации');
                return $this->goHome();
            }

            $pagination = new Pagination([
                'defaultPageSize' => 3,
                'totalCount' => $query->count(),
            ]);

            $tours = $query
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

            return $this->render('search', [
                'tours' => $tours,
                'pagination' => $pagination,
            ]);
        }

        return $this->goHome();
    }


    public function actionOrder($id)
    {
        $model = new OrderForm();


        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $order = $model->add($id);
            if (!$order)
            {
                Yii::$app->session->setFlash('error', 'Ошибка при валидации');
                Yii::error('Ошибка при валидации');
                return $this->goHome();
            }
            return $this->goHome();
        }
        return $this->render('order', [
            'model' => $model,
        ]);
    }

    public function actionExtendsearch()
    {
        $model = new Search();
        return $this->render('extendsearch', [
            'model' => $model
        ]);
    }

    public function actionResult()
    {
        $model = new Search();

        if ($model->load(Yii::$app->request->get()) && $model->validate())
        {

            $query = $model->extendSearch();
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

            $tours = $query
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

            return $this->render('result', [
                'tours' => $tours,
                'pagination' => $pagination,
                'model' => $model,
            ]);
        }
        $this->redirect('extendsearch', 302);
    }

    public function actionTmp()
    {
        $model = Gallery::find()
            ->where(['id_tour' => '43'])->all();



        return $this->render('tmp', [
            'model' => $model,
        ]);

    }

    public function actionCalendar()
    {
        return $this->render('calendar', [

        ]);
    }

    public function actionDate($date, $month, $year)
    {
        $model = new Tour();

        if ($date) {
            $query = $model->findByDate($date, $month, $year);
            if (!$query) {
                Yii::$app->session->setFlash('error', 'Ошибка при валидации');
                Yii::error('Ошибка при валидации');
                return $this->goHome();
            }

            $pagination = new Pagination([
                'defaultPageSize' => 3,
                'totalCount' => $query->count(),
            ]);

            $tours = $query
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

            return $this->render('search', [
                'tours' => $tours,
                'pagination' => $pagination,
            ]);
        }

        return $this->goHome();
    }

}
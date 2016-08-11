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

class RootController extends Controller
{
    public function actionIndex()
    {
        if(Yii::$app->user->can('use-admin-panel')) {
            $query = Tour::find()
                ->where(['status' => 0]);
            //->all();

            $pagination = new Pagination([
                'defaultPageSize' => 5,
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
        }else
            return $this->goHome();

    }


    public function actionAdd()
    {

        if(Yii::$app->user->can('use-admin-panel')) {
            $model = new AddForm();

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $tour = $model->add();
                if (!$tour) {
                    Yii::$app->session->setFlash('error', 'Ошибка при валидации');
                    Yii::error('Ошибка при валидации');
                    return $this->goHome();
                }

            }


            return $this->render(
                'add',
                [
                    'model' => $model
                ]
            );
        }else
            return $this->goHome();
    }

    public function actionMy()
    {
        if(Yii::$app->user->can('use-admin-panel')) {
            $query = Tour::find()
                ->where(['id_user' => Yii::$app->user->id]);
            //->all();

            $pagination = new Pagination([
                'defaultPageSize' => 5,
                'totalCount' => $query->count(),
            ]);

            $tours = $query->orderBy('name')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

            if (Yii::$app->user->isGuest) {
                return $this->goHome();
            }
            return $this->render('my', [
                'tours' => $tours,
                'pagination' => $pagination,
            ]);
        }else
            return $this->goHome();
    }


    public function actionMore($id)
    {
        if(Yii::$app->user->can('use-admin-panel')) {
            $tour = Tour::findOne($id);
            //->all();
            $tour->status = 1;
            $tour->save();

            return $this->redirect(['index']);
        }else
            return $this->goHome();

    }


    public function actionDelete($id)
    {
        if(Yii::$app->user->can('use-admin-panel')){
            $tour = Tour::findOne($id);

            $tour->delete();

            return $this->redirect(['index']);
        }else
            return $this->goHome();
    }


    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('use-admin-panel')) {
            $model = new AddForm();


            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $tour = $model->upgrade($id);
                if (!$tour) {
                    Yii::$app->session->setFlash('error', 'Ошибка при валидации');
                    Yii::error('Ошибка при валидации');
                    return $this->goHome();
                }

            }
            $tour = Tour::findOne($id);


            return $this->render('update', [
                'model' => $model,
                'tour' => $tour,
            ]);
        }else
            return $this->goHome();
    }
}
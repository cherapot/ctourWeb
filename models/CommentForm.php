<?php
/**
 * Created by PhpStorm.
 * User: redrice
 * Date: 27.02.16
 * Time: 20:38
 */

namespace app\models;
use Yii;
use yii\base\Model;
use yii\db\Query;



class CommentForm extends Model
{
    public  $comment;
    public  $date;

    public function rules()
    {
        return [
            [['comment'], 'required'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'comment' => 'Введите ваш комментарий',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function addComment($tour_id)
    {
        $comment = new Comment();
        $comment->id_tour = $tour_id;
        $comment->id_user = Yii::$app->user->id;
        $comment->comment = $this->comment;
        $comment->date = date('Y-m-d h:m:s');

        $comment->save(false);
    }

    public function getComments($tour_id)
    {
        /*
        $query = Comment::find()
            ->select(['comment.comment', 'user.username'])
            ->innerJoin('user', '`user`.`id` = `comment`.`id_user`')
            //->joinWith('user', '`user`.`id` = `comment`.`id_user`')
            //->leftJoin('user', '`user`.`id` = `comment`.`id_user`')
            ->limit(10)
            ->where(['comment.id_tour' => $tour_id])
            ->all();

        return $query ? $query : null;
        */
        $query = (new Query())
            ->select(['user.username', 'comment.date' ,'comment.comment'])
            ->from('comment')
            ->where(['comment.id_tour' => $tour_id])
            ->leftJoin('user', 'comment.id_user = user.id')
            ->limit(10);

        $command = $query->createCommand();
        $data = $command->queryAll();

        return $data ? $data : null;


    }
}

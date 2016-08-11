<?php
/**
 * Created by PhpStorm.
 * User: redmenote
 * Date: 05.02.16
 * Time: 22:21
 */
namespace app\models;
use yii\base\Model;
use Yii;
use app\models\Tour;
use app\models\Order;

class Search extends Model
{
    public $search;
    public $category = 'name';
    public $sort = 'date';

    public function rules()
    {
        return [

            [['search', 'category', 'sort'], 'required'],
            ['search', 'string', 'min' => 4],

        ];
    }

    public function attributeLabels()
    {
        return [
            'search' => 'Строка поиска',
            'category' => 'Выбор категории:',
            'sort' => 'Сортировать по:',
        ];
    }

    public function extendSearch()
    {
        if($this->sort == 'date')
            $tmp = Tour::find()
                ->andfilterWhere(['like', $this->category, $this->search])
                ->orderBy([$this->sort => SORT_DESC])
                ->andWhere(['status' => 1]);
        else
            $tmp = Tour::find()
                ->andfilterWhere(['like', $this->category, $this->search])
                ->orderBy([$this->sort => SORT_ASC])
                ->andWhere(['status' => 1]);

        return $tmp;//? $tmp : null;
    }


    public function orderSearch()
    {
        $tmp = Order::find()
            ->Where(['tour_name' => $this->search])
            ->orderBy([$this->sort => SORT_DESC]);

        return $tmp;//? $tmp : null;
    }

    public function publicSearch($public_search)
    {
        $query = Tour::find()
            ->orFilterWhere(['like', 'name', $public_search])
            ->orFilterWhere(['like', 'org', $public_search])
            ->orFilterWhere(['like', 'address', $public_search])
            ->orFilterWhere(['like', 'info', $public_search])
            ->andWhere(['status' => 1]);

        return $query;//? $tmp : null;
    }
}
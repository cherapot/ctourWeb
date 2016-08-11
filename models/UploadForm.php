<?php
/**
 * Created by PhpStorm.
 * User: redmenote
 * Date: 06.02.16
 * Time: 21:07
 */
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    public function upload($id)
    {
        if ($this->validate()) {
            $it = 0;
            foreach ($this->imageFiles as $file) {
                $path = 'uploads/' . $id . 'n' . $it . '.' . $file->extension;
                $file->saveAs($path);
                $gallery = new Gallery();
                $gallery->id_tour = $id;
                $gallery->path = $path;
                $gallery->save(false);
                ++$it;
            }
            $img = Tour::findOne(['id' => $id]);
            $img->image = 'uploads/' . $id . 'n0' . '.' . $this->imageFiles[0]->extension;
            $img->save(false);

            return true;
        } else {
            return false;
        }
    }
}

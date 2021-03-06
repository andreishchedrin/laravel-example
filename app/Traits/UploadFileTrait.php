<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 8/15/19
 * Time: 10:35 PM
 */
namespace AttendanceSystem\Traits;

use AttendanceSystem\Models\Image;
use Illuminate\Support\Facades\Auth;

trait ImageUpload
{

    /**
     * Get image/images and return one or more instance of Image class for saving with relations
     * @param $alias
     * @param $images
     * @return array
     */
    public function processingImages($images, $alias)
    {
        $arr = [];

        foreach ($images as $image){

            $name = $alias. '_' . time() . '.' . $image->getClientOriginalExtension();
            $thumb_path = storage_path('app/public/uploads/thumbs/'.$name);
            $thumb = \Intervention::make($image)->resize(320,240);
            $path = $image->storeAs('uploads', $name);
            $thumb->save($thumb_path);

            $model = app(Image::class);
            $model->name = $name;
            $model->path = $path;
            $model->user_id = Auth::user()->id;

            $arr[] = $model;
        }

        return $arr;

    }
}

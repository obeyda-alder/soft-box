<?php

/**
 * Global Helpers
 */

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait ImageHelper
{


  public static function defaultByType($name)
  {
    return asset('/uploads/default_images/' . $name);
  }

  public static function UploadWithResizeImage($image, $folder_name, $size_img = [])
  {
    $extension       = Str::random(12) . time() . '.' . $image->getClientOriginalExtension();
    $destinationPath = public_path('/uploads/' . $folder_name . '/');

    // resize ...
    if (!empty($size_img)) {
      collect($size_img)->each(function ($size) use ($image, $extension, $destinationPath) {
        $resize = Image::make($image);

        if (!file_exists($destinationPath . $size[0] . 'x' . $size[1] . '/')) {
          mkdir($destinationPath . $size[0] . 'x' . $size[1] . '/', 0777, true);
        }

        $resize->resize($size[0], $size[1])->save($destinationPath . $size[0] . 'x' . $size[1] . '/' . $extension);
      });
    }
    $image->move($destinationPath . 'original/', $extension);
    return $extension;
  }

  public static function getImg($folder, $image, $size = '/original/')
  {
    return asset('/uploads/' . $folder . $size . $image);
  }

  public static function deleteImg($folder, $image, $enumSize = [])
  {
    if (!empty($enumSize)) {
      collect(array_keys($enumSize))->each(function ($size) use ($folder, $image) {
        if (File::exists(public_path('/uploads/' . $folder . '/' . $size . '/' . $image))) {
          File::delete(public_path('/uploads/' . $folder . '/' . $size . '/' . $image));
        }
      });
    }

    if (File::exists(public_path('/uploads/' . $folder . '/original/' . $image))) {
      File::delete(public_path('/uploads/' . $folder . '/original/' . $image));
    }

    return true;
  }
}

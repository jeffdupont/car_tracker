<?php namespace App\Http\Controllers;

use App\Models;

use Illuminate\Contracts\Filesystem\Cloud;

class UtilitiesController extends Controller {


    function upload( Cloud $storage, $car_id )
    {
      //
      $image = \Image::make(\Request::file('image'));

      // resize image
      $image->resize(null, 1000, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
      })->save();

      // save image
      $storage->put('images/' . $car_id . '.jpg', file_get_contents(\Request::file('image')));

      return \URL::route('cars.image', $car_id);
    }

}

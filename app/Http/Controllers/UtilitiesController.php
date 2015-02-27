<?php namespace App\Http\Controllers;

use App\Models;

class UtilitiesController extends Controller {


    function upload( Cloud $storage, $car_id ) {
      //
      $storage->put('images/' . $car_id . '.jpg', Input::file('image'));
      $image = \Image::make($storage->get('images/' . $car_id . '.jpg'));

      // save image
      $image->resize(null, 1000, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
      })->save();

      return \URL::route('cars.image', $car_id);
    }

}

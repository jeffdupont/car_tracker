<?php

class UtilitiesController extends BaseController {


    function upload( $car_id ) {
      //
      $image = Image::make(Input::file('image'));

      // save image
      $image->resize(null, 1000, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
      })->save(storage_path() . Config::get('upload.path') . '/' . $car_id . '.jpg');

      return URL::route('cars.image', $car_id);
    }

}

<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Html\FormBuilder as Form;
use Response;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

}


Form::macro('phone', function( $name, $value, $options )
{
	array_walk($options, create_function('&$i,$k','$i=" $k=\"$i\"";'));
	$input_properties = implode($options, " ");

	return '<input type="tel" name="' . $name . '" value="' . $value . '" ' . $input_properties . '>';
});


Response::macro('inlineImage', function($path, $name = null, $lifetime = 0)
{
	if (is_null($name)) {
			$name = basename($path);
	}

	$filetime = filemtime($path);
	$etag = md5($filetime . $path);
	$time = gmdate('r', $filetime);
	$expires = gmdate('r', $filetime + $lifetime);
	$length = filesize($path);

	$headers = array(
			'Content-Disposition' => 'inline; filename="' . $name . '"',
			'Last-Modified' => $time,
			'Cache-Control' => 'must-revalidate',
			'Expires' => $expires,
			'Pragma' => 'public',
			'Etag' => $etag,
	);

	$headerTest1 = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $time;
	$headerTest2 = isset($_SERVER['HTTP_IF_NONE_MATCH']) && str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == $etag;
	if ($headerTest1 || $headerTest2) { //image is cached by the browser, we dont need to send it again
			return static::make('', 304, $headers);
	}

	$headers = array_merge($headers, array(
			'Content-Type' => File::mime(File::extension($path)),
			'Content-Length' => $length,
	));

	return static::make(File::get($path), 200, $headers);
});

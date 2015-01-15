<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}

Form::macro('phone', function( $name, $value, $options )
{
	array_walk($options, create_function('&$i,$k','$i=" $k=\"$i\"";'));
	$input_properties = implode($options, " ");

	return '<input type="tel" name="' . $name . '" value="' . $value . '" ' . $input_properties . '>';
});

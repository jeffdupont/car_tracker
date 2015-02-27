<?php namespace App\Models;

// use Illuminate\Auth\UserTrait;
// use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends \Eloquent implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [ 'password', 'remember_token' ];


	public function getNameAttribute() {

		if ( ! empty($this->display_name) )
			return $this->display_name;
		else
			return $this->first_name . ' ' . $this->last_name;
	}

}

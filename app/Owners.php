<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Owners extends Model {

	protected $table = 'users';

	public function properties()
	{
		return $this->hasMany('App\Properties','user_id','id');
	}

}

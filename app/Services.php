<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model {

	protected $table = 'emt_services';

	public function added()
	{
		return $this->hasMany('App\ReservationsServices','service_id');
	}

}

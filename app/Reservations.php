<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model {

	protected $table = 'emt_reservations';

	public function property()
	{
		return $this->belongsTo('App\Properties','property_id','id');
	}
	public function location()
	{
		return $this->belongsTo('App\Locations','state_id','id');
	}

	public function transactions()
	{
		return $this->hasMany('App\Transactions','reservation_id','id');
	}
	public function services()
	{
		return $this->hasMany('App\ReservationsServices','reservation_id');
	}

}

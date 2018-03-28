<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationsServices extends Model
{

	protected $table = 'emt_reservations_services';
	public function reservation()
	{
		return $this->belongsTo('App\Reservations','reservation_id');
	}
	public function service()
	{
		return $this->belongsTo('App\Services','service_id');
	}
}

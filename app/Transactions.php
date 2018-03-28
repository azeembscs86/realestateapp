<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model {

	protected $table = 'emt_transactions';

	public function reservation()
	{
		return $this->belongsTo('App\Reservations','reservation_id','id');
	}	


}

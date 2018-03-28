<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyingOffers extends Model {

	protected $table = 'emt_buying_offers';

	public function property()
	{
		return $this->belongsTo('App\Properties','property_id','id');
	}
}

<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenities extends Model {

	protected $table = 'emt_amenities';

	public function added()
	{
		return $this->hasMany('App\PropertiesAmenities','amenity_id');
	}
}

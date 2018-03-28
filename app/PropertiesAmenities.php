<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertiesAmenities extends Model {

	protected $table = 'emt_properties_amenities';

	public function property()
	{
		return $this->belongsTo('App\Properties','property_id');
	}

	public function amenity()
	{
		return $this->belongsTo('App\Amenities','amenity_id');
	}

}

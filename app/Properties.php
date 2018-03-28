<?php namespace App;
use Illuminate\Database\Eloquent\Model;
class Properties extends Model {
	protected $table = 'emt_properties';
	public function classez()
	{
		return $this->hasMany('App\PropertiesClasses','property_id');
	}
	public function images()
	{
		return $this->hasMany('App\PropertiesImages','property_id');
	}	
	public function amenities()
	{
		return $this->hasMany('App\PropertiesAmenities','property_id');
	}

	public function location()
	{
		return $this->belongsTo('App\Locations','state_id','id');
	}

	public function category()
	{
		return $this->belongsTo('App\PropertyTypes','category_id','id');
	}

	public function owner()
	{
		return $this->belongsTo('App\User','user_id','id');
	}

	public function housekeeper()
	{
		return $this->hasOne('App\Facilitators','id','housekeeper_id');
	}

	public function vendor()
	{
		return $this->hasOne('App\Facilitators','id','vendor_id');
	}

	public function calendar()
	{
		return $this->hasMany('App\Calendar','property_id');
	}

	public function reservations()
	{
		return $this->hasMany('App\Reservations','property_id');
	}


}

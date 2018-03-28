<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertiesClasses extends Model {

	protected $table = 'emt_properties_classes';

	public function theclass()
	{
		return $this->belongsTo('App\PropertyClasses','class_id');
	}

	public function property()
	{
		return $this->belongsTo('App\Properties','property_id');
	}

}

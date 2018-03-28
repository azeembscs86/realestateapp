<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyTypes extends Model {

	protected $table = 'emt_property_types';

	public function properties()
	{
		return $this->hasMany('App\Properties','category_id');
	}


}

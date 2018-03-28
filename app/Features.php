<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Features extends Model {

	protected $table = 'emt_features';

	public function added()
	{
		return $this->hasMany('App\PropertiesFeatures','feature_id');
	}

}

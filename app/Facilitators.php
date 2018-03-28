<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Facilitators extends Model {

	protected $table = 'emt_facilitators';

	public function housekeeperproperties()
	{
		return $this->hasMany('App\Properties','housekeeper_id','id');
	}
	public function vendorproperties()
	{
		return $this->hasMany('App\Properties','vendor_id','id');
	}

}

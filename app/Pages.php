<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model {

	protected $table = 'emt_site_pages';

	public function category()
	{
		return $this->belongsTo('App\PageTypes','category_id','id');
	}

	public function images()
	{
		return $this->hasMany('App\PagesImages','page_id');
	}


}

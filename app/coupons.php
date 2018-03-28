<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class coupons extends Model
{
    protected $table = 'emt_coupons';
    protected $primaryKey = 'coupon_code_id';
    protected $fillable   = ['coupon_code_id','coupon_code', 'createdAt','updatedAt'];
    protected $coupon_code_id = 1;
    protected $coupon_code ;
    protected $createdAt;
    protected $updatedAt;
    public $timestamps = false; // for false updated_at and created_at
    
   
    
    
    
            
}

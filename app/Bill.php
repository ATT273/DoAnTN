<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    protected $table = "bill";

    public function bill_detail(){
    	return $this->hasMany('App\BillDetail','bill_id','id');
    }
    public function product(){
    	return $this->belongsToMany('App\Product','bill_detail','bill_id','product_id');
    }
    public function user(){
    	return $this->belongsTo('App\User','user_id','id');
    }
}

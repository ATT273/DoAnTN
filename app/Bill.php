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

    public function customer(){
    	return $this->belongsTo('App\Customer','customer_id','id');
    }
}

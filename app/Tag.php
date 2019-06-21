<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $table = 'tag';

    public function product(){
    	return $this->belongsToMany('App\Product','product_tag');
    }
}

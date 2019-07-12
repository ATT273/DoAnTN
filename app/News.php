<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    protected $table = 'news';

    public function product_type(){
    	return $this->hasOne('App\Slide','news_id','id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    /**
	* Relationship  One To many   Category many news 
	* 
	* @return
	*/
	public $timestamps = true;
	
    public function news(){
		$this->hasMany(News::class);
    }
}

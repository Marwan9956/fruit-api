<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    /**
	* One to many Belongs To User
	* 
	* @return
	*/
	public $timestamps = true;
	 
    public function user(){
		$this->belongsTo(User::class);
    }
    
	//
	/**
	* One to many Belongs To category
	*
	* @return
	*/
	public function category()
	{
		$this->belongsTo(category::class);
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class News extends Model
{
    //
    /**
	* One to many Belongs To User
	* 
	* @return
	*/
	public $timestamps = true;

	protected $dates = [
        'created_at',
        'updated_at'
	];
	
	
	
	 
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

	/**
	 * Get Title in Lower Case
	 */
	public function getTitleAttribute($val){
		return strtolower($val);
	}

	public function getCreatedAtAttribute($val){
		$val = Carbon::parse($val);
		return $val->format('M d Y');
	}

	
	public function created_time(){
		$time = Carbon::parse($this->attribute['created_at']);
		return $time->format('Y'); 
	}


	/**
	 * Mutators Attribute
	 */
	public function setTitleAttribute($val){
		$this->attribute['title'] = strtolower($val);
	}
}

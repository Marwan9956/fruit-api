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
	
	protected $fillable = [
        'users_id', 'title', 'text', 'categroy_id'
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

	public function setCreatedAtAttribute($val){
		$val = Carbon::now();
		$this->attributes['created_at'] = $val;
	}

	public function setUpdatedAtAttribute($val){
		$val = Carbon::now();
		$this->attributes['updated_at'] = $val;
	}

	
	public function created_time(){
		$time = Carbon::parse($this->attribute['created_at']);
		return $time->format('Y'); 
	}


	/**
	 * Mutators Attribute
	 */
	public function setTitleAttribute($val){
		$this->attributes['title'] = strtolower($val);
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\News;
use Carbon\Carbon;
use App\Exceptions\RestApiException;

class category extends Model
{
	public $timestamps = true;

	protected $dates = [
        'created_at',
        'updated_at'
	];
	
	protected $fillable = [
        'user_id', 'name', 'description'
    ];

    /**
	* Relationship  One To many   Category many news 
	* 
	* @return
	*/
	
	
    public function news(){
		return $this->hasMany(News::class);
	}
	
	/**
	 * Check if User ID is avaiable and correct
	 */
	public function setUserIdAttribute($val){
		$match = false;
		$user = User::select("id")->get()->toArray();
		if(count($user) <= 0){
			throw new RestApiException("Error : No Users Available.");
		}
		for($i = 0; $i < count($user) ; $i++){
			
			if($val == $user[$i]["id"]){
				$this->attributes['user_id'] = $val;
				$match = true;
				break;
			}
		}
		if($match == false){
			throw new RestApiException("Error : No User with this ID Available.");
		}
	}

	public function setCreatedAtAttribute($val){
		$val = Carbon::now();
		$this->attributes['created_at'] = $val;
	}

	public function setUpdatedAtAttribute($val){
		$val = Carbon::now();
		$this->attributes['updated_at'] = $val;
	}

}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\News;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;
    
	public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
    public function news(){
		return $this->hasMany(News::class);
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

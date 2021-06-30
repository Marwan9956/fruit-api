<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    //
    
    public function getAll(){
		$news = News::all();
		
		return response()->json($news , 200);
    }
    
	public function getSingle($id){
		return 'working';
	}
	
	/**
	* Storing New News 
	*  
	* @param {Request} req
	* 
	* @return
	*/
	public function store(Request $req){
		$response = [
			['name' => 'hhhh'],
			['name' => 'hhhh']
		];
		return response()->json($response,200);
	}
	
	/**
	* Update
	*/
	public function update(Request $req){
		return 'OK';
	}
	
	
	public function delete(Request $id){
		return 'Ok';'
	}
}

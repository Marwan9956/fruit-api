<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Carbon\Carbon;

class NewsController extends Controller
{
    //
    
    public function getAll(){
		$news = News::all();
		
		return response()->json($news , 200);
    }
	
	/**
	 * Return Single News 
	 * @parm $id -> Number
	 */
	public function getSingle($id){
		$news = News::find($id);
		if(is_null($news)){
			$news = ['No Results'];	
		}
		return response()->json($news , 200);
	}
	
	/**
	* Storing New News 
	*  
	* @param {Request} req
	* 
	* @return
	*/
	public function store(Request $req){
		$rules = [];
		$req->validate();


		return response()->json($req,200);
	}
	
	/**
	* Update
	*/
	public function update(Request $req , $id){
		return 'OK';
	}
	
	/**
	 * Delete Method Request
	 */
	public function delete($id){
		return 'Ok';
	}
}

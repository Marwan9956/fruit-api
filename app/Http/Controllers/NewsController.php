<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\News;
use App\User;
use App\category;
use Carbon\Carbon;

use App\Exceptions\RestApiException;
use Illuminate\Database\QueryException; 
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NewsController extends Controller
{
    /**
	 * Prepare Vars for Error Message 
	 */
	private $serverErr;
	private $dbErr;
	private $user_id_Err;
	private $category_id_Err;
	private $newsNotFound_Err;
	
	/**
	 * Construct method 
	 * 
	 * Init class requirments 
	 */
	public function __construct(){
		$this->serverErr 	     = "Error : Server Internal Error Try Again.";
		$this->dbErr 		     = "Error : Database Internal Error Call Admin.";
		$this->user_id_Err       = "Error: User ID is not Correct";
		$this->category_id_Err   = "Error: Category ID is not Correct";
		$this->newsNotFound_Err  = "Error : No news With this ID .";
	}

	/**
	 * @method getAll
	 * 
	 * Get All news orderd by id 
	 */
    public function getAll(){
		try{
			$news = News::orderBy('id')->get();
			
			if(count($news) == 0){
				throw new RestApiException("Error : There is no news in Database");
			}
			return response()->json($news , 200);
		}catch(ModelNotFoundException $e){

			return response()->json($this->newsNotFound_Err , 400);
		
		}catch(RestApiException $e){
		
			return response()->json($e->getMessage(), 400);
		
		}catch(Exception $e){
			
			return response()->json($this->serverErr , 500);
		
		}
		
	}
	
	/**
	 * @method getNewsByCategory
	 * 
	 * Get All news orderd by id based on category type . 
	 */
	public function getNewsByCategory($cat){

	}
	
	/**
	 * @method getSingle
	 * 
	 * 
	 * get Single News by id
	 *  
	 * @param Int $id
	 * @return json  
	 */
	public function getSingle($id){
		try{
			$news = News::find($id);
			if(is_null($news)){
				throw new RestApiException("No News Result");
			}	
		}catch(RestApiException $e){
			return response()->json($e->getMessage() , 200);
		}

		return response()->json($news , 200);
	}
	
	/**
	* Storing New News 
	*  
	* @param Request req
	* 
	* @return json data with success mesage or Errors
	*/
	public function store(Request $req ){
		
		try{
			$rules = [
				'title'       => 'required|max:25',
				'text'        => 'required',
				'user_id'     => 'required|numeric',
				'category_id' => 'required|numeric'
			];
			$validator = Validator::make($req->all() , $rules);
			if ($validator->fails()) {
				return response()->json($validator->errors(), 422);
			}
			
			if(!$this->User_id_valid($req->user_id)){
				throw new RestApiException($this->user_id_Err);
			}

			if(!$this->Category_id_valid($req->category_id)){
				throw new RestApiException($this->category_id_Err);
			}

			
			$news = new News;
			$news->title = $req->title;
			$news->text  = $req->text;
			$news->users_id = $req->user_id;
			$news->category_id = $req->category_id;
			
			$news->save();

			$news->message = "Success News created Successfully";
			

			return response()->json($news,200);
			

		}catch(RestApiException $e){
			return response()->json($e->getMessage() , 400);
		}catch(QueryException $e){
			return response()->json($this->dbErr , 500);
		}catch(Exception $e){
			return response()->json($this->serverErr, 500);
			
		}

		
	}
	
	/**
	 * @method update 
	 * 
	 * update single news post 
	 * 
	 * @param Request $req 
	 * @param Int     $id
	 * 
	 * @return json
	 *  */ 
	public function update(Request $req , $id){
		try{
			
			if(count($req->all()) == 0){
				throw new RestApiException("Error : you didn't pass any Value");
			}
			$news = News::findOrFail($id);
			
			if($req->has("title") ){
				$rules['title'] = 'required|max:25';
				$news->title = $req->title;
			}
			if($req->has("text")){
				$rules['text'] = 'required';
				$news->text = $req->text;
			}
			if($req->has("user_id") ){
				if(!User_id_valid($req->user_id)){
					throw new RestApiException($this->user_id_Err);
				}
				$rules['user_id'] = 'required|numeric';
				$news->user_id = $req->user_id;
			}
			if($req->has("category_id")){
				if(!Category_id_valid($req->category_id)){
					throw new RestApiException($this->category_id_Err);
				}
				$rules['category_id'] = 'required|numeric';
				$news->category_id = $req->category_id;
			}

			$validator = Validator::make($req->all() , $rules);
			if($validator->fails()){
				return response()->json($validator->errors(), 422);
			}
			
			$news->saveOrFail();
			
			$message = ["message" => "Success The news been updated successfuly."];
			return response()->json([$news , $message] , 200);

		}catch(QueryException $e){

			return response()->json($this->dbErr , 500);

		}catch(ModelNotFoundException $e){

			return response()->json($this->newsNotFound_Err , 400);

		}catch(RestApiException $e){
			return response()->json($e->getMessage() , 400);
			
		}catch(Exception $e){

			return response()->json($this->serverErr , 500);

		}
		
	}
	
	/**
	 * @method delete 
	 * 
	 * delete single news post by id  
	 * 
	 * 
	 * @param Int     $id
	 * 
	 * @return json 
	 *  */
	public function delete($id){
		try{
			$news = News::findOrFail($id);
			if(! $news->delete()){
				throw new RestApiException("Error : we couldn't delete record call admin.");
			}
			$message = ["message" => "Record has been deleted successfully."];
			return response()->json([$news , $message], 200);

		}catch(QueryException $e){

			return response()->json($this->dbErr , 500);

		}catch(ModelNotFoundException $e){

			return response()->json($this->newsNotFound_Err , 400);

		}catch(RestApiException $e){
			return response()->json($e->getMessage() , 400);
			
		}catch(Exception $e){

			return response()->json($this->serverErr , 500);

		}
	}


	/**
	 * Private Methods
	 */

	 /**
	 * @method User_id_valid 
	 * 
	 * Check if the user_id passed is in range of what is available in database  
	 * 
	 * 
	 * @param Int     $id
	 * 
	 * @return boolean 
	 *  */
	private function User_id_valid($id){
		$user = User::select("id")->get()->toArray();
		for($i = 0 ; $i < count($user); $i++){
			if($user[$i]['id'] == $id){
				return true;
			}
		}
		
		
		return false;
	}

	/**
	 * @method Category_id_valid 
	 * 
	 * Check if the category_id passed is in range of what is available in database  
	 * 
	 * 
	 * @param Int     $id
	 * 
	 * @return boolean 
	 *  */
	private function Category_id_valid($id){
		$category_id = category::select("id")->get()->toArray();
		for($i=0; $i < count($category_id); $i++){
			if($category_id[$i]['id'] == $id){
				return true;
			}
		}
		return false;
	}
}

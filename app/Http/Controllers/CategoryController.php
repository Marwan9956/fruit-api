<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\helper\MessageHelper;
use App\category;


use App\Exceptions\RestApiException;
use Illuminate\Database\QueryException; 
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    /*
    public $serverErr;
	public $dbErr;
	public $user_id_Err;
	public $category_id_Err;
    public $newsNotFound_Err;
    dataNotFoundErr
    */
    private $msg;

    public function __construct(){
        $this->msg = new MessageHelper;
    }

    /**
	 * @method getAll 
	 * 
	 * get All categories 
	 * 
	 * 
	 * 
	 * @return json
	 *  */
    public function getAll(){
        try{
            $categoryList = category::orderBy("id")->get();
            if(count($categoryList->toArray()) <= 0){
                throw new ModelNotFoundException($this->msg->dataNotFoundErr);
            }
            return response()->json($categoryList , 200);
        }catch(ModelNotFoundException $e){
            return response()->json($e->getMessage(), 400);
        }catch(QueryException $e){
            return response()->json($this->msg->dbErr , 500);

        }catch(Exception $e){
            return response()->json($this->msg->serverErr , 500);
        }
    }


    /**
	 * @method getSingle 
	 * 
	 * get Single category Type 
	 * 
	 * 
	 * @param Int     $id
	 * 
	 * @return json
	 *  */
    public function getSingle($id){
        try{
            $categoryList = category::findOrFail($id);
            
            if(count($categoryList->toArray()) <= 0){
                throw new ModelNotFoundException();
            }
            return response()->json($categoryList , 200);

        }catch(ModelNotFoundException $e){
            return response()->json($this->msg->dataNotFoundErr, 400);
        }catch(QueryException $e){
            return response()->json($this->msg->dbErr , 500);

        }catch(Exception $e){
            return response()->json($this->msg->serverErr , 500);
        }
    }

    /**
	 * @method store 
	 * 
	 * store single category type 
	 * 
	 * @param Request $req 
	 * 
	 * 
	 * @return json
	 *  */
    public function store(Request $req){
        try{
            //return response()->json($req);
            
            
            if(count($req->all()) <= 0){
                throw new RestApiException($this->msg->noReqFoundErr);
            }
            
            $rules = [
                'user_id' => 'required',
                'name'    => 'required|max:25|string',
                'description' => 'required'
            ];
            $validator = Validator::make($req->all() , $rules);

            if($validator->fails()){
                return response()->json($validator->errors() , 422);
            }

            $category = new category;
            $category->user_id = $req->user_id;
            $category->name    = $req->name;
            $category->description = $req->description;
            if(!$category->save()){
                throw new QueryException();
            }

            return response()->json([ $category , $this->msg->success ],200);


        }catch(RestApiException $e){

            return response()->json($e->getMessage(),400);

        }catch(ModelNotFoundException $e){

            return response()->json($this->msg->dataNotFoundErr, 400);

        }catch(QueryException $e){

            return response()->json($this->msg->dbErr , 500);

        }catch(Exception $e){
            return response()->json($this->msg->serverErr , 500);
        }
        
    }

    /**
	 * @method update 
	 * 
	 * update single category type 
	 * 
	 * @param Request $req 
	 * @param Int     $id
	 * 
	 * @return json
	 *  */
    public function update(Request $req , $id){
        try{
            
            if(count($req->all()) <= 0){
                throw new RestApiException($this->msg->noReqFoundErr);
            }

            $category = category::findOrFail($id);
            
            if($req->has('user_id')){
                $rules['user_id'] = 'required';
                $category->user_id = $req->user_id;
            }

            if($req->has('name')){
                $rules['name'] = 'required|max:25|string';
                $category->name = $req->name;
            }

            if($req->has('description')){
                $rules['description'] = 'required';
                $category->description = $req->description;
            }
            $validator = Validator::make($req->all() , $rules);

            if($validator->fails()){
                return response()->json($validator->errors() , 422);
            }

            
            if(!$category->save()){
                throw new QueryException();
            }

            return response()->json([ $category , $this->msg->success ],200);


        }catch(RestApiException $e){

            return response()->json($e->getMessage(),400);

        }catch(ModelNotFoundException $e){

            return response()->json($this->msg->dataNotFoundErr, 400);

        }catch(QueryException $e){

            return response()->json($this->msg->dbErr , 500);

        }catch(Exception $e){
            return response()->json($this->msg->serverErr , 500);
        }
    }

    /**
	 * @method delete 
	 * 
	 * delete single category type and The corresponding News with that Category
	 * 
	 *  
	 * @param Int     $id
	 * 
	 * @return json
	 *  */
    public function delete($id){
        try{
            $category = category::findOrFail($id);

            $news = category::find($id)->news;

            foreach($news as $key => $val){
                $news[$key]->delete();
            }
            
            
            
            if(!$category->delete()){
                throw new QueryException();
            }

            return response()->json([ $category , $this->msg->successDelete ],200);


        }catch(RestApiException $e){

            return response()->json($e->getMessage(),400);

        }catch(ModelNotFoundException $e){

            return response()->json($this->msg->dataNotFoundErr, 400);

        }catch(QueryException $e){

            return response()->json($this->msg->dbErr , 500);

        }catch(Exception $e){
            return response()->json($this->msg->serverErr , 500);
        }
    
    }
}

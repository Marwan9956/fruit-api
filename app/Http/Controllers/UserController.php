<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\helper\MessageHelper;
use App\User;


use App\Exceptions\RestApiException;
use Illuminate\Database\QueryException; 
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    private $msg;

    public function __construct(){
        $this->msg = new MessageHelper;
    }


    /**
	 * @method getAllUser 
	 * 
	 * get All users 
	 * 
	 * 
	 * 
	 * @return json
	 *  */
    public function getAllUser(){
        try{
            $users = User::orderBy('id')->get();

            if(count($users->toArray()) <= 0){
                throw new ModelNotFoundException($this->msg->usersNotFoundErr);
            }

            return response()->json($users , 200);

        }catch(ModelNotFoundException $e){

            return response()->json($e->getMessage(), 400);

        }catch(QueryException $e){
			return $e->getMessage();

            return response()->json($this->msg->dbErr , 500);


        }catch(Exception $e){

            return response()->json($this->msg->serverErr , 500);

        }
    }

    /**
	 * @method getUserByID 
	 * 
	 * get single user by id 
	 * 
	 * @param Int $id
	 * 
	 * @return json
	 *  */
    public function getUserByID($id){
        try{
            $user = User::findOrFail($id);

            return response()->json($user , 200);

        }catch(ModelNotFoundException $e){

            return response()->json($this->msg->usersNotFoundErr, 400);

        }catch(QueryException $e){

            return response()->json($this->msg->dbErr , 500);


        }catch(Exception $e){

            return response()->json($this->msg->serverErr , 500);

        }
    }

    /**
	 * @method signup 
	 * 
	 * sign up a new user 
	 * 
	 * @param Request $req
	 * 
	 * @return json
	 *  */
    public function signup(Request $req){

    }

    /**
	 * @method signin 
	 * 
	 * sign in  user 
	 * 
	 * @param Request $req
	 * 
	 * @return json
	 *  */
    public function signIn(Request $req){

    }

    /**
	 * @method update 
	 * 
	 * Update user data  
	 * 
	 * @param Int $id
	 * @param Request $req
     * 
	 * @return json
	 *  */
    public function update(Request $req , $id){

    }

    

    /**
	 * @method delete 
	 * 
	 * delete user by id 
	 * 
	 * @param Int $id
	 * 
	 * @return json
	 *  */
    public function delete($id){

    }

    

    
}

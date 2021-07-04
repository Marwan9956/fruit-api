<?php 
namespace App\helper;

class MessageHelper{
    /**
	 * Prepare Vars for Error Message 
	 */
	public $serverErr;
	public $dbErr;
	public $user_id_Err;
	public $category_id_Err;
    public $newsNotFound_Err;
    public $dataNotFoundErr;
    public $success;
    public $successDelete; 
	
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
        $this->dataNotFoundErr   = "Error : No data available with this request.";
        $this->noReqFoundErr     = "Error : No Json Request been passed";

        $this->success           = "Success :Post Added Successfully.";
        $this->successDelete     = "Success : Deleted Successfully.";
	}
}
<?php

/*
 *  ====================================================
 *  Author              : Prateik D 
 *  Module              : Report Manager login API
 *  Created Date        : 27-02-2020
 *  Last Update Date    : 27-02-2020
 *  ====================================================
*/


require APPPATH.'libraries/REST_Controller.php';
require APPPATH.'libraries/Format.php';
require APPPATH.'vendor/firebase/php-jwt/src/BeforeValidException.php';
require APPPATH.'vendor/firebase/php-jwt/src/ExpiredException.php';
require APPPATH.'vendor/firebase/php-jwt/src/SignatureInvalidException.php';
require APPPATH.'vendor/firebase/php-jwt/src/JWT.php';
use \Firebase\JWT\JWT;

    
class User extends REST_Controller {
    
    public function __construct() 
    {
       parent::__construct();
       $this->load->database();
       $this->load->model('api/trainer/trainer_model', 'trainer_model');
   	}


   	/*report manager login*/
   	/*27-02-2020*/
   	public function index_post()
   	{

        $formdata = json_decode(file_get_contents('php://input'), true);

      
        $email = $formdata['email'];
        $password = $formdata['password'];

        $result = $this->trainer_model->trainer_login($email,$password);

        if($result!=false)
        {
            $token = array(
                "iss" => "EmpTraining",//any issuer name
                "aud" => "EmpTraining",//any audience name
                "iat" => time(),//issued at time in unix format seconds
                "exp" => time()+(60*2),//each(array)xpiry time in unix format seconds; 1 hour
                "admin_username"=>ucfirst($result->username),
                "admin_id"=>$result->trainer_id,
                "admin_email"=>$result->email
            );

            $jwt = JWT::encode($token, $this->config->item('jwt_key'));

            $message = [
                'status'    =>  1,
                'token'     =>  $jwt,
                'result'    =>  $result,
                'user'      =>  'trainer',
                'message'   =>  'Login Successfully.'
            ];
        }
        else
        {
            $message = [
              'status' => 0,
              'message'=>"Invalid credentials. Login failed."
            ];
        }

        $this->response($message, REST_Controller::HTTP_OK);
   	}
}
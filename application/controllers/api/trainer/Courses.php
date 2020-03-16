<?php

/*
 *  ====================================================
 *  Author              : Prateik D 
 *  Module              : Trainer Category API
 *  Created Date        : 13-03-2020
 *  Last Update Date    : 16-03-2020
 *  ====================================================
*/


require APPPATH.'libraries/REST_Controller.php';
require APPPATH.'libraries/Format.php';
require APPPATH.'vendor/firebase/php-jwt/src/BeforeValidException.php';
require APPPATH.'vendor/firebase/php-jwt/src/ExpiredException.php';
require APPPATH.'vendor/firebase/php-jwt/src/SignatureInvalidException.php';
require APPPATH.'vendor/firebase/php-jwt/src/JWT.php';
use \Firebase\JWT\JWT;

    
class Courses extends REST_Controller {
    
    public function __construct() 
    {
       	parent::__construct();
       	$this->load->database();
       	$this->load->model('api/trainer/courses_model', 'courses_model');

        $jwt=$this->input->get_request_header('token');

        // if(!empty($jwt))
        // {   
        // 	try
        //     {
        //     	$decoded = JWT::decode($jwt, $this->config->item('jwt_key'), array('HS256'));
          
        //         $this->admin_id = $decoded->admin_id;
        //         $this->admin_username = $decoded->admin_username;
        //         $this->admin_email = $decoded->admin_email;
        //     }
        //     catch(Exception $e)
        //     {
        //     	$message = ['status' => 0,'message'=>"Invalid token"];
        //         // $this->response($message, REST_Controller::HTTP_BAD_REQUEST); 
        //         // $this->set_response($message, REST_Controller::HTTP_OK);
        //         echo $message = json_encode($message);
        //         die;
        //     }    
        // }
        // else
        // {
        // 	$message = ['status' => '0','message'=>"Access denied"];
        //     // $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
        //     // $this->set_response($message, REST_Controller::HTTP_OK);   
        //     echo $message = json_encode($message);
        //     die;
        // }
    }

   	public function show_get()
   	{
   		header("Access-Control-Allow-Origin: *");
   		header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");
   		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
   		
   		$result = $this->courses_model->show_courses();

   		if($result!=false)
   		{
   		    $message = [
   		        'status' => 1,
   		        'result'=>$result,
   		        'message'=>'List of all active categories'
   		    ];
   		}
   		else
   		{
   		    $message = [
   		        'status' => 0,
   		        'message'=>"Something went wrong."
   		    ];
   		}
   		$this->set_response($message, REST_Controller::HTTP_OK); // HTTP_OK (200)
   	}

   	// public function show_parent_get()
   	// {
   	// 	header("Access-Control-Allow-Origin: *");
   	// 	header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");
   	// 	header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
   		
   	// 	$result = $this->courses_model->show_parent_categories();

   	// 	if($result!=false)
   	// 	{
   	// 	    $message = [
   	// 	        'status' => 1,
   	// 	        'result'=>$result,
   	// 	        'message'=>'List of all active parent categories'
   	// 	    ];
   	// 	}
   	// 	else
   	// 	{
   	// 	    $message = [
   	// 	        'status' => 0,
   	// 	        'message'=>"Something went wrong."
   	// 	    ];
   	// 	}
   	// 	$this->set_response($message, REST_Controller::HTTP_OK); // HTTP_OK (200)
   	// }

   	public function get_get($id)
   	{

   	    header("Access-Control-Allow-Origin: *");
   	    header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");
   	    header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
   	    
        $course_id = $id;

        // print_r($id);
        // die();

   	    if(empty($course_id)) 
   	    {
   	        $message = ['status' => 0,'message'=>"Invalid Inputs"];
   	    }
   	    else
   	    {
   	        $get_category = $this->courses_model->get_course_by_id($course_id);

   	        if($get_category != false)
   	        {

   	            $status = 1;
   	            $data = $get_category;
   	            $message = 'course fetched successfully.';
   	        }
   	        else
   	        {
   	            $status = 0;
   	            $data = $id;
   	            $message = 'course not found.';
   	        }

   	        $message = ['status' => $status, 'course' => $data,  'message' => $message];

   	    }

   	    $this->response($message, REST_Controller::HTTP_OK);
   	}


   	// public function create_post()
   	// {
   	// 	header("Access-Control-Allow-Origin: *");
 	  //   header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");
 	  //   header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
   	    

   	// 	$code = substr(md5(rand(0, 1000000)), 0, 10);

   	// 	$formdata = json_decode(file_get_contents('php://input'), true);
   	// 	$name = $formdata['title'];
   	// 	$parent = $formdata['parent'];
   	// 	$font_awesome_class = $formdata['font_awesome_class'];
    //   $thumbnail = $formdata['thumbnail'];


   	// 	$name = $this->input->post('title');
   	// 	$parent = $this->input->post('parent');
   	// 	$font_awesome_class = $this->input->post('font_awesome_class');
    //   $thumbnail = $this->input->post('thumbnail');

   	// 	$slug = str_replace(' ', '-', $name);
   	// 	$slug = strtolower($slug);

   	// 	$date_added = strtotime("now");
   	// 	$last_modified = strtotime("now");

   	// 	if($parent == 'undefined')
    //         $parent = '0';
        
    //     $config['upload_path']          = FCPATH.'/uploads/thumbnails/category_thumbnails/';
    //     $config['allowed_types']        = 'gif|jpg|png|jpeg';
    //     $config['max_size']             = 500;
    //     $config['file_name']            = time();


    //     $this->load->library('upload', $config);

    //     // if ( ! $this->upload->do_upload('thumbnail')) 
    //     // {
    //     //     $data = array(
    //     //                     'status' => '400', 
    //     //                     'error' => $this->upload->display_errors(), 
    //     //                 );
    //     // }
    //     // else 
    //     {
    //         // $uploadData = $this->upload->data();
    //         // $filename = $uploadData['file_name'];
    //         $data = array(
    //               'code' => $code, 
    //               'name' => $name, 
    //               'parent' => $parent, 
    //               'slug' => $slug, 
    //               'date_added' => $date_added, 
    //               'last_modified' => $last_modified, 
    //               'font_awesome_class' => $font_awesome_class,
    //               // 'thumbnail' => $filename, 
    //               'thumbnail' => $thumbnail, 
    //             );
    //         // $result = $this->courses_model->create($data);
    //     }


   	// 	$this->response($data, REST_Controller::HTTP_OK);
   	// }

    // public function listing_get()
    // {
    //     header("Access-Control-Allow-Origin: *");
    //     header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");
    //     header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
        
    //     $result = $this->courses_model->listing_categories();

    //     if($result!=false)
    //     {
    //         $message = [
    //             'status' => 1,
    //             'result'=>$result,
    //             'message'=>'List of all active categories'
    //         ];
    //     }
    //     else
    //     {
    //         $message = [
    //             'status' => 0,
    //             'message'=>"Something went wrong."
    //         ];
    //     }
    //     $this->set_response($message, REST_Controller::HTTP_OK); // HTTP_OK (200)
    // }


    // public function edit_post()
    // {
    //     header("Access-Control-Allow-Origin: *");
    //     header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");
    //     header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
        
    //     $formdata = json_decode(file_get_contents('php://input'), true);

    //     $name = $formdata['title'];
    //     $parent = $formdata['parent'];
    //     $font_awesome_class = $formdata['font_awesome_class'];
    //     $thumbnail = $formdata['thumbnail'];


    //     $id = $this->input->post('id');
    //     $name = $this->input->post('title');
    //     $parent = $this->input->post('parent');

    //     $slug = str_replace(' ', '-', $name);
    //     $slug = strtolower($slug);

    //     $last_modified = strtotime("now");


    //     if($parent == '0')    // is parent category
    //     {

    //       $font_awesome_class = $this->input->post('font_awesome_class');
    //       $thumbnail = $this->input->post('thumbnail');


    //       if(!($_FILES['thumbnail']))
    //       {
    //         $data = array(
    //                          'id' => $id, 
    //                          'parent' => $parent, 
    //                          'slug' => $slug,   
    //                          'last_modified' => $last_modified,
    //                          'font_awesome_class' => $font_awesome_class,
    //                       );
    //         $result = $this->courses_model->edit($data);

    //       }
    //       else
    //       {
    //             $config['upload_path']          = FCPATH.'/uploads/thumbnails/category_thumbnails/';
    //             $config['allowed_types']        = 'gif|jpg|png|jpeg';
    //             $config['max_size']             = 5000;
    //             $config['file_name']            = time();


    //             $this->load->library('upload', $config);
    //             // $this->upload->do_upload('thumbnail');
    //             // $data = array(
    //             //         'status' => '400', 
    //             //         'error' => $this->upload->display_errors(), 
    //             //     );

    //             if ( ! $this->upload->do_upload('thumbnail')) 
    //             {
    //                 $data = array(
    //                     'status' => '400', 
    //                     'error' => $this->upload->display_errors(), 
    //                 );
    //             }
    //             else 
    //             {
    //                 $uploadData = $this->upload->data();
    //                 $filename = $uploadData['file_name'];
    //                     if($parent == 'undefined')
    //                     {
    //                       $data = array(
    //                                      'id' => $id, 
    //                                      // 'code' => $code, 
    //                                      'name' => $name, 
    //                                      'slug' => $slug,   
    //                                      'last_modified' => $last_modified,
    //                                      'font_awesome_class' => $font_awesome_class,
    //                                      'thumbnail' => $filename,
    //                       );
    //                     }
    //                     else
    //                     {
    //                     $data = array(
    //                        'id' => $id, 
    //                        // 'code' => $code, 
    //                        'name' => $name, 
    //                        'parent' => $parent, 
    //                        'slug' => $slug,   
    //                        'last_modified' => $last_modified,
    //                        'font_awesome_class' => $font_awesome_class,
    //                        'thumbnail' => $filename
    //                     );
    //                     }
    //              $result = $this->courses_model->edit($data);
    //             }

    //       }
    //     }

    //     else                 // is sub category
    //     {
    //       $data = array(
    //          'id' => $id, 
    //          'name' => $name, 
    //          'slug' => $slug,   
    //          'last_modified' => $last_modified
    //       );
    //       $result = $this->courses_model->edit($data);
    //     }


    //     $this->response($data, REST_Controller::HTTP_OK);
    // }

    // public function delete_get($id)
    // {
    //     header("Access-Control-Allow-Origin: *");
    //     header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");
    //     header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');
        
    //     $category_id = $id;

    //     if(empty($category_id)) 
    //     {
    //         $message = ['status' => 0,'message'=>"Invalid Inputs"];
    //     }
    //     else
    //     {
    //         $get_category = $this->courses_model->get_category_by_id($category_id);

    //         if($get_category != false)
    //         {

    //             $status = 200;
    //             $data = $get_category;

    //             $parent = $get_category->parent;

    //             if($parent == '0')
    //             {
    //               // it is parent

    //               $childs = $this->courses_model->get_child_categories($category_id);

    //               foreach ($childs as $child) 
    //               {
    //                 $this->courses_model->delete($child->id);
    //               }
    //             }
    //             $this->courses_model->delete($category_id);
    //         }
    //         else
    //         {
    //             $status = 400;
    //             $data = $id;
    //             $message = 'category not found.';
    //         }

    //         $message = [
    //                       'status' => $status, 
    //                       'category' => $data,  
    //                       // 'category_p' => $childs,  
    //                       // 'message' => $message
    //                     ];

    //     }

    //     $this->response($message, REST_Controller::HTTP_OK);
    // }

}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trainer_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function trainer_login($email,$password)
    {
		$this->db->select('*');
		$this->db->from('trainer');
		$this->db->where('email', $email);
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
		    $result=$query->row();
		    
			if(password_verify($password, $result->password))
			{
	            return $result;
			}
			else
		    {
			   return false;
	  	    }
	    }
		else
		{
			return false;
		}
    }
    
    function user_profile($data)
    {
        $this->db->select('*'); 
        $this->db->from('trainer');
        $this->db->where('trainer_id', $data);
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
           $result=$query->row();
           return $result;
        }
        else
        {
            return false;
        }
    }
}
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Courses_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function show_courses(){
        $this->db->select('*');
        $this->db->from('course');
        $query=$this->db->get();

        if($query->num_rows()>0){
            $result=$query->result();
            return $result;
        }else{
            return false;
        }
    }

    public function get_category_details_by_id($id) {
        return $this->db->get_where('category', array('id' => $id));
    }

    function create($data){
        $this->db->set($data);
        $this->db->insert('course');
        return true;
    }

    function update($data){
        $this->db->set($data);
        $this->db->where('id',$data['id']);
        $this->db->update('course');
        $afftectedRows = $this->db->affected_rows();
        if($afftectedRows > 0){
            return true;
        }else{
            return false;
        }
    }

    function delete($data){
        $this->db->select('*');
        $this->db->where('id', $data['course_id']);
        $query = $this->db->get('course');
        $row = $query->row();
        if(!is_null($row) == true){
            $this->db->where('id', $data['course_id']);
            $this->db->delete('course');
            return true;
        }else{
            return false;
        }    
    }

    public function get_course_by_id($course_id = "") {
        return $this->db->get_where('course', array('id' => $course_id));
    }

    function add_section($data){
        $course_id = $data['course_id'];
        $this->db->set($data);
        $this->db->insert('section');
        $section_id = $this->db->insert_id();
        $course_details = $this->get_course_by_id($course_id)->row_array();
        $previous_sections = json_decode($course_details['section']);

        if (!is_null($previous_sections)) {
          array_push($previous_sections, $section_id);
          $updater['section'] = json_encode($previous_sections);
          $this->db->where('id', $course_id);
          $this->db->update('course', $updater);
        }else {
          $previous_sections = array();
          array_push($previous_sections, $section_id);
          $updater['section'] = json_encode($previous_sections);
          $this->db->where('id', $course_id);
          $this->db->update('course', $updater);
        }
        return true;
    }

    function update_section($data){
        $this->db->set($data);
        $this->db->where('id',$data['id']);
        $this->db->update('section');
        $afftectedRows = $this->db->affected_rows();
        if($afftectedRows > 0){
            return true;
        }else{
            return false;
        }
    }

    public function get_section_by_id($section_id = "") {
        
        $this->db->select('*');
        $this->db->where('id', $section_id);
        $this->db->limit(1);
        $query = $this->db->get('section');
        $row = $query->row();
        return $row;
    }

    function delete_section($data){

        $this->db->where('id', $data['section_id']);
        $this->db->delete('section');
        $course_details = $this->get_course_by_id($data['course_id'])->row_array();
        $previous_sections = json_decode($course_details['section']);
        if (!is_null($previous_sections)) {
            $new_section = array();
            for ($i = 0; $i < sizeof($previous_sections); $i++) {
                if ($previous_sections[$i] != $data['section_id']) {
                array_push($new_section, $previous_sections[$i]);
                }
            }
            $updater['section'] = json_encode($new_section);
            $this->db->where('id', $data['course_id']);
            $this->db->update('course', $updater);
        }
        return true;
    }

    function add_lesson($data){
        if(!is_null($data)){
            $this->db->set($data);
            $this->db->insert('lesson');
            return true;
        }else{
            return false;
        }
    }

    function update_lesson($data){
        $this->db->set($data);
        $this->db->where('id',$data['id']);
        $re = $this->db->get('lesson');
        $afftectedRows = $this->db->affected_rows();
        if($afftectedRows > 0){
            return true;
        }else{
            return false;
        }
    }

    function delete_lesson($data){

        $this->db->select('*');
        $this->db->where('id', $data['lesson_id']);
        $query = $this->db->get('lesson');
        $row = $query->row();
        if(!is_null($row) == true){
            $this->db->where('id', $data['lesson_id']);
            $this->db->delete('lesson');
            return true;
        }else{
            return false;
        }    
    }


}

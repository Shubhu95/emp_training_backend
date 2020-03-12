<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function show_categories()
    {
        $this->db->select('*');
        $this->db->from('category');
        $query=$this->db->get();

        if($query->num_rows()>0)
        {
            $result=$query->result();
            return $result;
        }
        else
        {
            return false;
        }
    }

    function show_parent_categories()
    {
        $this->db->select('*');
        $this->db->where('parent', '0');
        $this->db->from('category');
        $query=$this->db->get();

        if($query->num_rows()>0)
        {
            $result=$query->result();
            return $result;
        }
        else
        {
            return false;
        }
    }

    function get_category_by_id($data)
    {

        $this->db->select('*'); 
        $this->db->from('category');
        $this->db->where('id', $data);
        $query = $this->db->get();

        if($query->num_rows()>0)
        {
           $result=$query->row();

            $this->db->select('*');                                            
            $this->db->from('category');
            $this->db->where('id', $result->parent);
            $query_=$this->db->get();
            if($query_->num_rows()>0)
            {
                $result->parent_list = $query_->row();
            }

           return $result;
        }
        else
        {
            return false;
        }
    }

    function create($data)
    {
        $this->db->set($data);
        $this->db->insert('category');

        return true;
    }

    function listing_categories()
    {
        $this->db->select('id, name, font_awesome_class, thumbnail');
        $this->db->from('category');
        $this->db->where('parent', '0');
        $query=$this->db->get();

        if($query->num_rows()>0)
        {
            $result=$query->result();

            for ($i=0; $i < count($result) ; $i++) 
            {
                $this->db->select('id, name, font_awesome_class, thumbnail');
                $this->db->from('category');
                $this->db->where('parent', $result[$i]->id);
                $query_=$this->db->get();
                if($query_->num_rows()>0)
                {
                    $result[$i]->parent_list = $query_->result();
                }
            }
            return $result;
        }
        else
        {
            return false;
        }
    }

    function edit($data)
    {

        // return $data;
        
        $this->db->set($data);
        $this->db->where('id',$data['id']);
        $this->db->update('category');

        $afftectedRows = $this->db->affected_rows();
        
        if($afftectedRows > 0)
        {
            return true;
        }

        else
        {
            return false;
        }
    }

    function delete($id)
    {
        // return $id;
        $this->db->where('id', $id);
        $this->db->delete('category');
    }

    function get_child_categories($id)
    {
        $this->db->select('id, name, font_awesome_class, thumbnail');
        $this->db->from('category');
        $this->db->where('parent', $id);
        $query=$this->db->get();
        $result=$query->result();

        return $result;
    }
}
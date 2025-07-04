<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('getProcess')) {

    function getGenders() {
        $CI = & get_instance();
        $CI->db->select('*')->from('genders');
        $CI->db->where('gender_status', 1);
        $query = $CI->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }
    function get_item_name($item_id){
        $CI = & get_instance();
        $CI->db->select('item_name')->from('items');
        $CI->db->where('item_id',$item_id);
         $query = $CI->db->get();
         if ($query->num_rows() > 0) {
            $result= $query->result_array();
            if($result){
                return $result[0]['item_name'];
            }else{
                return '?';
            }
        } else {
            return '--';
        }
    }
    function get_att_name($att_id,$table_name,$title,$type=false){
        
        $CI = & get_instance();
        $CI->db->select($title)->from($table_name);
        if($type){

            $CI->db->where($type.'_id',$att_id);
        }
         $query = $CI->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
            if($result){
                return $result[0][$title];
            }else{
                return '?';
            }
        } else {
            return '--';
        }
    }
    function getGendersDetail($gender_id) {
        $CI = & get_instance();
        $CI->db->select('*')->from('genders');
        $CI->db->where('gender_status', 1);
        $CI->db->where('gender_id',$gender_id);
        $query = $CI->db->get();
      
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }
    function getCountries() {
        $CI = & get_instance();
        $CI->db->select('*')->from('countries');
        $CI->db->where('country_status', 1);
        $query = $CI->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }
    function getStates($cnt_id) {
        $CI = & get_instance();
        $CI->db->select('*')->from('state');
        $CI->db->where('state_status', 1);
        $CI->db->where('country_fk', $cnt_id);
        $query = $CI->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }
    function getcities($cnt_id,$st_id) {
        $CI = & get_instance();
        $CI->db->select('*')->from('cities');
        $CI->db->where('city_status', 1);
        $CI->db->where('country_fk', $cnt_id);
        $CI->db->where('state_fk', $st_id);
        $query = $CI->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }
    

      function getCountryname() {
        $CI = & get_instance();
        $CI->db->select('country_id,country_name')->from('countries');
        $CI->db->where('country_status', 1);
        $query = $CI->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }
    function getStatesName($cnt_id) {
        $CI = & get_instance();
        $CI->db->select('state_id,state_name')->from('state');
        $CI->db->where('state_status', 1);
        $CI->db->where('country_fk', $cnt_id);
        $query = $CI->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }
    function getCityName($cnt_id,$st_id) {
        $CI = & get_instance();
        $CI->db->select('city_id,city_name')->from('cities');
        $CI->db->where('city_status', 1);
        $CI->db->where('country_fk', $cnt_id);
        $CI->db->where('state_fk', $st_id);
        $query = $CI->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }
    function getCatgoryName($cat_id) {
        $CI = & get_instance();
        $CI->db->select('category_name')->from('categories');
        $CI->db->where('category_status', 1);
            //    $CI->db->where('parent_id !=', 0);
        $CI->db->where('category_id', $cat_id);
        $query = $CI->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            
if($result[0]['category_name']){
    return $result[0]['category_name'];
}else{
    return 'none';
}
        } else {
             return 'none';
        }
    }
}
?>
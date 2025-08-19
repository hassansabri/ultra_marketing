<?php
class m_packing_stocks extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function getallpackings(){
         $this->db->select('*');
        $this->db->where('status','1');
        $query = $this->db->get("packing_options");
        return $query->result_array();
    }
    public function getlogs($data){
        $this->db->select('*');
        $this->db->where('packing_fk', $data['packing_fk']);
        $query = $this->db->get("packingstocks_logs");
        return $query->result_array();
    }
    public function getcurrentballance($data){
        $this->db->select_sum('balance');
        $this->db->where('packing_fk', $data['packing_fk']);
        $query = $this->db->get("packingstocks");
        return $query->result_array();
    }
}
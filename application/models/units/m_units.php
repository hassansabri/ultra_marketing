<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class m_units extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_all_units() {
        $query = $this->db->get('units');
        return $query->result_array();
    }

    public function add_unit($data) {
        $this->db->insert('units', $data);
        return $this->db->insert_id();
    }

    public function get_unit_detail($unit_id) {
        $query = $this->db->get_where('units', array('unit_id' => $unit_id));
        return $query->row_array();
    }

    public function update_unit($data, $unit_id) {
        $this->db->where('unit_id', $unit_id);
        $this->db->update('units', $data);
    }

    public function delete_unit($unit_id) {
        $this->db->where('unit_id', $unit_id);
        $this->db->delete('units');
    }

    public function update_unit_status($unit_id, $status) {
        $this->db->where('unit_id', $unit_id);
        $this->db->update('units', array('status' => $status));
    }
} 
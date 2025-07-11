<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class m_faq extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_all_faqs() {
        $query = $this->db->get('faqs');
        return $query->result_array();
    }

    public function add_faq($data) {
        $this->db->insert('faqs', $data);
        return $this->db->insert_id();
    }

    public function get_faq_detail($faq_id) {
        $query = $this->db->get_where('faqs', array('id' => $faq_id));
        return $query->row_array();
    }

    public function update_faq($data, $faq_id) {
        $this->db->where('id', $faq_id);
        $this->db->update('faqs', $data);
    }

    public function delete_faq($faq_id) {
        $this->db->where('id', $faq_id);
        $this->db->delete('faqs');
    }
} 
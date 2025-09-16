<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Packing_options extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('orders/m_orders', 'model_order');
        $this->load->library('form_validation');
    }
    
    public function index() {
        $this->data['packing_options'] = $this->model_order->getAllPackingOptions2();
        $this->load->view('packing_options/index', $this->data);
    }
    
    public function add() {
        $this->data = array();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->set_rules('packing_title', 'Packing Title', 'required|trim');
            $this->form_validation->set_rules('packing_cost', 'Packing Cost', 'numeric');
            
            if ($this->form_validation->run() == TRUE) {
                $this->data = array(
                    'packing_title' => $this->input->post('packing_title'),
                    'packing_description' => $this->input->post('packing_description'),
                    'packing_cost' => $this->input->post('packing_cost') ?: 0.00,
                    'original_cost' => $this->input->post('original_cost') ?: 0.00,
                    'status' => 1
                );
                
                $this->db->insert('packing_options', $this->data);
                $this->session->set_flashdata('success', 'Packing option added successfully.');
                redirect(site_url('packing_options'));
            }
        }
        
        $this->load->view('packing_options/form', $this->data);
    }
    
    public function edit($packing_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->set_rules('packing_title', 'Packing Title', 'required|trim');
            $this->form_validation->set_rules('packing_cost', 'Packing Cost', 'numeric');
            
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'packing_title' => $this->input->post('packing_title'),
                    'packing_description' => $this->input->post('packing_description'),
                    'packing_cost' => $this->input->post('packing_cost') ?: 0.00,
                    'original_cost' => $this->input->post('original_cost') ?: 0.00,
                    'modified_date' => date('Y-m-d H:i:s')
                );
                
                $this->db->where('packing_id', $packing_id);
                $this->db->update('packing_options', $data);
                $this->session->set_flashdata('success', 'Packing option updated successfully.');
                redirect(site_url('packing_options'));
            }
        }
        
        $this->data['packing_option'] = $this->model_order->getpackingdetail($packing_id);
        $this->load->view('packing_options/form', $this->data);
    }
    
    public function delete($packing_id) {
        // Check if packing option is being used in orders
        $this->db->where('packing_id', $packing_id);
        $orders_count = $this->db->count_all_results('orders');
        
        if ($orders_count > 0) {
            $this->session->set_flashdata('error', 'Cannot delete packing option as it is being used in orders.');
        } else {
            $this->db->where('packing_id', $packing_id);
            $this->db->delete('packing_options');
            $this->session->set_flashdata('success', 'Packing option deleted successfully.');
        }
        
        redirect(site_url('packing_options'));
    }
    
    public function toggle_status($packing_id) {
        $this->db->select('status');
        $this->db->where('packing_id', $packing_id);
        $query = $this->db->get('packing_options');
        $result = $query->row_array();
        
        if ($result) {
            $new_status = $result['status'] ? 0 : 1;
            $this->db->where('packing_id', $packing_id);
            $this->db->update('packing_options', array('status' => $new_status));
            
            $status_text = $new_status ? 'enabled' : 'disabled';
            $this->session->set_flashdata('success', "Packing option {$status_text} successfully.");
        }
        
        redirect(site_url('packing_options'));
    }
} 
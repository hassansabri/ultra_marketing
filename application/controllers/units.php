<?php
/**
 *  @property m_units $model_units
 *  @property CI_Session $session
 *  @property CI_Input $input
 */
class units extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) redirect('login');
        $this->load->model("units/m_units", "model_units");
    }

    public function index() {
        $data["all_units"] = $this->model_units->get_all_units();
        $this->load->view("units/all_units", $data);
    }

    public function addunit() {
        $data["update"] = "no";
        $this->load->view('units/add_unit', $data);
    }

    public function submitunit() {
        $sdat['unit_title'] = $this->input->post('unit_title');
        $this->model_units->add_unit($sdat);
        redirect(site_url() . 'units/index');
    }

    public function editunit($unit_id = false) {
        $data["update"] = "yes";
        $data["unit_detail"] = $this->model_units->get_unit_detail($unit_id);
        $this->load->view('units/edit_unit', $data);
    }

    public function updateunit($unit_id = false) {
        $sdat['unit_title'] = $this->input->post('unit_title');
        $this->model_units->update_unit($sdat, $unit_id);
        redirect(site_url() . '/units/editunit/' . $unit_id);
    }

    public function deleteunit($unit_id = false) {
        if ($unit_id) {
            $this->model_units->delete_unit($unit_id);
        }
        redirect(site_url() . 'units/index');
    }

    public function changestatus() {
        $unit_id = $this->input->post('unit_id');
        $status = $this->input->post('status');
        $this->model_units->update_unit_status($unit_id, $status);
    }
} 
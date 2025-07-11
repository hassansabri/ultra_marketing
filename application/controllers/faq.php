<?php
/**
 *  @property m_faq $model_faq
 *  @property CI_Session $session
 *  @property CI_Input $input
 */
class faq extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) redirect('login');
        $this->load->model("faq/m_faq", "model_faq");
    }

    public function index() {
        $data["all_faqs"] = $this->model_faq->get_all_faqs();
        $this->load->view("faq/all_faqs", $data);
    }

    public function addfaq() {
        $data["update"] = "no";
        $this->load->view('faq/add_faq', $data);
    }

    public function submitfaq() {
        $sdat['question'] = $this->input->post('question');
        $sdat['answer'] = $this->input->post('answer');
        $this->model_faq->add_faq($sdat);
        redirect(site_url() . 'faq/index');
    }

    public function editfaq($faq_id = false) {
        $data["update"] = "yes";
        $data["faq_detail"] = $this->model_faq->get_faq_detail($faq_id);
        $this->load->view('faq/edit_faq', $data);
    }

    public function updatefaq($faq_id = false) {
        $sdat['question'] = $this->input->post('question');
        $sdat['answer'] = $this->input->post('answer');
        $this->model_faq->update_faq($sdat, $faq_id);
        redirect(site_url() . '/faq/editfaq/' . $faq_id);
    }

    public function deletefaq($faq_id = false) {
        if ($faq_id) {
            $this->model_faq->delete_faq($faq_id);
        }
        redirect(site_url() . 'faq/index');
    }
} 
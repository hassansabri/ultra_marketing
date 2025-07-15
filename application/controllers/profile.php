<?php
/**
 * Profile Controller
 * 
 * Manages company profile information including shop details, contact information,
 * and company settings.
 * 
 * @author Hassan
 */

class profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->load->model("profile/m_profile", "model_profile");
    }

    /**
     * Display all profiles
     */
    public function index() {
        $this->data['all_profiles'] = $this->model_profile->getAllProfiles();
        $this->load->view('profile/all_profiles', $this->data);
    }

    /**
     * Add new profile
     */
    // public function addprofile() {
    //     $sbmt = $this->input->post("sbmt");
    //     if ($sbmt == "sbmt") {
    //         $data = array(
    //             "shop_name" => $this->input->post("shop_name"),
    //             "name" => $this->input->post("name"),
    //             "email" => $this->input->post("email"),
    //             "phone" => $this->input->post("phone"),
    //             "adress" => $this->input->post("adress"),
    //             "created_date" => date('Y-m-d H:i:s'),
    //             "modified_date" => date('Y-m-d H:i:s')
    //         );

    //         // Handle logo upload
    //         if (isset($_FILES['logo']['tmp_name']) && $_FILES['logo']['tmp_name'] != '') {
    //             $gallery_path = realpath(APPPATH . '../assets/img/');
    //             $name = $_FILES["logo"]["name"];
    //             $ext = end((explode(".", $name)));
    //             $random_digit = rand(00000000, 99999999);
    //             $fileName = $random_digit . "." . $ext;
    //             $config = array(
    //                 'allowed_types' => 'jpg|jpeg|gif|png',
    //                 'upload_path' => $gallery_path,
    //                 'overwrite' => false,
    //                 'max_size' => 2048, // 2MB max
    //                 'file_name' => $fileName
    //             );
    //             $this->load->library('upload', $config);
    //             $this->upload->initialize($config);
    //             if ($this->upload->do_upload("logo")) {
    //                 $data["logo"] = $fileName;
    //             }
    //         }

    //         $this->model_profile->insertProfile($data);
    //         $this->session->set_flashdata('success', 'Profile added successfully!');
    //         redirect(site_url() . 'profile');
    //     }

    //     $this->load->view('profile/add_profile', $this->data);
    // }

    /**
     * Edit existing profile
     */
    public function editprofile($profile_id = false) {
        if (!$profile_id) {
            redirect(site_url() . 'profile');
        }

        $sbmt = $this->input->post("sbmt");
        if ($sbmt == "sbmt") {
            $data = array(
                "shop_name" => $this->input->post("shop_name"),
                "name" => $this->input->post("name"),
                "email" => $this->input->post("email"),
                "phone" => $this->input->post("phone"),
                "adress" => $this->input->post("adress"),
                "modified_date" => date('Y-m-d H:i:s')
            );

            // Handle logo upload
            if (isset($_FILES['logo']['tmp_name']) && $_FILES['logo']['tmp_name'] != '') {
                $gallery_path = realpath(APPPATH . '../images/');
                $name = $_FILES["logo"]["name"];
                $ext = end((explode(".", $name)));
                $random_digit = rand(00000000, 99999999);
                $fileName = $random_digit . "." . $ext;
                $config = array(
                    'allowed_types' => 'jpg|jpeg|gif|png',
                    'upload_path' => $gallery_path,
                    'overwrite' => false,
                    'max_size' => 2048, // 2MB max
                    'file_name' => $fileName
                );
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload("logo")) {
                    // Delete old logo if exists
                    $old_profile = $this->model_profile->getProfileById($profile_id);
                    if ($old_profile && isset($old_profile['logo']) && $old_profile['logo'] != '') {
                        $old_logo_path = $gallery_path . '/' . $old_profile['logo'];
                        if (file_exists($old_logo_path)) {
                            unlink($old_logo_path);
                        }
                    }
                    $data["logo"] = $fileName;
                }
            }

            $this->model_profile->updateProfile($data, $profile_id);
            $this->session->set_flashdata('success', 'Profile updated successfully!');
            redirect(site_url() . 'profile');
        }

        $this->data["profile_id"] = $profile_id;
        $this->data["profile_detail"] = $this->model_profile->getProfileById($profile_id);
        $this->load->view('profile/edit_profile', $this->data);
    }

    /**
     * View profile details
     */
    public function viewprofile($profile_id = false) {
        if (!$profile_id) {
            redirect(site_url() . 'profile');
        }

        $this->data["profile_detail"] = $this->model_profile->getProfileById($profile_id);
        $this->load->view('profile/view_profile', $this->data);
    }
    /**
     * Change profile status
     */
    public function changestatus($profile_id = false, $status = false) {
        if (!$profile_id) {
            redirect(site_url() . 'profile');
        }

        $data = array("status" => $status);
        $this->model_profile->updateProfile($data, $profile_id);
        $this->session->set_flashdata('success', 'Profile status updated successfully!');
        redirect(site_url() . 'profile');
    }
}
?> 
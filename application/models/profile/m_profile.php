<?php
/**
 * Profile Model
 * 
 * Handles database operations for profile management including CRUD operations
 * for company profiles.
 * 
 * @author Hassan
 */

class m_profile extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all profiles
     */
    public function getAllProfiles() {
        $this->db->order_by('profile_id', 'DESC');
        $query = $this->db->get("profile");
        return $query->result_array();
    }

    /**
     * Get profile by ID
     */
    public function getProfileById($profile_id) {
        $this->db->where('profile_id', $profile_id);
        $query = $this->db->get("profile");
        if (sizeof($query->result_array()) > 0) {
            return $query->result_array()[0];
        } else {
            return array();
        }
    }

    /**
     * Get profile details (for backward compatibility)
     */
    public function getprofiledetail() {
        $this->db->where('profile_id', '1');
        $query = $this->db->get("profile");
        return $query->result_array();
    }

    /**
     * Insert new profile
     */
    public function insertProfile($data) {
        $this->db->insert('profile', $data);
        return $this->db->insert_id();
    }

    /**
     * Update existing profile
     */
    public function updateProfile($data, $profile_id) {
        $this->db->where('profile_id', $profile_id);
        $this->db->update('profile', $data);
        return $this->db->affected_rows();
    }

    /**
     * Delete profile
     */
    public function deleteProfile($profile_id) {
        $this->db->where('profile_id', $profile_id);
        $this->db->delete('profile');
        return $this->db->affected_rows();
    }

    /**
     * Check if profile exists
     */
    public function profileExists($profile_id) {
        $this->db->where('profile_id', $profile_id);
        $query = $this->db->get("profile");
        return $query->num_rows() > 0;
    }

    /**
     * Get active profiles
     */
    public function getActiveProfiles() {
        $this->db->where('status', 1);
        $this->db->order_by('profile_id', 'DESC');
        $query = $this->db->get("profile");
        return $query->result_array();
    }

    /**
     * Search profiles
     */
    public function searchProfiles($search_term) {
        $this->db->like('shop_name', $search_term);
        $this->db->or_like('name', $search_term);
        $this->db->or_like('email', $search_term);
        $this->db->or_like('phone', $search_term);
        $this->db->order_by('profile_id', 'DESC');
        $query = $this->db->get("profile");
        return $query->result_array();
    }

    /**
     * Get profile count
     */
    public function getProfileCount() {
        return $this->db->count_all('profile');
    }

    /**
     * Get profiles with pagination
     */
    public function getProfilesWithPagination($limit, $offset) {
        $this->db->limit($limit, $offset);
        $this->db->order_by('profile_id', 'DESC');
        $query = $this->db->get("profile");
        return $query->result_array();
    }
}
?> 
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seminar_model extends CI_Model
{
    public function insert_seminar($data)
    {
        $this->db->insert('seminar', $data);
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function get_all_seminar()
    {
        $query = $this->db->get('seminar');
        if ($query->num_rows() > 0) {
            return $query->result_array(); // Fetching data as an associative array
        } else {
            return array(); // Return empty array if no data found
        }
    }

    public function get_seminars_by_user_id($user_id)
    {
        $sql = "SELECT * FROM seminar WHERE user_id = ?";
        $query = $this->db->query($sql, array($user_id));

        if ($query->num_rows() > 0) {
            return $query->result_array(); // Fetching data as an associative array
        } else {
            return array(); // Return empty array if no data found
        }
    }

    // Update data seminar berdasarkan ID
    public function update_seminar($seminar_id, $data)
    {
        $this->db->where('id', $seminar_id);
        return $this->db->update('seminar', $data);
    }

    public function delete_seminar($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('seminar');
    }

    public function __construct()
    {
        parent::__construct();
        // Load library database
        $this->load->database();
    }
}

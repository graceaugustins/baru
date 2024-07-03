<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hardskill_Softskill_model extends CI_Model
{
    public function insert_hardskill_softskill($data)
    {
        $this->db->insert('hardskill_softskill', $data);
    }

    public function get_all_hardskill_softskill()
    {
        $query = $this->db->get('hardskill_softskill');
        if ($query->num_rows() > 0) {
            return $query->result_array(); // Fetching data as an associative array
        } else {
            return array(); // Return empty array if no data found
        }
    }

    public function get_hardskill_softskill_by_user_id($user_id)
    {
        $sql = "SELECT * FROM hardskill_softskill WHERE user_id = ?";
        $query = $this->db->query($sql, array($user_id));

        if ($query->num_rows() > 0) {
            return $query->result_array(); // Fetching data as an associative array
        } else {
            return array(); // Return empty array if no data found
        }
    }

    public function delete_hardskill($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('hardskill_softskill');
    }

    // Update data hardskill & softskill berdasarkan ID
    public function update_hardskill_softskill($hardskill_id, $data)
    {
        $this->db->where('id', $hardskill_id);
        return $this->db->update('hardskill_softskill', $data);
    }
}

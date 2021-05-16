<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Manager_model extends CI_Model {
    
    public function create($formArray) {
        $this->db->insert('manager', $formArray);
    }

    public function getManagers() {
        return $this->db->get('manager')->result_array();
    }

    public function getByUsername($username) {
        $this->db->where('m_username', $username);
        $manager = $this->db->get('manager')->row_array();
        return $manager;
    }

    public function getManagerId($id) {
        $this->db->where('m_id', $id);
        return $this->db->get('manager')->row_array();
    }

    public function update($id, $formArray) {
        $this->db->where('m_id', $id);
        $this->db->update('manager', $formArray);
    }

    public function delete($id) {
        $this->db->where('m_id',$id);
        $this->db->delete('manager');
    }
}
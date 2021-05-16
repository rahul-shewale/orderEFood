<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class User_model extends CI_Model {
    
    public function create($formArray) {
        $this->db->insert('user', $formArray);
    }

    //admin
    public function getUsers() {
        $result = $this->db->get('user')->result_array();
        return $result;
    }

    //checkout page , profile, delete
    public function getUserById($id) {
        $this->db->where('u_id', $id);
        $user = $this->db->get('user')->row_array();
        return $user;
    }

    //checkout page
    public function update($id, $formArray) {
        $this->db->where('u_id',$id);
        $this->db->update('user', $formArray);
    }

    //admin
    public function delete($id) {
        $this->db->where('u_id',$id);
        $this->db->delete('user');
    }

    //admin
    public function countUser() {
        $query = $this->db->get('user');
        return $query->num_rows();
    }

    public function getByUsername($username) {
        $this->db->where('username', $username);
        $mainuser = $this->db->get('user')->row_array();
        return $mainuser;
    }

    public function getuser() {
        $result = $this->db->get('user')->result_array();
        return $result;
    }
}

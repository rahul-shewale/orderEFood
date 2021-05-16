<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Menu_model extends CI_Model {
    
    //for insert
    public function create($formArray) {
        $this->db->insert('dishes', $formArray);
    }

    //for manager
    public function getMenu($m_id) {
        $this->db->where('m_id',$m_id);
        $result = $this->db->get('dishes')->result_array();
        return $result;
    }

    public function getAllMenu() {
        $result = $this->db->get('dishes')->result_array();
        return $result;
    }

    //cart addToCart, edit menu, delete menu
    public function getSingleDish($id) {
        $this->db->where('d_id', $id);
        $dish = $this->db->get('dishes')->row_array();
        return $dish;
    }

    public function update($id, $formArray) {
        $this->db->where('d_id', $id);
        $this->db->update('dishes', $formArray);
    } 

    public function delete($id) {
        $this->db->where('d_id',$id);
        $this->db->delete('dishes');
    }
    //counr for admin
    public function countDish() {
        $query = $this->db->get('dishes');
        return $query->num_rows();
    }

    //count for manager
    public function countDishMId($id) {
        $this->db->where('m_id',$id);
        $query = $this->db->get('dishes');
        return $query->num_rows();
    }

    //for dish list page 
    public function getdishes($id) {
        $this->db->where('r_id', $id);
        $dish = $this->db->get('dishes')->result_array();
        return $dish;
    }
}

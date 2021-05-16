<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Store_model extends CI_Model {
    
    //create
    public function create($formArray) {
        $this->db->insert('restaurants', $formArray);
    }

    //for manager
    public function getStores($m_id) {
        $this->db->where('m_id', $m_id);
        $result = $this->db->get('restaurants')->result_array();
        return $result;
    }

    //for dish list page, manager edit
    public function getStore($id) {
        $this->db->where('r_id', $id);
        $store = $this->db->get('restaurants')->row_array();
        return $store;
    }

    public function update($id, $formArray) {
        $this->db->where('r_id', $id);
        $this->db->update('restaurants', $formArray);
    } 

    public function delete($id) {
        $this->db->where('r_id',$id);
        $this->db->delete('restaurants');
    }

    //count for admin
    public function countStore() {
        $query = $this->db->get('restaurants');
        return $query->num_rows();
    }

    //count for manager
    public function countStoreMId($id) {
        $this->db->where('m_id',$id);
        $query = $this->db->get('restaurants');
        return $query->num_rows();
    }

    //for restaurant page
    public function getResInfo() {
        $this->db->select('*');
        $this->db->from('restaurants');
        $this->db->join('res_category','restaurants.c_id = res_category.c_id');
        $result = $this->db->get()->result_array();
        return $result;
    }

}

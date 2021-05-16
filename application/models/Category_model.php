<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Category_model extends CI_Model {
    //
    public function create_cat($cat) {
        $this->db->insert('res_category', $cat);
    }

    //manager, edit store
    public function getCategory($id) {
        $this->db->where('m_id', $id);
        $cats_result = $this->db->get('res_category')->result_array();
        return $cats_result;
    }

    //manager
    public function getCategoryId($id) {
        $this->db->where('c_id', $id);
        $cats_result = $this->db->get('res_category')->row_array();
        return $cats_result;
    }

    //
    public function update($id, $cat) {
        $this->db->where('c_id', $id);
        $this->db->update('res_category', $cat);
    }

    //
    public function delete($id) {
        $this->db->where('c_id', $id);
        $this->db->delete('res_category');
    }


}
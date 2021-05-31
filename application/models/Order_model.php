<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Order_model extends CI_Model {

    public function getOrders() {
        $this->db->order_by('o_id','DESC');
        $result = $this->db->get('user_orders')->result_array();
        return $result;
    }

    //delete
    public function getOrder($id) {
        $this->db->where('o_id', $id);
        $result = $this->db->get('user_orders')->row_array();
        return $result;
    }

    // Orders page
    public function getUserOrder($id) {
        $this->db->where('u_id', $id);
        $this->db->order_by('o_id','DESC');
        $result = $this->db->get('user_orders')->result_array();
        return $result;
    }

    public function update($id, $status) {
        $this->db->where('o_id', $id);
        $this->db->update('user_orders', $status);
    }

    public function deleteOrder($id) {
        $this->db->where('o_id', $id);
        $this->db->delete('user_orders');
    }
    
    //checkout
    public function insertOrder($orderData) {
        $this->db->insert_batch('user_orders', $orderData);
        return $this->db->insert_id();
    }

    public function countOrders() {
        $this->db->where('o_status','closed');
        $query = $this->db->get('user_orders');
        return $query->num_rows();
    }

    //count for manager
    public function countOrdersMId($id) {
        $this->db->where('m_id',$id);
        $this->db->where('o_status','closed');
        $query = $this->db->get('user_orders');
        return $query->num_rows();
    }

    //order info for user
    public function orderForUser($id) {
        $this->db->where('o.u_id', $id);
        $this->db->order_by('o.o_id','DESC');
        $this->db->select('*');
        $this->db->from('user_orders AS o');
        $this->db->join('dishes AS d', 'd.d_id = o.d_id');
        return $this->db->get()->result_array();
    }

    //order info in invoice
    public function orderInfoInvoice($id) {
        $this->db->where('o.o_id', $id);
        $this->db->select('*');
        $this->db->from('user_orders AS o');
        $this->db->join('dishes AS d', 'd.d_id = o.d_id');
        $this->db->join('user AS u', 'u.u_id = o.u_id');
        $this->db->join('restaurants AS r', 'r.r_id = o.r_id');
        $result = $this->db->get()->row_array();
        return $result;
    }

    //order in manager
    public function allOrdersByMID($id) {
        $this->db->order_by('o.o_id','DESC');
        $this->db->select('*');
        $this->db->from('user_orders AS o');
        $this->db->join('user AS u','o.u_id = u.u_id');
        $this->db->join('dishes AS d','o.d_id = d.d_id');
        $this->db->where('o.m_id',$id);
        return $this->db->get()->result_array();
    }

    //order in manager
    public function allOrdersByMIdOId($id, $m_id) {
        $this->db->select('*');
        $this->db->from('user_orders AS o');
        $this->db->join('user AS u','o.u_id = u.u_id');
        $this->db->join('dishes AS d','o.d_id = d.d_id');
        $this->db->where('o.o_id ',$id);
        $this->db->where('o.m_id',$m_id);
        return $this->db->get()->row_array();
    }

    public function getAllOrders() {
        $this->db->order_by('o_id','DESC');
        $this->db->select('o_id, d_name, o_quantity, o_price, o_status, date, username, address');
        $this->db->from('user_orders');
        $this->db->join('users', 'users.u_id = user_orders.u_id');
        $result = $this->db->get()->result_array();
        return $result;
    }
}
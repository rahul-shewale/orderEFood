<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Admin_model extends CI_Model {
    
    public function getByUsername($username) {
        $this->db->where('a_username', $username);
        $admin = $this->db->get('admin')->row_array();
        return $admin;
    }

    public function getResReport() {
        $this->db->group_by('u.r_id');
        $this->db->select('u.r_id, r.r_name, u.o_price, u.success-date');
        $this->db->select_sum('u.o_price');
        $this->db->from('user_orders as u');
        $this->db->join('restaurants as r', 'r.r_id = u.r_id');
        $result = $this->db->get()->result();
        return $result;
    }

    // public function getResReport() {
    //     $query = $this->db->query('select o.r_id, r.r_name, sum(o.o_price) as total-sales, o.success-date
    //     from user_orders as o
    //     inner join restaurants as r
    //     on o.r_id = r.r_id
    //     group by o.r_id
    //     having o.success-date between to_date("2020-01-01") and to_date("2022-01-01")');
    //     return $query->result();
    // }


    public function dishReport() {
        $query = $this->db->query('select d.d_id, d.d_name, SUM(o.o_quantity) as qty
        from user_orders as o
        inner join dishes as d
        on o.d_id = d.d_id
        group by o.d_id
        order by sum(o.o_quantity) desc');
        return $query->result();
    }

    //$sql = ''

    // public function dishReport() {
    //     $query = $this->db->query('SELECT d_id, d_name, 
    //     SUM(o_quantity) AS qty
    //     FROM user_orders
    //     GROUP BY d_id
    //     ORDER BY SUM(o_quantity) DESC');
    //     return $query->result();
    // }

    // public function mostOrderdDishes() {
    //     $sql = 'SELECT u.r_id, r.name, u.price, u.d_name, 
    //     MAX(u.quantity) AS quantity, 
    //     SUM(price) AS total
    //     FROM user_orders AS u
    //     INNER JOIN restaurants as r
    //     ON u.r_id = r.r_id
    //     GROUP BY u.r_id';

    //     $query = $this->db->query($sql);
    //     return $query->result();
    // }
}
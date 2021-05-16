<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $admin = $this->session->userdata('admin');
        if(empty($admin)) {
            $this->session->set_flashdata('msg', 'Your session has been expired');
            redirect(base_url().'admin/login/index');
        }
    }

    public function index() {
        $this->load->model('User_model');
        $users = $this->User_model->getUsers();
        $data['users'] = $users;
        $this->load->view('admin/partials/header');
        $this->load->view('admin/user/list', $data);
        $this->load->view('admin/partials/footer');
    }

    public function delete($id) {
        $this->load->model('User_model');
        $user = $this->User_model->getUserById($id);

        if(empty($user)) {
            $this->session->set_flashdata('error', 'User not found');
            redirect(base_url().'admin/user/index');
        }

        $this->User_model->delete($id);

        $this->session->set_flashdata('success', 'User deleted successfully');
        redirect(base_url().'admin/user/index');

    }

}
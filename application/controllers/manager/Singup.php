<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Singup extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Manager_model');
    }


    public function index() {
        $this->load->view('manager/singup');
    }

    public function add() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
        $this->form_validation->set_rules('username', 'Username','trim|required');
        $this->form_validation->set_rules('email', 'Email','trim|required');
        $this->form_validation->set_rules('password', 'Password','trim|required');
        $this->form_validation->set_rules('phone', 'Phone','trim|required');

        if($this->form_validation->run() == true) {

            $formArray['m_username'] = $this->input->post('username');
            $formArray['m_email'] = $this->input->post('email');
            $formArray['m_password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $formArray['m_phone'] = $this->input->post('phone');

            $this->Manager_model->create($formArray);
            $this->session->set_flashdata("success", "Account created successfully, please login");
            redirect(base_url().'manager/login/index');
        } else {
            $this->load->view('manager/singup');
        }
    }
}
<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Manager extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $admin = $this->session->userdata('admin');
        if(empty($admin)) {
            $this->session->set_flashdata('msg', 'Your session has been expired');
            redirect(base_url().'admin/login/index');
        }

        $this->load->model('Manager_model');

    }

    public function index() {
        $managers = $this->Manager_model->getManagers();
        $data['managers'] = $managers;
        $this->load->view('admin/partials/header');
        $this->load->view('admin/manager/list', $data);
        $this->load->view('admin/partials/footer');
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

            $this->session->set_flashdata('success', 'Manager data added successfully');
            redirect(base_url(). 'admin/manager/index');


        } else {
            $this->load->view('admin/partials/header');
            $this->load->view('admin/manager/add');
            $this->load->view('admin/partials/footer');
        }
    
    }
    public function edit($id) {
        $this->load->model('Manager_model');
        $manager = $this->Manager_model->getManagerId($id);

        if(empty($manager)) {
            $this->session->set_flashdata('error', 'Manager not found');
            redirect(base_url().'admin/manager');
        }

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

            $this->Manager_model->update($id,$formArray);

            $this->session->set_flashdata('success', 'Manager updated successfully');
            redirect(base_url(). 'admin/manager/index');

        } else {
            $data['manager'] = $manager;
            $this->load->view('admin/partials/header');
            $this->load->view('admin/manager/edit', $data);
            $this->load->view('admin/partials/footer');
        }
    }

    public function delete($id) {
        $this->load->model('Manager_model');
        $manager = $this->Manager_model->getManagerId($id);

        if(empty($manager)) {
            $this->session->set_flashdata('error', 'Manager not found');
            redirect(base_url().'admin/manager/index');
        }

        $this->Manager_model->delete($id);

        $this->session->set_flashdata('success', 'Manager deleted successfully');
        redirect(base_url().'admin/manager/index');

    }
}
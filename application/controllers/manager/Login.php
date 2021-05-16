<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		$this->load->view('manager/login');
	}

	public function authenticate() {
        $this->load->library('form_validation');
        $this->load->model('Manager_model');
        
        $this->form_validation->set_rules('username','Username', 'trim|required');
        $this->form_validation->set_rules('password','Password', 'trim|required');

         if($this->form_validation->run() == true) {
             $username = $this->input->post('username');
             $manager = $this->Manager_model->getByUsername($username);
             if(!empty($manager)) {
                $password = $this->input->post('password');
                if( password_verify($password, $manager['m_password']) == true) {

                    $managerArray['manager_id'] = $manager['m_id'];
                    $managerArray['m_username'] = $manager['m_username'];
                    $this->session->set_userdata('manager', $managerArray);
                    redirect(base_url().'manager/home');
                } else {
                    $this->session->set_flashdata('msg', 'Either username or password is incorrect');
                    redirect(base_url().'manager/login');
                }
             } else {
                $this->session->set_flashdata('msg', 'Either username or password is incorrect');
                redirect(base_url().'manager/login');
             }
             //success
         } else {
             //Error
            $this->load->view('manager/login');
         }
    }

    public function logout() {
        $this->session->unset_userdata('manager');
        redirect(base_url().'manager/login');
    }
}

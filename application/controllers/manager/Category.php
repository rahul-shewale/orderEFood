<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $manager = $this->session->userdata('manager');
        if(empty($manager)) {
            $this->session->set_flashdata('msg', 'Your session has been expired');
            redirect(base_url().'manager/login/index');
        }
        $this->load->model('Category_model');
    }

    public function index() {
        $manager = $this->session->userdata('manager');
        $m_id = $manager["manager_id"];

        $cats = $this->Category_model->getCategory($m_id);
        $cats_data['cats'] = $cats;
        $this->load->view('manager/partials/header');
        $this->load->view('manager/category/list', $cats_data);
        $this->load->view('manager/partials/footer');
    }

    public function add(){
        $manager = $this->session->userdata('manager');
        $m_id = $manager["manager_id"];

        $this->load->model('Category_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('category','Category', 'trim|required');

        if($this->form_validation->run() == true) {
            
            $cat['c_name'] = $this->input->post('category');
            $cat['m_id'] = $m_id;
            $this->Category_model->create_cat($cat);
            
            $this->session->set_flashdata('cat_success', 'category added successfully');
            redirect(base_url().'manager/category/index');
        } else {
            $this->load->view('manager/partials/header');
            $this->load->view('manager/category/add');
            $this->load->view('manager/partials/footer');
        }
    }

    public function edit($id) {
        $manager = $this->session->userdata('manager');
        $m_id = $manager['manager_id'];

        $this->load->model('Category_model');
        $cat = $this->Category_model->getCategoryId($id);

        if(empty($cat)) {
            $this->session->set_flashdata('error', 'Category not found');
            redirect(base_url().'manager/category/index');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('category','Category', 'trim|required');

        if($this->form_validation->run() == true) {

            $cat['m_id'] = $m_id;
            $cat['c_name'] = $this->input->post('category');
            $this->Category_model->update($id, $cat);
            
            $this->session->set_flashdata('cat_success', 'category added successfully');
            redirect(base_url().'manager/category/index');

        } else {
            $data['cat'] = $cat;
            $this->load->view('manager/partials/header');
            $this->load->view('manager/category/edit', $data);
            $this->load->view('manager/partials/footer');
        }

    }

    public function delete($id) {
        $this->load->model('Category_model');
        $cat = $this->Category_model->getCategoryId($id);

        if(empty($cat)) {
            $this->session->set_flashdata('error', 'Category not found');
            redirect(base_url().'manager/category/index');
        }

        $cat = $this->Category_model->delete($id);

        $this->session->set_flashdata('cat_success', 'Category deleted successfully');
        redirect(base_url().'manager/category/index');
    }
}
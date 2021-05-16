<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Menu extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $manager = $this->session->userdata('manager');
        if(empty($manager)) {
            $this->session->set_flashdata('msg', 'Your session has been expired');
            redirect(base_url().'manager/login/index');
        }
        $this->load->helper('url');
    }

    public function index() {
        $manager = $this->session->userdata('manager');
        $m_id = $manager["manager_id"];

        $this->load->model('Menu_model');
        $dishesh = $this->Menu_model->getMenu($m_id);
        $data['dishesh'] = $dishesh;
        $this->load->view('manager/partials/header');
        $this->load->view('manager/menu/list', $data);
        $this->load->view('manager/partials/footer');
    }

    public function add(){
        $manager = $this->session->userdata('manager');
        $m_id = $manager["manager_id"];
        
        $this->load->helper('common_helper');
        $this->load->model('Store_model');
        $store = $this->Store_model->getStores($m_id);

        $config['upload_path']          = './public/uploads/dishesh/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        //$config['encrypt_name']         = true;

        $this->load->library('upload', $config);

        $this->load->model('Menu_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
        $this->form_validation->set_rules('name', 'Dish name','trim|required');
        $this->form_validation->set_rules('about', 'About','trim|required');
        $this->form_validation->set_rules('price', 'Price','trim|required');
        $this->form_validation->set_rules('rname', 'Restaurant name','trim|required');


        if($this->form_validation->run() == true) {

            if(!empty($_FILES['image']['name'])){
                //image is selected
                if($this->upload->do_upload('image')) {
                    //file uploaded suceessfully
                    $data = $this->upload->data();
                    //resizing image
                    resizeImage($config['upload_path'].$data['file_name'], $config['upload_path'].'thumb/'.$data['file_name'], 300,270);

                    $formArray['d_img'] = $data['file_name'];
                    $formArray['d_name'] = $this->input->post('name');
                    $formArray['d_about'] = $this->input->post('about');
                    $formArray['d_price'] = $this->input->post('price');
                    $formArray['r_id'] = $this->input->post('rname');
                    $formArray['m_id'] = $m_id;

                    $this->Menu_model->create($formArray);
        
                    $this->session->set_flashdata('dish_success', 'Menu added successfully');
                    redirect(base_url(). 'manager/menu/index');

                } else {
                    //we got some errors
                    $error = $this->upload->display_errors("<p class='invalid-feedback'>","</p>");
                    $data['errorImageUpload'] = $error; 
                    $data['stores']= $store;
                    $this->load->view('manager/partials/header');
                    $this->load->view('manager/menu/add', $data);
                    $this->load->view('manager/partials/footer');
                }

                
            } else {
                //if no image is selcted we will add res data without image
                $formArray['d_name'] = $this->input->post('name');
                $formArray['d_about'] = $this->input->post('about');
                $formArray['d_price'] = $this->input->post('price');
                $formArray['r_id'] = $this->input->post('rname');
                $formArray['m_id'] = $m_id;

                $this->Menu_model->create($formArray);
                
                $this->session->set_flashdata('dish_success', 'Dish added successfully');
                redirect(base_url(). 'manager/menu/index');
            }

        } else {
            $store_data['stores']= $store;
            $this->load->view('manager/partials/header');
            $this->load->view('manager/menu/add', $store_data);
            $this->load->view('manager/partials/footer');
        }
        
    }

    public function edit($id) {
        $manager = $this->session->userdata('manager');
        $m_id = $manager["manager_id"];

        $this->load->model('Menu_model');
        $dish = $this->Menu_model->getSingleDish($id);

        $this->load->model('Store_model');
        $store = $this->Store_model->getStores($m_id);
        
        if(empty($dish)) {

            $this->session->set_flashdata('error', 'Dish not found');
            redirect(base_url(). 'manager/menu/index');
        }

        $this->load->helper('common_helper');

        $config['upload_path']          = './public/uploads/dishesh/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        //$config['encrypt_name']         = true;

        $this->load->library('upload', $config);

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
        $this->form_validation->set_rules('name', 'Dish name','trim|required');
        $this->form_validation->set_rules('about', 'About','trim|required');
        $this->form_validation->set_rules('price', 'Price','trim|required');
        $this->form_validation->set_rules('rname', 'Restaurant name','trim|required');

        if($this->form_validation->run() == true) {

            if(!empty($_FILES['image']['name'])){
                //image is selected
                if($this->upload->do_upload('image')) {
                    //file uploaded suceessfully
                    $data = $this->upload->data();
                    //resizing image
                    resizeImage($config['upload_path'].$data['file_name'], $config['upload_path'].'thumb/'.$data['file_name'], 300,270);

                    $formArray['m_id'] = $m_id;
                    $formArray['d_img'] = $data['file_name'];
                    $formArray['d_name'] = $this->input->post('name');
                    $formArray['d_about'] = $this->input->post('about');
                    $formArray['d_price'] = $this->input->post('price');
                    $formArray['r_id'] = $this->input->post('rname');
        
                    $this->Menu_model->update($id, $formArray);

                    //deleting existing images

                    if (file_exists('./public/uploads/dishesh/'.$dish['d_img'])) {
                        unlink('./public/uploads/dishesh/'.$dish['d_img']);
                    }

                    if(file_exists('./public/uploads/dishesh/thumb/'.$dish['d_img'])) {
                        unlink('./public/uploads/dishesh/thumb/'.$dish['d_img']);
                    }
        
                    $this->session->set_flashdata('dish_success', 'Dish updated successfully');
                    redirect(base_url(). 'manager/menu/index');

                } else {
                    //we got some errors
                    $error = $this->upload->display_errors("<p class='invalid-feedback'>","</p>");
                    $data['errorImageUpload'] = $error;
                    $data['dish'] = $dish;
                    $data['stores'] = $store;
                    $this->load->view('manager/partials/header');
                    $this->load->view('manager/menu/edit', $data);
                    $this->load->view('manager/partials/footer');
                }

                
            } else {
                //if no image is selcted we will add res data without image
                $formArray['m_id'] = $m_id;
                $formArray['d_name'] = $this->input->post('name');
                $formArray['d_about'] = $this->input->post('about');
                $formArray['d_price'] = $this->input->post('price');
                $formArray['r_id'] = $this->input->post('rname');
    
                $this->Menu_model->update($id, $formArray);
    
                $this->session->set_flashdata('dish_success', 'Dish updated successfully');
                redirect(base_url(). 'manager/menu/index');
            }

        } else {
            $data['dish'] = $dish;
            $data['stores'] = $store;
            $this->load->view('manager/partials/header');
            $this->load->view('manager/menu/edit', $data);
            $this->load->view('manager/partials/footer');

        }

    }

    public function delete($id){

        $this->load->model('Menu_model');
        $dish = $this->Menu_model->getSingleDish($id);

        if(empty($dish)) {
            $this->session->set_flashdata('error', 'dish not found');
            redirect(base_url().'manager/menu');
        }

        if (file_exists('./public/uploads/dishesh/'.$dish['d_img'])) {
            unlink('./public/uploads/dishesh/'.$dish['d_img']);
        }

        if(file_exists('./public/uploads/dishesh/thumb/'.$dish['d_img'])) {
            unlink('./public/uploads/dishesh/thumb/'.$dish['d_img']);
        }

        $this->Menu_model->delete($id);

        $this->session->set_flashdata('dish_success', 'dish deleted successfully');
        redirect(base_url().'manager/menu/index');

    }
}
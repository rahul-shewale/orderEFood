<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Orders extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $manager = $this->session->userdata('manager');
        if(empty($manager)) {
            $this->session->set_flashdata('msg', 'Your session has been expired');
            redirect(base_url().'manager/login/index');
        }
        $this->load->helper('date');
        $this->load->model('Order_model');
        $this->load->model('User_model');
    }

    public function index() {
        $manager = $this->session->userdata('manager');
        $m_id = $manager['manager_id'];
        $order = $this->Order_model->allOrdersByMID($m_id);
        $data['orders'] = $order;
        $this->load->view('manager/partials/header');
        $this->load->view('manager/orders/list', $data);
        $this->load->view('manager/partials/footer');
    }

    public function processOrder($id) {
        $manager = $this->session->userdata('manager');
        $m_id = $manager['manager_id'];

        $order = $this->Order_model->allOrdersByMIdOId($id, $m_id);

        $data['order'] = $order;
        $this->load->view('manager/partials/header');
        $this->load->view('manager/orders/processOrder', $data);
        $this->load->view('manager/partials/footer');
    }

    public function updateOrder($id) {
        $manager = $this->session->userdata('manager');
        $m_id = $manager['manager_id'];

        $this->load->library('form_validation');
        $this->form_validation->set_rules('status','Status', 'trim|required');

        if($this->form_validation->run() == true) {

            $order['o_status'] = $this->input->post('status');
            $orderData['success-date'] = date('Y-m-d H:i:s', now());
            $this->Order_model->update($id, $order);
            
            $this->session->set_flashdata('success', 'Order processed successfully');
            redirect(base_url().'manager/orders/index');

        } else {
            $order = $this->Order_model->allOrdersByMID($m_id);
            $data['orders'] = $order;
        }
    }

    public function deleteOrder($id) {
        $order = $this->Order_model->getOrder($id);
        $data['orders'] = $order;


        if(empty($order)) {
            $this->session->set_flashdata('error', 'Order not found');
            redirect(base_url().'manager/orders/index');
        }

        $this->Order_model->deleteOrder($id);

        $this->session->set_flashdata('success', 'Order deleted successfully');
        redirect(base_url().'manager/orders/index');
    }

    public function invoice($id) {
        $order = $this->Order_model->orderInfoInvoice($id);
        $data['order'] = $order;
        if($order['o_status'] == 'closed') {
            $this->load->view('manager/orders/invoice', $data);
        } else {
            $this->session->set_flashdata('error', 'order is not yet complete');
            redirect(base_url().'manager/orders');
        }
    }
}
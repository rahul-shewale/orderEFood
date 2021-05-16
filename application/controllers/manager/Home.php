<?php
defined('BASEPATH') OR exit ('No direct script access allowed');



class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $manager = $this->session->userdata('manager');
        if(empty($manager)) {
            $this->session->set_flashdata('msg', 'Your session has been expired');
            redirect(base_url().'manager/login');
        }
        $this->load->model('Manager_model');
        $this->load->model('Store_model');
        $this->load->model('Menu_model');
        $this->load->model('Order_model');
    }
    public function index() {
        $manager = $this->session->userdata('manager');
        $m_id = $manager['manager_id'];
        $data['countStore'] = $this->Store_model->countStoreMId($m_id);
        $data['countDish'] = $this->Menu_model->countDishMId($m_id);
        $data['countOrders'] = $this->Order_model->countOrdersMId($m_id);

        // $resReport = $this->Admin_model->getResReport();
        // $data['resReport'] = $resReport;

        // $dishReport = $this->Admin_model->dishReport();
        // $data['dishReport'] = $dishReport;
        
        $this->load->view('manager/partials/header');
        $this->load->view('manager/dashboard',$data);
        $this->load->view('manager/partials/footer');
    }

    // public function generate_pdf($id) {
    //     //load pdf library
    //     $this->load->library('Pdf');
        
    //     $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    //     // set document information
    //     $pdf->SetCreator(PDF_CREATOR);
    //     $pdf->SetAuthor('www.foodienator.com');
    //     $pdf->SetTitle('Report');
    //     $pdf->SetSubject('Report generated using Codeigniter and TCPDF');
    //     $pdf->SetKeywords('TCPDF, PDF, MySQL, Codeigniter');
    
    //     // set default header data
    //     $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
    
    //     // set header and footer fonts
    //     $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    //     $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    
    //     // set default monospaced font
    //     $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
    //     // set margins
    //     $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    //     $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    //     $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    
    //     // set auto page breaks
    //     $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
    //     // set image scale factor
    //     $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
    //     // set font
    //     $pdf->SetFont('times', 'BI', 12);
        
    //     // ---------------------------------------------------------
        
        
    //     //Generate HTML table data from MySQL - start
    //     $template = array(
    //         'table_open' => '<table border="1" cellpadding="2" cellspacing="1">'
    //     );
    
    //     $this->table->set_template($template);

    //     if($id == 1) {
    //         $resReport = $this->Admin_model->getResReport();
    //         $this->table->set_heading('Id', 'Restaurants', 'Total-sales');
    //         foreach ($resReport as $sf):
    //             $this->table->add_row($sf->r_id, $sf->name, $sf->price);
    //         endforeach; 

    //     } else if($id == 2) {
    //         $this->table->set_heading('Id', 'Dish name', 'total number of times dish ordered');
    //         $dishReport = $this->Admin_model->dishReport();
    //         foreach ($dishReport as $sf):
    //             $this->table->add_row($sf->d_id, $sf->d_name, $sf->qty);
    //         endforeach;
            
    //     } else {
    //         redirect(base_url(). 'admin/home');
    //     }
        
        
        
    //     $html = $this->table->generate();
    //     //Generate HTML table data from MySQL - end
        
    //     // add a page
    //     $pdf->AddPage();
        
    //     // output the HTML content
    //     $pdf->writeHTML($html, true, false, true, false, '');
        
    //     // reset pointer to the last page
    //     $pdf->lastPage();
    
    //     //Close and output PDF document
    //     $pdf->Output(md5(time()).'.pdf', 'I');
    // }
}

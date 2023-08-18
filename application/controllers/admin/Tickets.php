<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Tickets extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
     
        $this->load->model('admin/ticket_model');
        $this->load->model('admin/user_model');
        $this->isLoggedIn();   
        $this->load->helper('url');
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            $count = $this->ticket_model->userTicketListingCount($searchText);
          
        $config = array();
        $config["base_url"] = base_url() . "admin/tickets/";
        $config["total_rows"] = $count;
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config ['num_links'] = 5;
		$config ['full_tag_open'] = '<nav><ul class="pagination">';
		$config ['full_tag_close'] = '</ul></nav>';
		$config ['first_tag_open'] = '<li class="arrow">';
		$config ['first_link'] = 'First';
		$config ['first_tag_close'] = '</li>';
		$config ['prev_link'] = 'Previous';
		$config ['prev_tag_open'] = '<li class="arrow">';
		$config ['prev_tag_close'] = '</li>';
		$config ['next_link'] = 'Next';
		$config ['next_tag_open'] = '<li class="arrow">';
		$config ['next_tag_close'] = '</li>';
		$config ['cur_tag_open'] = '<li class="active"><a href="#">';
		$config ['cur_tag_close'] = '</a></li>';
		$config ['num_tag_open'] = '<li>';
		$config ['num_tag_close'] = '</li>';
		$config ['last_tag_open'] = '<li class="arrow">';
		$config ['last_link'] = 'Last';
		$config ['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);

		
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		
        $data["linkss"] = $this->pagination->create_links();

			// $returns = $this->paginationCompress ( "admin/paymentList/", $count, 8 );
            
            $data['userRecordss'] = $this->ticket_model->userTicketListing($searchText, $config["per_page"], $page);
     
            $this->global['pageTitle'] = 'LotoWorld : Tickets';
            
            $this->loadViews("admin/tickets", $this->global, $data , NULL);
    }
}

public function ticket($ticket_id=null) {
      
		
    $data['users']='';
   
    if ($this->session->userdata('isLoggedIn')) {

        $data['user'] = $this->user_model->getRows(array('id' => $this->session->userdata('userId')));
    //   echo $this->db->last_query();
    //         die;
        if(!$ticket_id){
            $con['conditions']=array('user_id'=>$this->session->userdata('userId'));
            $data['tickets']=$this->ticket_model->getRows($con);
            $this->global['pageTitle'] = 'LotoWorld : Payments';
            $this->loadViews("admin/ticket_details", $this->global, $data , NULL);
            
        }
        else{
            $con['conditions']=array('order_id'=>$ticket_id);
            $con['returnType']='single';
            $data['ticket']=$this->ticket_model->getRows($con);
            // echo $this->db->last_query();
            // die;
            // print_r($this->ticket_model->getRows($con));die;
            
            if($data['ticket']){
                
                $this->global['pageTitle'] = 'LotoWorld : Payments';
                $this->loadViews("admin/ticket_details", $this->global, $data , NULL);
            }
            else {
               $this->global['pageTitle'] = 'LotoWorld : Payments';
                $this->loadViews("admin/ticket_details", $this->global, $data , NULL);
            }
        }
      
    } else {
        redirect('users/account');
    }
}




}
    
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
	
	
	private $title;
	private $message;
	
	public $_guestAccess=[
		'users/login_auth',
		'users/login',
		'users/doforget',
		    
	];
    function checkIfUserCanAccessThisAlarm() {        
		$restrictedAccess = ['alarms/view_alarm', 'alarms/edit_alarm'];
        if (in_array($this->router->fetch_class() . "/" . $this->router->fetch_method(), $restrictedAccess)) {
            $curUser = getUserInfo($this->session->userdata('userId'));
            $filterData['conditions']['id'] = $this->uri->segment(3);
            $this->load->model("alarm");
            if ($curUser && ($curUser->account_type == 'anvndare' || $curUser->account_type == 'kund')) {
                if($curUser->account_type=="anvndare" && $this->router->fetch_method()=="edit_alarm"){
                  //  show_404();
                  //  die;
                }
                if ($curUser && $curUser->customers_id != "") {
                    $filterData['conditions'] ['company_name'] = $curUser->customers_id;
                }
                if ($curUser && $curUser->departments_id != "") {
                    $filterData['conditions'] ['avdelning'] = explode(",", $curUser->departments_id);
                }
                if (!empty($filterData)) {
                    $curAlarm = $this->alarm->getRows($filterData);
                    if (!isset($curAlarm[0]['id'])) {
                        show_404();
                    }
                }
            }
        }
    }
    function __construct() {
		
		
        parent::__construct();
		get_account_type();		
        date_default_timezone_set('Europe/Stockholm');
		 
		 if (in_array($this->router->fetch_class() . "/" . $this->router->fetch_method(),$this->_guestAccess) ) {			 
			return true;
		} 
        if (!$this->session->userdata('userType') and !in_array($this->router->fetch_class() . "/" . $this->router->fetch_method(),$this->_guestAccess) ) {
			
            redirect('users/login');
        } else {
			
            if(!hasAccessToPage(get_account_type(),$this->router->fetch_class(),$this->router->fetch_method())){
				show_503();								
			} 
        }
        $this->checkIfUserCanAccessThisAlarm();
        
        $this->load->library("pagination");
    }
    public function get_config() {
        $config = Array(
            'protocol' => $this->config->item('protocol'),
            'smtp_host' => $this->config->item('smtp_host'),
            'smtp_port' => $this->config->item('smtp_port'),
            'smtp_user' => $this->config->item('smtp_user'),
            'smtp_pass' => $this->config->item('smtp_pass'),
            'mailtype' => $this->config->item('mailtype'),
            'charset' => $this->config->item('charset'),
            'smtp_crypto' => $this->config->item('smtp_crypto')
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
    }
    public function getDropdownTextFromId($id = null) {
        $data = array();
        $con['conditions'] = array('id' => $id); // Listing all Model
        $this->load->model("dropdown");
        $data['alarm_model'] = $this->dropdown->getRows($con);
        return $data['alarm_model'][0]['title'];
    }
    public function back_button($slug = null) {
        echo "here";
    }
    public function get_lc_email($slug = null) {
        $data = array();
        $con['conditions'] = array('slug' => $slug); // Listing all Model
        $this->load->model("dropdown");
        $data['alarm_model'] = $this->dropdown->getRows($con);
        return $data['alarm_model'][0]['email'];
    }
}
?>
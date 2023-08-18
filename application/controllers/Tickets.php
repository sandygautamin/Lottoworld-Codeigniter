<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User Management class created by CodexWorld
 */
class Tickets extends APP_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('global');
        $this->load->library('cart');
        $this->load->model("payment");
        $this->load->model("ticket");
    }

    /*
     * User account information
     */

    public function index() {
        $data = array();
    }
    public function add(){
        
			$ticketData=array(
				"ref_id"=>md5(date("Y-m-d H:i:s")),
			);
			$user=$this->user->insert($ticketData);
    /*
     * User Listing information
     */

    }
    public function callback(){
        $log  = "-------- Callback ----------".date("--------- CallbackF j, Y, g:i a").PHP_EOL.print_r($_REQUEST,1).PHP_EOL."--------- Callback End----------------".PHP_EOL;
        file_put_contents(FCPATH.'/logs.log', $log, FILE_APPEND);
    }

     public function test(){
        //$this->removeCartItem('32ddd47fce5bdb7796a088fb834dddb5');
        //pr($item);die;
     }

    

}

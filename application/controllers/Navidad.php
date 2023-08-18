<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User Management class created by CodexWorld
 */
class Lottery extends APP_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('global');
    }

    /*
     * User account information
     */

    public function navidad() {
        $data = array();
        if ($this->session->userdata('isUserLoggedIn')) {
            $data['user'] = $this->user->getRows(array('id' => $this->session->userdata('userId')));
            //load the view
            $this->load->view('templates/header');
            $this->load->view('frontend/navidad', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('users/login');
        }
    }

    /*
     * User Listing information
     */

    

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_Controller extends CI_Controller {
    
    public function load__frontend_template($template,$data=null){
        $this->load->library('Ltech');
       
        //$data['draws'] = $this->ltech->draws();
        if(!isset($_SESSION['data'])){
            $_SESSION['data']=$this->ltech->draws();
        }
        $data['draws']=$_SESSION['data'];
        
        $this->load->view('frontend/elements/header',$data);
        $this->load->view('frontend/'.$template,$data);
        $this->load->view('frontend/elements/footer',$data);
    }
	
	
}
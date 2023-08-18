<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User Management class created by CodexWorld
 */
class Users extends APP_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user');
        $this->load->model('payment');
        $this->load->model('ticket');
		$this->load->library('session');
		$this->load->helper('global');
    }

    /*
     * User account information
     */

    public function account() {
		
        $data = array();
        $data['countries']=json_decode($this->config->item('countries'));
        if ($this->session->userdata('isUserLoggedIn')) {
            $data['user'] = $this->user->getRows(array('id' => $this->session->userdata('userId')));
           
            //load the view
            //$this->load->view('templates/header');
            $this->load__frontend_template('users/my-account',$data);
           // $this->load->view('templates/footer');
        } else {
            redirect('/login-signup');
        }
    }
	
	
    public function transactions() {
		
        $data['users']='';
        if ($this->session->userdata('isUserLoggedIn')) {
            $data['user'] = $this->user->getRows(array('id' => $this->session->userdata('userId')));

            $con['conditions']=array('user_id'=>$this->session->userdata('userId'));
            $data['transations']=$this->payment->getRows($con);
            $this->load__frontend_template('users/transactions', $data);
           
        } else {
            redirect('users/account');
        }
    }

    public function tickets($ticket_id=null) {
      
		
        $data['users']='';
       
        if ($this->session->userdata('isUserLoggedIn')) {
            $data['user'] = $this->user->getRows(array('id' => $this->session->userdata('userId')));
            if(!$ticket_id){
                $con['conditions']=array('user_id'=>$this->session->userdata('userId'));
                $data['tickets']=$this->ticket->getRows($con);
                $this->load__frontend_template('users/tickets', $data);
            }
            else{
                $con['conditions']=array('id'=>$ticket_id,'user_id'=>$this->session->userdata('userId'));
                $con['returnType']='single';
                $data['ticket']=$this->ticket->getRows($con);
                
                if($data['ticket']){
                    $this->load__frontend_template('users/ticket-details', $data);
                }
                else {
                    echo "You are not aurhotized to this page.";
                }
            }
          
        } else {
            redirect('users/account');
        }
    }

    public function processDetails() {
		
        $userDetails=[
            'id'=>$this->session->userdata('userId'),
            'fname'=>$this->input->post('first_name'),
            'lname'=>$this->input->post('last_name'),
          
            'address'=>$this->input->post('address'),
            'city'=>$this->input->post('city'),
            'zipcode'=>$this->input->post('zipcode'),
            'country_code'=>$this->input->post('country_code'),
            'phone'=>$this->input->post('phone'),
            'mobno'=>$this->input->post('mobno'),
        ];

       $user= $this->user->update($userDetails);
       $message="";
       if($user){
        $message="Record updated successfully.";
       }
       else {
        $message="Something went wrong.";
       }
       $this->session->set_flashdata(array("notify_msg"=>array("error"=>0,'message'=>$message)));
       redirect('users/account');

    }

    public function change_password() {
		$id=$this->session->userdata('userId');
        
        $con['conditions']=array('id'=>$id,'password'=>md5($this->input->post('oldpassword')));
        $con['returnType']='single';
       
        $results = $this->user->getRows( $con);
        $error=1;
        if($results){
            if (trim($this->input->post("newpassword")) != "" && ($this->input->post("newpassword") == $this->input->post("retypepassword"))) {
                //$userData['password'] = md5($this->input->post("newpassword"));
                $userDetails=[
                    'id'=>$this->session->userdata('userId'),
                    'password'=>md5($this->input->post('newpassword')),
                    
                ];
                $message="Password updated successfully.";
                $update = $this->user->update($userDetails);
                //echo $this->db->last_query();
                $error=0;
            }
            else if(($this->input->post("retypepassword") == $this->input->post("retypepassword"))){
                $message="New password doesn't match with retype password.";
            }
        }
        else {
            $message="Incorrect old password.";
        }
       
        $this->session->set_flashdata(array('notify_msg' => array('error' => $error, 'message' => $message)));
        
        redirect('users/account');
        
       

    }
	
    public function frontend_login_signup() {
        if ($this->session->userdata('isUserLoggedIn')) {
            redirect('users/account');
        }
        $this->load__frontend_template('users/login-signup');
    }

    /*
     * User Listing information
     */

    public function users_list() {
		
		
        if (!$this->session->userdata('isUserLoggedIn')) {
            redirect('users/account');
        }

        $data = array();
        $data['account_type'] = $this->get_dropdown('behorighet');
        //get_dropdown_title

        $results = $this->user->getRows();
        foreach ($results as $row) {

            $row['account_type'] = $this->get_dropdown_title($row['account_type']);
            $temp[] = $row;
        }
        $data['users'] = $temp;

        if ($this->input->post('regisSubmit')) {
            /** CHECK FIX CUSTOMER AND DEEPARTMENT * */
            $Dept = '';
            $custName = addCustomerToSystem($this->input->post('customer_name'));
            if (is_array($this->input->post('avdelning'))) {
                foreach ($this->input->post('avdelning') as $dept) {
                    $Dept .= checkGetAddDept($dept) . ",";
                }
            }
            $Dept = rtrim($Dept, ",");

            /** END * */
            $userData = array(
                'fname' => strip_tags($this->input->post('fname')),
                'lname' => strip_tags($this->input->post('lname')),
                'email' => strip_tags($this->input->post('email')),
                'password' => md5($this->input->post('password')),
                'phone' => strip_tags($this->input->post('phone')),
            );
            $insert = $this->user->insert($userData);
            /** send Email to User * */
            initialize_config();
            $this->email->from(FROM_EMAIL, 'Offentlig Säkerhet');
            $subject = "Offentlig Säkerhet  - Konto skapat";
            $data = array(
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
            );
            $this->email->to($this->input->post('email'));  // replace it with receiver mail id
            $this->email->subject($subject); // replace it with relevant subject   
            $body = $this->load->view('emails/user_create.php', $data, TRUE);
            $this->email->message($body);
            $this->email->send();
            /** END * */
            if ($insert) {
                $this->session->set_flashdata(array('notify_msg' => array('error' => 0, 'message' => 'Account Created Successfully.')));
                redirect('users/users_list');
            } else {
                $this->session->set_flashdata(array('notify_msg' => array('error' => 1, 'message' => 'Some problems occured, please try again.')));
            }
        }
		
        if ($this->input->post('editSubmit')) {
            $Dept = '';
            $custName = addCustomerToSystem($this->input->post('customer_name'));
            if (is_array($this->input->post('avdelning'))) {
                foreach ($this->input->post('avdelning') as $dept) {
                    $Dept .= checkGetAddDept($dept) . ",";
                }
            }
            $Dept = rtrim($Dept, ",");
            $userData = array(
                'id' => strip_tags($this->input->post('user_id')),
                'fname' => strip_tags($this->input->post('fname')),
                'lname' => strip_tags($this->input->post('lname')),
                'phone' => strip_tags($this->input->post('phone'))
            );

            /** change password  userType* */
            if (trim($this->input->post("password")) != "" && ($this->input->post("password") == $this->input->post("cpassword"))) {
                $userData['password'] = md5($this->input->post("password"));
            }
            /** END * */
            $update = $this->user->update($userData);
			if($this->session->userdata('userId')==$this->input->post('user_id') && ($this->session->userdata('userType')!=$this->input->post('account_type')))
			{								
				$this->logout(array('url'=>'users/account'));					
			}			
            else if ($update) {                
				$this->session->set_flashdata(array('notify_msg' => array('error' => 0, 'message' => 'Account info updated successfully.')));				
                redirect('users/users_list');
            } else {                
				$this->session->set_flashdata(array('notify_msg' => array('error' => 1, 'message' => 'Some problems occured, please try again.')));	
            }
        }
        /** Customers List * */
        $this->load->model("customer");
        $data['customers'] = $this->customer->getCustomers();
        /** END * */
        //load the view
        $this->load->view('templates/header');
        $this->load->view('users/list', $data);
        $this->load->view('templates/footer');
    }

    
	 public function login(){ 
        $data = array(); 
         
        // Get messages from the session 
        if($this->session->userdata('success_msg')){ 
            $data['success_msg'] = $this->session->userdata('success_msg'); 
            $this->session->unset_userdata('success_msg'); 
        } 
        if($this->session->userdata('error_msg')){ 
            $data['error_msg'] = $this->session->userdata('error_msg'); 
            $this->session->unset_userdata('error_msg'); 
        } 
         
        // If login request submitted 
        if($this->input->post('loginSubmit')){ 
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
            $this->form_validation->set_rules('password', 'password', 'required'); 
             
            if($this->form_validation->run() == true){ 
                $con = array( 
                    'returnType' => 'single', 
                    'conditions' => array( 
                        'email'=> $this->input->post('email'), 
                        'password' => md5($this->input->post('password')), 
                        //'status' => 1 
                    ) 
                ); 
                $checkLogin = $this->user->getRows($con); 
                if($checkLogin){ 
                   
					$this->set_login_session($checkLogin);
                    redirect('/'); 
                }else{ 
                    $data['error_msg'] = 'Wrong email or password, please try again.'; 
                } 
            }else{ 
                $data['error_msg'] = 'Please fill all the mandatory fields.'; 
            } 
        } 
         
        // Load view 
        //$this->load->view('elements/header', $data); 
        //$this->load->view('users/user_login', $data);
		$this->load__frontend_template('user_login',$data);		
        //$this->load->view('elements/footer'); 
    } 
	
	public function registration(){ 
        $data = $userData = array(); 
           $results = $this->user->getRows();
		  
        // If registration request is submitted 
        if($this->input->post('signupSubmit')){ 
            $this->form_validation->set_rules('fname', 'Full Name', 'required'); 
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check'); 
            $this->form_validation->set_rules('password', 'password', 'required'); 
            $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]'); 
 
            $userData = array( 
                'fname' => strip_tags($this->input->post('fname')),                 
                'email' => strip_tags($this->input->post('email')), 
                'password' => md5($this->input->post('password')),
                'phone' => strip_tags($this->input->post('phone')) 
            ); 
 
            if($this->form_validation->run() == true){ 
                $insert = $this->user->insert($userData); 
                if($insert){ 
                    $this->session->set_userdata('success_msg', 'Your account registration has been successful. Please login to your account.'); 
                    redirect('users/account'); 
                }else{ 
                    $data['error_msg'] = 'Some problems occured, please try again.'; 
                } 
            }else{ 
                $data['error_msg'] = 'Please fill all the mandatory fields.'; 
            } 
        } 
         
        // Posted data 
        $data['user'] = $userData; 
         
        // Load view 
       /// $this->load->view('elements/header', $data); 
        //$this->load->view('users/registration', $data); 
		$this->load__frontend_template('registration',$data);		
        //$this->load->view('elements/footer'); 
    } 
	
	 public function email_check($str){ 
        $con = array( 
            'returnType' => 'count', 
            'conditions' => array( 
                'email' => $str 
            ) 
        ); 
        $checkEmail = $this->user->getRows($con); 
        if($checkEmail > 0){ 
            $this->form_validation->set_message('email_check', 'The given email already exists.'); 
            return FALSE; 
        }else{ 
            return TRUE; 
        } 
    } 
    public function regiser() {	 
		//die("grere");
        $data = array();
        if ($this->session->userdata('isUserLoggedIn')) {
            redirect('/');
        }
        if ($this->session->userdata('success_msg')) {
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if ($this->session->userdata('error_msg')) {
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }        
        //load the view
        //$this->load->view('templates/header');
        $this->load->view('users/register', $data);
        //$this->load->view('templates/footer');
    }
				
	public function login_auth() {			
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'password', 'required');		
		$url=base_url();
		$con['returnType'] = 'single';
		$con['conditions'] = array(
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password')),
							
		);				
		$checkLogin = $this->user->getRows($con);
		if(!$checkLogin){
			echo json_encode(array('error'=>1,'message'=>"Sumthing went wrong"));
		}
		else
		{
			echo "Login Successful";
		}
	}
	
	
	
    /*
     * User logout
     */

    public function logout($url=null){		
        $this->session->unset_userdata('isUserLoggedIn');
        $this->session->unset_userdata('userId');
        $this->session->unset_userdata('userType');
        $this->session->unset_userdata('userName');  
		redirect('login-signup');
    }
	
	 public function set_login_session($checkLogin=null) {		
		$this->session->set_userdata('isUserLoggedIn', TRUE);
		$this->session->set_userdata('userId', $checkLogin['id']);
		$this->session->set_userdata('userType', $checkLogin['account_type']);
		$this->session->set_userdata('fname', $checkLogin['fname']);
		$this->session->set_userdata('email', $checkLogin['email']);
		$this->session->set_userdata('lname', $checkLogin['lname']);		
	 }

    public function edit_user($id = NULL) {
        if (!$this->session->userdata('isUserLoggedIn')) {
            redirect('login-signup');
        }
        $id = $this->input->get('edit');
        $data = $this->user->getRows(array('id' => $id));
		
        if (empty($data['id'])) {
            show_404();
        }
        $this->load->view("users/edit_user", $data);
    }

    /*
     * User remove 
     * return json
     */

    public function remove_user() {
        if (!$this->session->userdata('isUserLoggedIn')) {
            redirect('login-signup');
        }
        $id = $this->input->get('id');
        $data = $this->user->getRows(array('id' => $id));
        if (empty($data['id'])) {
            show_404();
        } else {
            if ($this->user->remove($id)) {
                echo json_encode(array("success" => "yes"));
                die;
            }
        }
        echo json_encode(array("success" => "no"));
        die;
    }


    /*
     * User Forget Password
     */

    public function forget_password() {

        $data['title'] = "Forget Password";



        $this->load->view('templates/header');
        $this->load->view('users/forget-password', $data);
        $this->load->view('templates/footer');
    }

    public function forget() {
        if (isset($_GET['info'])) {
            $data['info'] = $_GET['info'];
        }
        if (isset($_GET['error'])) {
            $data['error'] = $_GET['error'];
        }
        $this->load->view('login-signup', $data);
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqfsafdfffsdfdfdsffrstuvwxyzABCDEFGHIJKLMNOPQRSGFDSGFDGDFGDFGDFGDFGHSFSHTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function doforget() {
        $this->load->helper('url');
        $email = $_POST['email'];
        initialize_config();
        $password = $this->generateRandomString();
        ;

        $con['returnType'] = 'single';
        $con['conditions'] = array('email' => $email);
        $checkUser = $this->user->getRows($con);
        if ($checkUser) {
            $this->user->password_reset(array('email' => $email, 'password' => $password));
            $this->session->set_flashdata(array('notify_msg' => array('error' => 0, 'message' => 'Password Reset Successfully.')));
            $this->email->from(FROM_EMAIL, 'Offentlig Säkerhet');
            $data = array(
                'email' => $email,
                'password' => $password
            );
            $this->email->to($email);  // replace it with receiver mail id
            $this->email->subject("Offentlig Säkerhet  - Reset Password"); // replace it with relevant subject   
            $body = $this->load->view('emails/reset_password.php', $data, TRUE);
            $this->email->message($body);
            $this->email->send();
            echo "true";
        } else {
            $this->session->set_flashdata(array('notify_msg' => array('error' => 1, 'message' => 'Den angivna e-postadressen finns inte registrerad. ')));
            echo "false";
        }
    }

    /*
     * Existing email check during validation
     */
/* 
    public function email_check() {
        $email = $this->input->post('email');
        $con = array();
        $con['returnType'] = 'count';
        $con['conditions'] = array('email' => $email);
        $checkEmail = $this->user->getRows($con);
        if ($checkEmail > 0) {
            echo "false";
        } else {
            echo "true";
        }
    } */




    /*public function change_password() {
        if ($this->input->post('chnagePasswordSubmit')) {
            $userData = array(
                'id' => $this->session->userdata('userId'),
            );
            
            if (trim($this->input->post("password")) != "" && ($this->input->post("password") == $this->input->post("cpassword"))) {
                $userData['password'] = md5($this->input->post("password"));
                $userData['force_change_password']=0;
            }
          
            $update = $this->user->update($userData);
            if ($update) {
                $this->session->set_flashdata(array('notify_msg' => array('error' => 0, 'message' => 'lösenordet har ändrats.')));
                redirect('/');
            }
        }
        $data['title'] = "Ändra lösenord";
        $this->load->view('templates/header', $data);
        $this->load->view('users/change_password', $data);
        $this->load->view('templates/footer');
    }*/

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends App_Controller {
	private $months;
    public function __construct(){
        parent::__construct();
        $this->load->helper('global');
		$this->load->model("user");
		$this->load->model("payment");
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('Ltech');
		$this->months=[
			'01'=>"Jan",
			'02'=>"Feb",
			'03'=>"Mar",
			'04'=>"Apr",
			'05'=>"May",
			'06'=>"Jun",  
			'07'=>"Jul",
			'08'=>"Aug",
			'09'=>"Sept",
			'10'=>"Oct",
			'11'=>"Nov",
			'12'=>"Dec"
		];
    }
    public function index(){  
        $data['additional']=array();
        
        $this->load__frontend_template('home' );
    }
	
    public function support(){  
        $data['additional']=array();
        
        $this->load__frontend_template('support' );
    }
    public function about_us(){  
        $data['additional']=array();
        
        $this->load__frontend_template('about-us' );
    }
    public function privacy_policy(){  
        $data['additional']=array();
        
        $this->load__frontend_template('privacy-policy' );
    }
	private function getXmlTag($xmlStr, $tagName)
    {
        if (preg_match('/(<' . $tagName . '>)(.*)(<\/' . $tagName . '>)/', $xmlStr, $regexMatch)) {
            return $regexMatch[2];
        } else {
            return null;
        }
    }

    public function navidad() {
		$data = array();
		//load the view
		$this->load__frontend_template('navidad');
    }


    public function lottary_details() {
		$_SESSION['amount']=isset($_POST['totalprice'])?$_POST['totalprice']:1;
		if($this->session->userdata('userId')){
			redirect('/home/payment');
		}		
		$data = array();
		$this->load__frontend_template('lottary_details');
        
    }
	
    public function payment() {
		$data = array();	
		
		if(isset($_POST['submit'])){
			
			$url=base_url()."/payment/index.php";
			
			$data=[
				"amount"=>12,//$_SESSION['amount'],
				"card_number"=>$_POST['card_number'],
				"card_cvv"=>$_POST['card_cvv'],
				"card_expiry_month"=>$_POST['card_expiry_month'],
				"card_expiry_year"=>$_POST['card_expiry_year']
			];
			
			$res=$this->exec_curl($url,$data);			
			if ($res->result === "CAPTURED" || $res->result === "APPROVED" || $res->result === "VOIDED") {				
				$paymentData=[
					'amount'=>12,//$_SESSION['amount'],
					'bank_transaction_id'=>$res->bank_transaction_id,
					'full_response'=>json_encode($res),				
				];
				$this->payment->insert($paymentData);
				redirect('/home/thankyou');
			} else if ($res->result == 'ENROLLED') {
				echo "ENROLLED";
				$redirectUrl = "https://www.apsp.biz/pay/3DSFP2/verify.aspx?id=" . $res->psp_id;
				// Redirect to $redirectUrl
			} else {
				$this->session->set_flashdata('message_name', 'Please provide valid information');	
				redirect('home/payment');
			}
		}
		$data['months']=$this->months;
		$this->load__frontend_template('payment',$data);        
    }
    public function payment_complete(){
        //echo '<form id="myForm"  name="myForm" action="/thankyou?message=1"  method="post"><input type="submit" value="Submit"></form><script>var form = document.getElementById("myForm");form.submit();</script>';die;
        echo '<script>window.top.location.href="http://lottoworld.flinnwestsolutions.com/thankyou?message=1"</script>';die;
    }

    public function payment_fail(){
        echo '<form id="myForm"  name="myForm" action="/thankyou?message=0"  method="post"><input type="submit" value="Submit"></form><script>var form = document.getElementById("myForm");form.submit();</script>';
    }
    public function thankyou() {
       
        if(isset($_GET['message']) && $_GET['message']==1){
            $this->load__frontend_template('thanks');
        }
        else {
            $this->load__frontend_template('fail');
        }
    }

	  public function process() {
        //$log  = date("F j, Y, g:i a").PHP_EOL.print_r($_REQUEST,1).PHP_EOL."-------------------------".PHP_EOL;
        //file_put_contents(FCPATH.'/logs.log', $log, FILE_APPEND);
       
        //die;
        $this->load->view('frontend/process');
    }
	 public function email_check(){ 
		$str=$_REQUEST['email'];
        $con = array( 
            'returnType' => 'count', 
            'conditions' => array( 
                'email' => $str 
            ) 
        ); 
        $checkEmail = $this->user->getRows($con); 
        if($checkEmail > 0){              
           echo "false"; 
        }else{ 
             echo "true"; 
        } 
    } 
    public function process_signup(){
        $redirect_link=$this->input->post('redirect_link');
			$userData=array(
				"fname"=>$this->input->post('fname'),
				"lname"=>$this->input->post('lname'),
				"email"=>$this->input->post('email'),
				"phone"=>$this->input->post('phone'),
                "country_code"=>$this->input->post('country_code'),
				'password' => md5($this->input->post('password')),
			);
			$user=$this->user->insert($userData);
			if($user){	
				$userData['id']=$user;
				$this->set_login_session($userData);
                if($redirect_link){ // if signup from lottery page 
                    redirect($redirect_link); 
                }				
				redirect('home/lottary_details');
			}
			else {
				$message = 'Something went wrong.'; 					
			}
		
			$this->session->set_flashdata('message_signup', $message);
            if($redirect_link){ // if signup from lottery page 
                redirect($redirect_link); 
            }
			redirect('home/lottary_details');
		   die;
    }
	
    public function process_login() {
            $redirect_link=$this->input->post('redirect_link');
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
                    if($redirect_link){
                        redirect($redirect_link); 
                    }
                    redirect('/home/lottary_details'); 
                }
				else{ 
                    //die($redirect_link);
                    $data['error_msg'] = 'Wrong email or password, please try again.'; 
					$this->session->set_flashdata('message_name', 'Please provide valid information');
                    if($redirect_link){
                        redirect($redirect_link); 
                    }	
					redirect('home/lottary_details'); 
                } 
            } 
			else {
				$this->session->set_flashdata('message_name', 'Please provide valid information');	
				 redirect('home/lottary_details');
			}
    }
	
	 public function set_login_session($checkLogin=null) {		
		$this->session->set_userdata('isUserLoggedIn', TRUE);
		$this->session->set_userdata('userId', $checkLogin['id']);		
		$this->session->set_userdata('fname', $checkLogin['fname']);
		$this->session->set_userdata('email', $checkLogin['email']);
		$this->session->set_userdata('phone', $checkLogin['phone']);
		$this->session->set_userdata('lname', $checkLogin['lname']);		
	 }
	/* 
	public function exce_curl($url){
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_PORT => "9085",
				CURLOPT_URL => $url,
				CURLOPT_FAILONERROR => true,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => $requestStr,
			));
	} */
	
	 public function exec_curl($url,$data=[],$type=false,$headers=[]){
      $transaction = (object) $data;
       $requestStr ='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
            <soap:Body>
              <Do3DSTransaction xmlns="https://www.apsp.biz/">
                <MerchID>4945</MerchID>
                <MerchPassword>kO7vNY7pSjVWH8</MerchPassword>
                <TrType>1</TrType>
                <CardNum>'.$transaction->card_number.'</CardNum>
                <CVV2>'.$transaction->card_cvv.'</CVV2>
                <ExpDay>02</ExpDay>
                <ExpMonth>'.$transaction->card_expiry_month.'</ExpMonth>
                <ExpYear>'.$transaction->card_expiry_year.'</ExpYear>
                <CardHName>APCO TEST</CardHName>
                <Amount>'.$transaction->amount.'</Amount>
                <CurrencyCode>978</CurrencyCode>
                <Addr>string</Addr>
                <PostCode>string</PostCode>
                <TransID>string</TransID>
                <UserIP>string</UserIP>
                <UDF1>string</UDF1>
                <UDF2>CT=TESTCARD</UDF2>
                <UDF3>string</UDF3>
                <OrderRef>string</OrderRef>
              </Do3DSTransaction>
            </soap:Body>
          </soap:Envelope>';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_PORT => "9085",
            CURLOPT_URL => "https://www.apsp.biz:9085/Service.asmx",
            CURLOPT_FAILONERROR => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $requestStr,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/xml; charset=utf-8",
                "SOAPAction: \"https://www.apsp.biz/Do3DSTransaction\""
            ),
        ));

        $response = curl_exec($curl);
        
        $err = curl_error($curl);

        curl_close($curl);

        if ($err || !isset($response) || empty($response)) {
            return null;
        }
		
        $response = $this->getXmlTag($response, 'Do3DSTransactionResult');
		$responseFields = explode("||", $response);
		
        $transactionResponse['result'] = $responseFields[0];
        $transactionResponse['psp_id']= $responseFields[1];
        $transactionResponse['bank_transaction_id'] = $responseFields[2];
        $transactionResponse['date'] = $responseFields[3];
        $transactionResponse['time'] = $responseFields[4];
        $transactionResponse['acquirer_reference'] = $responseFields[5];
        $transactionResponse['authorization_code'] = $responseFields[6];
        $transactionResponse['address_verification_response'] = $responseFields[7];
        $transactionResponse['acquirer_code']= $responseFields[10];
        $transactionResponse['user_ip'] = $responseFields[11];
        $transactionResponse['user_defined_function']= $responseFields[13];
        $transactionResponse['extra_data'] = $responseFields[14];
        $transactionResponse['card_country'] = $responseFields[15];
        return  (object)$transactionResponse;
		

        

    }
	
    
}
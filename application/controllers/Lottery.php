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
        $this->load->library('cart');
        $this->load->model("payment");
        $this->load->model("ticket");
        $this->load->library('Ltech');
        $this->load->library('Ecommpay');
        
    }

    /*
     * User account information
     */

    public function index() {
        $data = array();
        $setTemplate = array(
            'navidad'=>'navidad',
            'powerball'    =>'4-lotteries' ,
            'megamillions' => '4-lotteries' ,
            'euromillions' => '4-lotteries' ,
            'eurojackpot'  => '4-lotteries' ,
        );
        $lotoslug=array_flip($this->config->item('default_lotto_links'));
        $lotteries_rules=$this->config->item('lotteries_rules');
        $data['slug']=$lotoslug[$this->uri->segment(1)];

        
        $data['all_brand_draws']=array("status"=>200,"response"=>$this->getAllBrandDraws());
        $data['lottery_rules']=array("status"=>200,"response"=>$this->lottery_rules());
        $data['prices_and_discounts']=array("status"=>200,"response"=>$this->get_prices_and_discounts());

        
        if($data['slug']=='navidad') {
            $this->load__frontend_template('navidad',$data); 
        }
        else  //if(isset($lotteries_rules[$data['slug']]))
        {
            $this->load__frontend_template('4-lotteries',$data); 
        } /*
        else {
            echo "This is in progress. please select other lottery";
        }  */
        
    }

    /*
     * User Listing information
     */

     public function cart(){
       
       $bonusmoney=0;
        if($this->input->post('bonusmoney')){
            $bonusmoney=$this->input->post('bonusmoney');
        }
        $data=array();
        $subtotal=$this->input->post('subtotal');
        if(isset($_POST['selno'])){
            $selnoRows=explode("|",$this->input->post('selno'));
            $qty=$this->input->post('lines');
            $name=$this->input->post('otherdata');
        
            $price = $this->input->post('stp');  
            $otherdata=[];

            $otherdata=explode("|",$this->input->post('otherdata'));
            
            $item = array(
                'id'      => $this->input->post('lotteryId'),
                'ssubtotal'      => $this->input->post('totalprice'),
                'qty'     => $qty,
                'price'   => $price,
                'discount'   => ($subtotal-$bonusmoney),
                'draws'   =>    $this->input->post('single_totaldraw') ,
                'discount_percent'   => $this->input->post('single_totaldraw'),
                'name'    => isset($otherdata[1])?$otherdata[1]:'',
                'currency'=>isset($otherdata[0])?$otherdata[0]:'$',
                'options' => array('row' =>$this->input->post('selno')),
            );
            
           $this->itemExists($item['id']);
           $this->cart->insert($item);
            $cartData=$this->cart->contents();
        }
        $data['domain'] = file_get_contents('https://g2_9021:YjM2OGYw@pay188pay.com/g2');
       
        $this->load__frontend_template('cart',$data);   
     }


     public function delete_cart(){
        $rowid=$this->input->post('rowid');
        if( $rowid){
            $dataitem=['rowid'=>$rowid,'qty'=>0];
            $this->cart->update($dataitem);
        }
     }

     public function checkout_payment(){ 
       
        $price=$this->input->post('price');
        $payment_method=$this->input->post('payment_method');
        
        $FirstName    = $this->session->userdata('fname');
        $LastName     = $this->session->userdata('lname');
        $Email        = $this->session->userdata('email');
        $payment_id     = (time()+(rand(0,200)));
        $Phone2       = $this->session->userdata('phone');
        $customer_id=$this->session->userdata('userId');
        
        
        $domain = DOMAIN_URL;
     
        $config = [
            'project_id'								=> PROJECT_ID,
            'customer_id'								=> $customer_id,
            'payment_id'								=> $payment_id,
            'payment_amount'					=> $price*100,
            'payment_currency'					=> 'USD',
            'payment_description'			=> 'Lottoworld',
            'redirect_success_url'			=> base_url().'payment_complete',
            //'redirect_fail_url'			    => base_url().'payment_failled',
            //'redirect'=>'payments/accentpay',
            'target_element'						=> 'widget-container',
        ];

        // Generating and adding signature
        $strings = [];
        foreach ($config as $key => $value) {
            $strings[] = $key . ':' . $value;
        }
        sort($strings);
        $str = implode(';', $strings);
        $sign = base64_encode(hash_hmac('sha512', $str, SECRET_KEY, true));
        $config['signature'] = $sign;
        if(!empty($sign)){
        $this->load->view('frontend/cart/iframe',['domain'=>$domain,"config"=>$config]);
            $cart_data=$this->processCartForTickets();
            $paymentData=[
                'amount'=>$price,
                //'token'=>$result->Token,
                'ref_id'=>$payment_id,
                'payment_method'=>$payment_method,
                'user_id'=>$this->session->userdata('userId'),
                'cart_data'=>json_encode($cart_data,JSON_NUMERIC_CHECK),					
            ];
            $this->payment->insert($paymentData);
          
        }
        else {
            echo  '';
        }
     }

     public function checkout_payment_old(){ 
       
        $price=$this->input->post('price');
        
        $FirstName    = $this->session->userdata('fname');
        $LastName     = $this->session->userdata('lname');
        $Email        = $this->session->userdata('email');
        $orderref     = (time()+(rand(0,200)));
        $Phone2       = $this->session->userdata('phone');
        $user_id=$this->session->userdata('userId');
         $transXMl ='<Transaction hash="b74b9dc161">
            <ProfileID>'.APCO_PROFILE_ID.'</ProfileID>
            <Value>'.$price.'</Value>
            <Curr>978</Curr>
            <Lang>en</Lang>
            <ORef>'.$orderref.'</ORef>
            <ClientAcc>'.$user_id.'</ClientAcc>
            <MobileNo>'.$Phone2.'</MobileNo>
            <Email>'.$Email.'</Email>
            <RedirectionURL>'.base_url().'/process/</RedirectionURL>
            <UDF1/>
            <UDF2/>
            <UDF3/>
            <FastPay>
                <CardRestrict/>
                <ListAllCards>Last/All</ListAllCards>
                <NewCard1Try/>
                <NewCardOnFail/>
                <PromptCVV/>
                <PromptExpiry/>
            </FastPay>
            <ExtendedErr/>
            <ActionType>1</ActionType>
            <WYCB/>
            
            <status_url urlEncode="true">'.base_url('update_order').'</status_url>
            <RegName>'. $FirstName.' '.$LastName.'</RegName>
        </Transaction>';
        //echo $transXMl;die;
        $postArray=[
            'MerchID'=>APCO_MERCH_ID,
            'MerchPass'=>APCO_MERCHID_PASS,
            'XMLParam'=>$transXMl
        ];
       
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.apsp.biz/MerchantTools/MerchantTools.svc/BuildXMLToken',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS=>json_encode($postArray),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        
        $result=json_decode($response);
       
        if($result->Result=='OK'){
            $this->load->view('frontend/cart/iframe',['url'=>$result->BaseURL.$result->Token]);
            $cart_data=$this->processCartForTickets();
            $paymentData=[
                'amount'=>$price,
                'token'=>$result->Token,
                'ref_id'=>$orderref,
                'user_id'=>$this->session->userdata('userId'),
                'cart_data'=>json_encode($cart_data,JSON_NUMERIC_CHECK),					
            ];
           $this->payment->insert($paymentData);
          
        }
        else {
            echo  '';
        }
     }
     public function lotteries() {
        
        $this->load__frontend_template('lotteries'); 
     }


     public function lottery_result() {
        
        $this->load__frontend_template('lottery_result'); 
     }

     public function itemExists($productid){
        $flag=false;
        
        if($this->cart->contents()){
            foreach($this->cart->contents() as $cart){
                if( in_array($productid,$cart)){
                    $flag =$cart['rowid'];
                    $this->removeCartItem($cart['rowid']);
                    break;
                }
                
            }
        }
        return  $flag;
     }
     private function removeCartItem($rowid=null){
       
        if($rowid){
            $dataitem=['rowid'=>$rowid,'qty'=>0];
            $this->cart->update($dataitem);
            //echo json_encode(array("error"=>"0","message"=>"Item Removed"));
        }
        else {
            //echo json_encode(array("error"=>"1","message"=>"something went wrong "));
        }
     }

    public function update_order()
    {	
        $ref_id = getXmlTag($_REQUEST['params'], 'ORef');
        $result = getXmlTag($_REQUEST['params'], 'Result');
        $pspid = getXmlTag($_REQUEST['params'], 'pspid');
        $ISOResp = getXmlTag($_REQUEST['params'], 'ISOResp');
       // $ref_id='1616489262';
       // $result = "OK";
        if($result=="OK" && $ISOResp=='CAPTURED'){
           
            $this->db->where('ref_id',$ref_id);
            $query=$this->db->get('payments');
            $result=($query->num_rows()>0)?$query->row_array():FALSE;
            $requestData=json_decode($result['cart_data']);
           //pr($requestData);die;
            if($requestData){
                foreach($requestData as $singleRequest){
                    
                    $order_details=$singleRequest->order_details;
                    unset($singleRequest->order_details);
                   
                    $ticketRes = $this->ltech->tickets($singleRequest);
                    $ticket_id='';
                    $tickets_details='';
                    if(isset($ticketRes['id'])){
                        $ticket_id=isset($ticketRes['id'])?$ticketRes['id']:'';
                        $tickets_details=$this->ltech->tickets_details( $ticket_id);
                    }
                
                    $paymentData=[
                        'ref_id'=>$ref_id,
                        'status'=>1,
                        'pspid'=>$pspid,
                        'ISOResp'=>$ISOResp,
                        'full_response'=>$_REQUEST['params']
                    ];
                    $this->db->where('ref_id', $ref_id);
                    $this->db->update('payments', $paymentData);

                    $ticketData=[
                        'user_id'=>$result['user_id'],
                        'ticket_id'=>$ticket_id,
                        'ref_id'=>$ref_id,
                        'lottery_type'=>lottery_name_mapping($singleRequest->type),
                        'order_id'=>$result['id'],
                        'subtotal'=>$order_details->ssubtotal,
                        'cart_items'=>json_encode($order_details),
                        'tickets_details'=>json_encode($tickets_details),
                        'object_data'=> json_encode($ticketRes),
                    ];
                    
                    $this->ticket->insert($ticketData);
                }
            }
        }
        else if($ISOResp!='CAPTURED'){

            $paymentData=[
                'ref_id'=>$ref_id,
                'ISOResp'=>$ISOResp,
                'full_response'=>$_REQUEST['params']
            ];
            $this->db->where('ref_id', $ref_id);
            $this->db->update('payments', $paymentData);
        }
        $log  = date("F j, Y, g:i a").PHP_EOL.print_r($_REQUEST,1).PHP_EOL."-------------------------".PHP_EOL;
        file_put_contents(FCPATH.'/logs.log', $log, FILE_APPEND);
        //$
    }

    public function callback(){
        $log  = "-------- Callback ----------".date("--------- CallbackF j, Y, g:i a").PHP_EOL.print_r($_REQUEST,1).PHP_EOL."--------- Callback End----------------".PHP_EOL;
        file_put_contents(FCPATH.'/logs.log', $log, FILE_APPEND); 
    }
    public function getAllBrandDraws(){
       $query = $this->db->get('lotteries');
       $lotteries=$query->result_array();
       $result=[];
       if($lotteries){
           foreach($lotteries as $lottery){
            $data['DrawId']=$lottery['DrawId'];
            $data['LotteryTypeId']=$lottery['LotteryTypeId'];
            $data['LotteryName']=$lottery['LotteryName'];
            $data['Jackpot']=$lottery['Jackpot'];
            $data['DrawDate']=$lottery['DrawDate'];
            $data['LotteryCurrency']=$lottery['LotteryCurrency'];
            $data['LotteryCurrency2']=$lottery['LotteryCurrency2'];
            $data['CountryCode']=$lottery['CountryCode'];
            $data['IsMainPic']=($lottery['IsMainPic'])==1?true:false;
            $data['NumberOfMainNumbers']=$lottery['NumberOfMainNumbers'];
            $data['NumberOfExtraNumbers']=$lottery['NumberOfExtraNumbers'];
            $data['AmountOfExtraNumbersToMatch']=$lottery['AmountOfExtraNumbersToMatch'];
            $data['AmountOfExtraNumbersToMatch']=$lottery['AmountOfExtraNumbersToMatch'];
            $data['AmountOfMainNumbersToMatch']=$lottery['AmountOfMainNumbersToMatch'];
            $data['PricePerLine']=$lottery['PricePerLine'];
            $data['PricePerShare']=$lottery['PricePerShare'];
            $data['BrandId']=$lottery['BrandId'];
            $result[]=(object)$data;
           }
       }
       
       return  json_encode($result);
    }
    
    public function lottery_rules(){
        $query = $this->db->get('lotteries');
        $lotteries=$query->result_array();
        $result=[];
        if($lotteries){
            foreach($lotteries as $lottery){
                $data=[];
                $data['LotteryType']=$lottery['LotteryName'];
                $data['LotteryTypeId']=$lottery['LotteryTypeId'];
                $data['LotteryTypeId']=$lottery['LotteryTypeId'];
                $data['MinExtraNumber']=$lottery['MinExtraNumber'];
                $data['NumberOfMainNumbers']=$lottery['NumberOfMainNumbers'];
              
                $data['NumberOfExtraNumbers']=$lottery['NumberOfExtraNumbers'];
                $data['AmountOfExtraNumbersToMatch']=$lottery['AmountOfExtraNumbersToMatch'];
                $data['MinLines']=(int)$lottery['MinLines'];
                $data['MaxLines']=(int)$lottery['MaxLines'];
                $data['EvenLinesOnly']=($lottery['EvenLinesOnly'])?true:false;
                $productOpt=$this->getOptions($lottery['LotteryTypeId']);
               if($productOpt){
                    foreach($productOpt as $productRow){
                        $productDrawOpt['ProductId']=(int)$productRow['ProductId'];
                        $productDrawOpt['IsSubscription']=($productRow['IsSubscription'])?true:false;
                        $optionsRes = explode(",",$productRow['options']);
                        $productDrawOpt['MultiDrawOptions']=$this->multiDrawOptions($optionsRes);;
                        $data['ProductsDrawOptions'][]=$productDrawOpt;
                    }
                }
                $result[]=$data;
            }
        }
        return   json_encode($result);
    }

  public function get_prices_and_discounts(){
        $query = $this->db->get('lotteries');
        $result=array();
        $lotteries=$query->result_array();
        if($lotteries){
            foreach($lotteries as $lottery){
                $data=array();
                $data['LotteryTypeId']=(int)$lottery['LotteryTypeId'];
                $data['LotteryType']=$lottery['LotteryName'];
                $data['NumberOfDraws']=(int)$lottery['NumberOfDraws'];
                $data['ProductId']=3;
                $data['NumberOfLines']=1;
               
                $data['Price']=(float)$lottery['Price'];
                $data['VipPrice']=(float)$lottery['VipPrice'];
                $data['Discount']=(float)$lottery['Discount'];
                $data['Discount2']=0;//$lottery['Discount2'];
                $data['BrandId']=$lottery['BrandId'];
                $result[]=(object)$data;
            }
        }
        return json_encode($result) ;
  }

    public function getOptions($lotteryId=''){
        $this->db->select('pd.id,pd.ProductId,pd.LotteryTypeId,pd.IsSubscription,group_concat(pdo.MinLines,"-",pdo.MaxLines,"-",pdo.NumberOfDraws,"-",pdo.Discount,"-",pdo.Weeks) as options');
        $this->db->from('product_draws pd');
        if($lotteryId)
            $this->db->where('pd.LotteryTypeId',$lotteryId);
        $this->db->join('product_draws_options pdo',"pdo.product_draws_id=pd.id","left");
        $this->db->group_by('pd.id'); 
        $query = $this->db->get();
       return  ($query->num_rows()>0)?$query->result_array():FALSE;
    }
    private function multiDrawOptions($optionsRes){
        $MultiDrawOptions=[];
        if($optionsRes){
            foreach($optionsRes as $options){
                $option=explode("-",$options);
                if($option){
                    $drawOptions=[
                        'MinLines'=>(int)$option[0],
                        'MaxLines'=>(int)$option[1],
                        'NumberOfDraws'=>(int)$option[2],
                        'Discount'=>(float)$option[3],
                        'Weeks'=>(int)$option[4]
                    ];
                    $MultiDrawOptions[]=$drawOptions;
                }
            }
        }
        return  $MultiDrawOptions;
    }

    public function import(){
        $json='[{"DrawId":147249,"LotteryTypeId":8,"LotteryName":"SuperEnalotto","Jackpot":122200000.0,"DrawDate":"2021-03-16T20:00:00","LotteryCurrency":"€","LotteryCurrency2":"€","CountryCode":"it","CountryName":"Italy","IsMainPic":true,"NumberOfMainNumbers":90,"AmountOfMainNumbersToMatch":6,"NumberOfExtraNumbers":0,"AmountOfExtraNumbersToMatch":0,"PricePerLine":4.900,"PricePerShare":76.000,"BrandId":2},{"DrawId":35114,"LotteryTypeId":2,"LotteryName":"MegaMillions","Jackpot":93000000.0,"DrawDate":"2021-03-17T06:00:00","LotteryCurrency":"US$","LotteryCurrency2":"$","CountryCode":"us","CountryName":"USA","IsMainPic":false,"NumberOfMainNumbers":70,"AmountOfMainNumbersToMatch":5,"NumberOfExtraNumbers":25,"AmountOfExtraNumbersToMatch":1,"PricePerLine":5.040,"PricePerShare":55.200,"BrandId":2},{"DrawId":35120,"LotteryTypeId":5,"LotteryName":"EuroMillions","Jackpot":71000000.0,"DrawDate":"2021-03-16T22:45:00","LotteryCurrency":"€","LotteryCurrency2":"€","CountryCode":"eu","CountryName":"Europe","IsMainPic":false,"NumberOfMainNumbers":50,"AmountOfMainNumbersToMatch":5,"NumberOfExtraNumbers":12,"AmountOfExtraNumbersToMatch":2,"PricePerLine":7.900,"PricePerShare":79.600,"BrandId":2},{"DrawId":35118,"LotteryTypeId":4,"LotteryName":"LaPrimitiva","Jackpot":53500000.0,"DrawDate":"2021-03-18T22:30:00","LotteryCurrency":"€","LotteryCurrency2":"€","CountryCode":"es","CountryName":"Spain","IsMainPic":false,"NumberOfMainNumbers":49,"AmountOfMainNumbersToMatch":6,"NumberOfExtraNumbers":0,"AmountOfExtraNumbersToMatch":0,"PricePerLine":3.500,"PricePerShare":40.000,"BrandId":2},{"DrawId":30090,"LotteryTypeId":10,"LotteryName":"ElGordo","Jackpot":17700000.0,"DrawDate":"2021-03-21T21:30:00","LotteryCurrency":"€","LotteryCurrency2":"€","CountryCode":"es","CountryName":"Spain","IsMainPic":false,"NumberOfMainNumbers":54,"AmountOfMainNumbersToMatch":5,"NumberOfExtraNumbers":9,"AmountOfExtraNumbersToMatch":1,"PricePerLine":5.500,"PricePerShare":47.200,"BrandId":2},{"DrawId":30117,"LotteryTypeId":9,"LotteryName":"EuroJackpot","Jackpot":10000000.0,"DrawDate":"2021-03-19T21:00:00","LotteryCurrency":"€","LotteryCurrency2":"€","CountryCode":"eu","CountryName":"Europe","IsMainPic":false,"NumberOfMainNumbers":50,"AmountOfMainNumbersToMatch":5,"NumberOfExtraNumbers":10,"AmountOfExtraNumbersToMatch":2,"PricePerLine":6.500,"PricePerShare":59.000,"BrandId":2},{"DrawId":35116,"LotteryTypeId":3,"LotteryName":"Lotto649","Jackpot":5000000.0,"DrawDate":"2021-03-18T03:00:00","LotteryCurrency":"CAD$","LotteryCurrency2":"$","CountryCode":"ca","CountryName":"Canada","IsMainPic":false,"NumberOfMainNumbers":49,"AmountOfMainNumbersToMatch":6,"NumberOfExtraNumbers":0,"AmountOfExtraNumbersToMatch":0,"PricePerLine":6.500,"PricePerShare":55.200,"BrandId":2},{"DrawId":35124,"LotteryTypeId":14,"LotteryName":"NewYorkLotto","Jackpot":2400000.0,"DrawDate":"2021-03-18T06:00:00","LotteryCurrency":"US$","LotteryCurrency2":"$","CountryCode":"us","CountryName":"USA","IsMainPic":false,"NumberOfMainNumbers":59,"AmountOfMainNumbersToMatch":6,"NumberOfExtraNumbers":0,"AmountOfExtraNumbersToMatch":0,"PricePerLine":1.900,"PricePerShare":27.200,"BrandId":2},{"DrawId":30115,"LotteryTypeId":28,"LotteryName":"OzLotto","Jackpot":2000000.0,"DrawDate":"2021-03-16T12:30:00","LotteryCurrency":"AUD$","LotteryCurrency2":"$","CountryCode":"au","CountryName":"Australia","IsMainPic":false,"NumberOfMainNumbers":45,"AmountOfMainNumbersToMatch":7,"NumberOfExtraNumbers":0,"AmountOfExtraNumbersToMatch":0,"PricePerLine":2.700,"PricePerShare":31.200,"BrandId":2},{"DrawId":35122,"LotteryTypeId":12,"LotteryName":"UkLotto","Jackpot":2000000.0,"DrawDate":"2021-03-17T22:30:00","LotteryCurrency":"£","LotteryCurrency2":"£","CountryCode":"uk","CountryName":"Europe","IsMainPic":false,"NumberOfMainNumbers":59,"AmountOfMainNumbersToMatch":6,"NumberOfExtraNumbers":0,"AmountOfExtraNumbersToMatch":0,"PricePerLine":7.900,"PricePerShare":71.200,"BrandId":2},{"DrawId":8316,"LotteryTypeId":11,"LotteryName":"BonoLoto","Jackpot":1200000.0,"DrawDate":"2021-03-16T21:00:00","LotteryCurrency":"€","LotteryCurrency2":"€","CountryCode":"es","CountryName":"Spain","IsMainPic":false,"NumberOfMainNumbers":49,"AmountOfMainNumbersToMatch":6,"NumberOfExtraNumbers":0,"AmountOfExtraNumbersToMatch":0,"PricePerLine":1.900,"PricePerShare":47.200,"BrandId":2},{"DrawId":35152,"LotteryTypeId":1,"LotteryName":"PowerBall","Jackpot":-1.0,"DrawDate":"2021-03-19T06:00:00","LotteryCurrency":"US$","LotteryCurrency2":"$","CountryCode":"us","CountryName":"USA","IsMainPic":false,"NumberOfMainNumbers":69,"AmountOfMainNumbersToMatch":5,"NumberOfExtraNumbers":26,"AmountOfExtraNumbersToMatch":1,"PricePerLine":5.900,"PricePerShare":55.200,"BrandId":2}]';

        
            $pirceDiscountJson='[{"LotteryTypeId":1,"LotteryType":"PowerBall","NumberOfDraws":1,"NumberOfLines":0,"Price":6.900,"VipPrice":0.00,"ProductId":3,"Discount":1.0,"Discount2":0.0,"BrandId":2},{"LotteryTypeId":2,"LotteryType":"MegaMillions","NumberOfDraws":1,"NumberOfLines":0,"Price":6.900,"VipPrice":0.00,"ProductId":3,"Discount":1.0,"Discount2":0.0,"BrandId":2},{"LotteryTypeId":3,"LotteryType":"Lotto649","NumberOfDraws":1,"NumberOfLines":0,"Price":6.900,"VipPrice":0.00,"ProductId":3,"Discount":1.0,"Discount2":0.0,"BrandId":2},{"LotteryTypeId":4,"LotteryType":"LaPrimitiva","NumberOfDraws":1,"NumberOfLines":0,"Price":5.000,"VipPrice":0.00,"ProductId":3,"Discount":1.0,"Discount2":0.0,"BrandId":2},{"LotteryTypeId":5,"LotteryType":"EuroMillions","NumberOfDraws":1,"NumberOfLines":0,"Price":9.950,"VipPrice":0.00,"ProductId":3,"Discount":1.0,"Discount2":0.0,"BrandId":2},{"LotteryTypeId":8,"LotteryType":"SuperEnalotto","NumberOfDraws":1,"NumberOfLines":0,"Price":9.500,"VipPrice":0.00,"ProductId":3,"Discount":1.0,"Discount2":0.0,"BrandId":2},{"LotteryTypeId":10,"LotteryType":"ElGordo","NumberOfDraws":1,"NumberOfLines":0,"Price":5.900,"VipPrice":2.99,"ProductId":3,"Discount":1.0,"Discount2":0.0,"BrandId":2},{"LotteryTypeId":11,"LotteryType":"BonoLoto","NumberOfDraws":1,"NumberOfLines":0,"Price":5.900,"VipPrice":2.99,"ProductId":3,"Discount":1.0,"Discount2":0.0,"BrandId":2},{"LotteryTypeId":12,"LotteryType":"UkLotto","NumberOfDraws":1,"NumberOfLines":0,"Price":8.900,"VipPrice":0.00,"ProductId":3,"Discount":1.0,"Discount2":0.0,"BrandId":2},{"LotteryTypeId":14,"LotteryType":"NewYorkLotto","NumberOfDraws":1,"NumberOfLines":0,"Price":3.400,"VipPrice":0.00,"ProductId":3,"Discount":1.0,"Discount2":0.0,"BrandId":2},{"LotteryTypeId":9,"LotteryType":"EuroJackpot","NumberOfDraws":1,"NumberOfLines":0,"Price":7.375,"VipPrice":0.00,"ProductId":3,"Discount":1.0,"Discount2":0.0,"BrandId":2},{"LotteryTypeId":28,"LotteryType":"OzLotto","NumberOfDraws":1,"NumberOfLines":0,"Price":3.900,"VipPrice":2.99,"ProductId":3,"Discount":1.0,"Discount2":0.0,"BrandId":2},{"LotteryTypeId":35,"LotteryType":"35","NumberOfDraws":1,"NumberOfLines":0,"Price":0.000,"VipPrice":0.00,"ProductId":3,"Discount":1.0,"Discount2":0.00,"BrandId":2}]';


            $lottery_rules='[{"LotteryType":"PowerBall","MinLines":2,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":2,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":2,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":1,"SelectNumbers":69,"MinSelectNumber":1,"MaxSelectNumbers":5,"ExtraNumbers":26,"MaxExtraNumbers":1,"MinExtraNumber":1,"DrawsPerWeek":2,"DrawDaysWeekly":[{"Is24_7":true,"Day":3},{"Is24_7":false,"Day":6}]},{"LotteryType":"MegaMillions","MinLines":2,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":2,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":2,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":2,"SelectNumbers":70,"MinSelectNumber":1,"MaxSelectNumbers":5,"ExtraNumbers":25,"MaxExtraNumbers":1,"MinExtraNumber":1,"DrawsPerWeek":2,"DrawDaysWeekly":[{"Is24_7":false,"Day":2},{"Is24_7":false,"Day":5}]},{"LotteryType":"Lotto649","MinLines":2,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":2,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":2,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":3,"SelectNumbers":49,"MinSelectNumber":1,"MaxSelectNumbers":6,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":0,"DrawsPerWeek":2,"DrawDaysWeekly":[{"Is24_7":false,"Day":4},{"Is24_7":false,"Day":7}]},{"LotteryType":"LaPrimitiva","MinLines":3,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":3,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":3,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":4,"SelectNumbers":49,"MinSelectNumber":1,"MaxSelectNumbers":6,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":2,"DrawDaysWeekly":[{"Is24_7":true,"Day":3},{"Is24_7":false,"Day":5}]},{"LotteryType":"EuroMillions","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":5,"SelectNumbers":50,"MinSelectNumber":1,"MaxSelectNumbers":5,"ExtraNumbers":12,"MaxExtraNumbers":2,"MinExtraNumber":1,"DrawsPerWeek":2,"DrawDaysWeekly":[{"Is24_7":true,"Day":2},{"Is24_7":false,"Day":5}]},{"LotteryType":"SuperEnalotto","MinLines":3,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":3,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":3,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":2,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":2,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":2,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":2,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":8,"SelectNumbers":90,"MinSelectNumber":1,"MaxSelectNumbers":6,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":3,"DrawDaysWeekly":[{"Is24_7":false,"Day":2},{"Is24_7":false,"Day":4},{"Is24_7":false,"Day":6}]},{"LotteryType":"EuroJackpot","MinLines":2,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":2,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":2,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":9,"SelectNumbers":50,"MinSelectNumber":1,"MaxSelectNumbers":5,"ExtraNumbers":10,"MaxExtraNumbers":2,"MinExtraNumber":1,"DrawsPerWeek":1,"DrawDaysWeekly":[{"Is24_7":true,"Day":5}]},{"LotteryType":"ElGordo","MinLines":2,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":2,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":2,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":10,"SelectNumbers":54,"MinSelectNumber":1,"MaxSelectNumbers":5,"ExtraNumbers":9,"MaxExtraNumbers":1,"MinExtraNumber":0,"DrawsPerWeek":1,"DrawDaysWeekly":[{"Is24_7":true,"Day":7}]},{"LotteryType":"BonoLoto","MinLines":5,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":5,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":5,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":2,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":2,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":2,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":2,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":11,"SelectNumbers":49,"MinSelectNumber":1,"MaxSelectNumbers":6,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":6,"DrawDaysWeekly":[{"Is24_7":true,"Day":1},{"Is24_7":false,"Day":2},{"Is24_7":false,"Day":3},{"Is24_7":false,"Day":4},{"Is24_7":false,"Day":5},{"Is24_7":false,"Day":6}]},{"LotteryType":"Navidad","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[],"LotteryTypeId":13,"SelectNumbers":0,"MinSelectNumber":0,"MaxSelectNumbers":0,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":0,"DrawsPerWeek":0,"DrawDaysWeekly":[]},{"LotteryType":"NewYorkLotto","MinLines":4,"MaxLines":10,"EvenLinesOnly":true,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":4,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":4,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":2,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":2,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":2,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":2,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":2,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":14,"SelectNumbers":59,"MinSelectNumber":1,"MaxSelectNumbers":6,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":0,"DrawsPerWeek":2,"DrawDaysWeekly":[{"Is24_7":false,"Day":3},{"Is24_7":true,"Day":6}]},{"LotteryType":"UkLotto","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":12,"SelectNumbers":59,"MinSelectNumber":1,"MaxSelectNumbers":6,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":2,"DrawDaysWeekly":[{"Is24_7":false,"Day":3},{"Is24_7":false,"Day":6}]},{"LotteryType":"SummerLotto","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[],"LotteryTypeId":20,"SelectNumbers":0,"MinSelectNumber":1,"MaxSelectNumbers":0,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":0,"DrawDaysWeekly":[]},{"LotteryType":"ElNino","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[],"LotteryTypeId":24,"SelectNumbers":0,"MinSelectNumber":0,"MaxSelectNumbers":0,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":0,"DrawsPerWeek":0,"DrawDaysWeekly":[]},{"LotteryType":"OzLotto","MinLines":4,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":4,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":4,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":28,"SelectNumbers":45,"MinSelectNumber":1,"MaxSelectNumbers":7,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":1,"DrawDaysWeekly":[{"Is24_7":false,"Day":2}]},{"LotteryType":"FathersDay","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[],"LotteryTypeId":27,"SelectNumbers":0,"MinSelectNumber":1,"MaxSelectNumbers":0,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":0,"DrawDaysWeekly":[]},{"LotteryType":"RedCrossDraw","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[],"LotteryTypeId":29,"SelectNumbers":0,"MinSelectNumber":1,"MaxSelectNumbers":0,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":0,"DrawDaysWeekly":[]},{"LotteryType":"Valentine","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[],"LotteryTypeId":26,"SelectNumbers":0,"MinSelectNumber":1,"MaxSelectNumbers":0,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":0,"DrawDaysWeekly":[]},{"LotteryType":"PGFC","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":16,"SelectNumbers":45,"MinSelectNumber":1,"MaxSelectNumbers":6,"ExtraNumbers":10,"MaxExtraNumbers":1,"MinExtraNumber":1,"DrawsPerWeek":1,"DrawDaysWeekly":[{"Is24_7":false,"Day":4}]},{"LotteryType":"MegaJackpot","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":34,"SelectNumbers":49,"MinSelectNumber":1,"MaxSelectNumbers":6,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":7,"DrawDaysWeekly":[{"Is24_7":false,"Day":1},{"Is24_7":false,"Day":2},{"Is24_7":false,"Day":3},{"Is24_7":false,"Day":4},{"Is24_7":false,"Day":5},{"Is24_7":false,"Day":6},{"Is24_7":false,"Day":7}]},{"LotteryType":"BTCPowerPlay","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":35,"SelectNumbers":49,"MinSelectNumber":1,"MaxSelectNumbers":4,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":7,"DrawDaysWeekly":[{"Is24_7":false,"Day":1},{"Is24_7":false,"Day":2},{"Is24_7":false,"Day":3},{"Is24_7":false,"Day":4},{"Is24_7":false,"Day":5},{"Is24_7":false,"Day":6},{"Is24_7":false,"Day":7}]},{"LotteryType":"BTCRaffle_25","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":36,"SelectNumbers":0,"MinSelectNumber":1,"MaxSelectNumbers":0,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":7,"DrawDaysWeekly":[{"Is24_7":false,"Day":1},{"Is24_7":false,"Day":2},{"Is24_7":false,"Day":3},{"Is24_7":false,"Day":4},{"Is24_7":false,"Day":5},{"Is24_7":false,"Day":6},{"Is24_7":false,"Day":7}]},{"LotteryType":"BTCRaffle_50","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":37,"SelectNumbers":0,"MinSelectNumber":1,"MaxSelectNumbers":0,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":7,"DrawDaysWeekly":[{"Is24_7":false,"Day":1},{"Is24_7":false,"Day":2},{"Is24_7":false,"Day":3},{"Is24_7":false,"Day":4},{"Is24_7":false,"Day":5},{"Is24_7":false,"Day":6},{"Is24_7":false,"Day":7}]},{"LotteryType":"BTCRaffle_100","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":38,"SelectNumbers":0,"MinSelectNumber":1,"MaxSelectNumbers":0,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":7,"DrawDaysWeekly":[{"Is24_7":false,"Day":1},{"Is24_7":false,"Day":2},{"Is24_7":false,"Day":3},{"Is24_7":false,"Day":4},{"Is24_7":false,"Day":5},{"Is24_7":false,"Day":6},{"Is24_7":false,"Day":7}]},{"LotteryType":"BTCRaffle_200","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":39,"SelectNumbers":0,"MinSelectNumber":1,"MaxSelectNumbers":0,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":7,"DrawDaysWeekly":[{"Is24_7":false,"Day":1},{"Is24_7":false,"Day":2},{"Is24_7":false,"Day":3},{"Is24_7":false,"Day":4},{"Is24_7":false,"Day":5},{"Is24_7":false,"Day":6},{"Is24_7":false,"Day":7}]},{"LotteryType":"BTCRaffle_500","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":40,"SelectNumbers":0,"MinSelectNumber":1,"MaxSelectNumbers":0,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":7,"DrawDaysWeekly":[{"Is24_7":false,"Day":1},{"Is24_7":false,"Day":2},{"Is24_7":false,"Day":3},{"Is24_7":false,"Day":4},{"Is24_7":false,"Day":5},{"Is24_7":false,"Day":6},{"Is24_7":false,"Day":7}]},{"LotteryType":"BTCRaffle_1000","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":41,"SelectNumbers":0,"MinSelectNumber":1,"MaxSelectNumbers":0,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":7,"DrawDaysWeekly":[{"Is24_7":false,"Day":1},{"Is24_7":false,"Day":2},{"Is24_7":false,"Day":3},{"Is24_7":false,"Day":4},{"Is24_7":false,"Day":5},{"Is24_7":false,"Day":6},{"Is24_7":false,"Day":7}]},{"LotteryType":"BTCRaffle_2500","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":42,"SelectNumbers":0,"MinSelectNumber":1,"MaxSelectNumbers":0,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":7,"DrawDaysWeekly":[{"Is24_7":false,"Day":1},{"Is24_7":false,"Day":2},{"Is24_7":false,"Day":3},{"Is24_7":false,"Day":4},{"Is24_7":false,"Day":5},{"Is24_7":false,"Day":6},{"Is24_7":false,"Day":7}]},{"LotteryType":"BTCRaffle_5000","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":43,"SelectNumbers":0,"MinSelectNumber":1,"MaxSelectNumbers":0,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":7,"DrawDaysWeekly":[{"Is24_7":false,"Day":1},{"Is24_7":false,"Day":2},{"Is24_7":false,"Day":3},{"Is24_7":false,"Day":4},{"Is24_7":false,"Day":5},{"Is24_7":false,"Day":6},{"Is24_7":false,"Day":7}]},{"LotteryType":"BTCRaffle_10000","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":44,"SelectNumbers":0,"MinSelectNumber":1,"MaxSelectNumbers":0,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":7,"DrawDaysWeekly":[{"Is24_7":false,"Day":1},{"Is24_7":false,"Day":2},{"Is24_7":false,"Day":3},{"Is24_7":false,"Day":4},{"Is24_7":false,"Day":5},{"Is24_7":false,"Day":6},{"Is24_7":false,"Day":7}]},{"LotteryType":"BTCRaffle_25000","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":45,"SelectNumbers":0,"MinSelectNumber":1,"MaxSelectNumbers":0,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":7,"DrawDaysWeekly":[{"Is24_7":false,"Day":1},{"Is24_7":false,"Day":2},{"Is24_7":false,"Day":3},{"Is24_7":false,"Day":4},{"Is24_7":false,"Day":5},{"Is24_7":false,"Day":6},{"Is24_7":false,"Day":7}]},{"LotteryType":"Keno","MinLines":1,"MaxLines":10,"EvenLinesOnly":false,"ProductsDrawOptions":[{"ProductId":1,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.02,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.04,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.10,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.25,"Weeks":0}]},{"ProductId":3,"IsSubscription":false,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":1,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":2,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":4,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":8,"Discount":0.0,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":26,"Discount":0.15,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":52,"Discount":0.2,"Weeks":0},{"MinLines":1,"MaxLines":10,"NumberOfDraws":100,"Discount":0.25,"Weeks":0}]},{"ProductId":1,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]},{"ProductId":3,"IsSubscription":true,"MultiDrawOptions":[{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":2},{"MinLines":1,"MaxLines":10,"NumberOfDraws":0,"Discount":0.0,"Weeks":4}]}],"LotteryTypeId":46,"SelectNumbers":29,"MinSelectNumber":1,"MaxSelectNumbers":6,"ExtraNumbers":0,"MaxExtraNumbers":0,"MinExtraNumber":1,"DrawsPerWeek":7,"DrawDaysWeekly":[{"Is24_7":false,"Day":1},{"Is24_7":false,"Day":2},{"Is24_7":false,"Day":3},{"Is24_7":false,"Day":4},{"Is24_7":false,"Day":5},{"Is24_7":false,"Day":6},{"Is24_7":false,"Day":7}]}]';



        $result=json_decode($json);
        $priceDiscount=json_decode($pirceDiscountJson);
        $lotorules=json_decode($lottery_rules);
       // pr($lotorules);die;
       
       
       
        $dataInsert=[];
        if($result){

            foreach($result as $row){
                $data=[];
                $data=$row;
                
                $pricesanddisc=$this->getLotteryArray($priceDiscount,$row->LotteryTypeId);
                $lotteries_rules=$this->getLotteryArrayByType($lotorules,$row->LotteryName);
              
               
                $data->NumberOfDraws=$pricesanddisc->NumberOfDraws;
                $data->NumberOfLines=$pricesanddisc->NumberOfLines;
                $data->Price=$pricesanddisc->Price;
                $data->VipPrice=$pricesanddisc->VipPrice;
                //$data->ProductId=$pricesanddisc->ProductId;
                $data->Discount=$pricesanddisc->Discount;
                $data->Discount2=$pricesanddisc->Discount2;
                $data->BrandId=$pricesanddisc->BrandId;

            
                $data->MinLines=$lotteries_rules->MinLines;
                $data->MaxLines=$lotteries_rules->MaxLines;
                $data->EvenLinesOnly=$lotteries_rules->EvenLinesOnly;
                //$data->MaxSelectNumbers=$lotteries_rules->MaxSelectNumbers;
                $data->MinSelectNumber=$lotteries_rules->MinSelectNumber;
                $data->MinExtraNumber=$lotteries_rules->MinExtraNumber;
                $data->MaxExtraNumbers=$lotteries_rules->MaxExtraNumbers;
                $data->DrawsPerWeek=$lotteries_rules->MaxExtraNumbers;

                $dataInsert[]=$data;
                

            }
        }

        $this->db->insert_batch('lotteries', $dataInsert); 
        //pr($dataInsert);
        //die;
        //

        foreach($lotorules as $rule){
            $drawData=[];
            
            if($rule->ProductsDrawOptions){
                foreach($rule->ProductsDrawOptions as $drawOptions){
                    $drawData['LotteryTypeId']=$rule->LotteryTypeId;
                    $drawData['ProductId'] = $drawOptions->ProductId; 
                    $drawData['IsSubscription'] = ($drawOptions->IsSubscription)?1:0; 
                    $this->db->insert('product_draws',$drawData);
                    $product_draws_id=$this->db->insert_id();
                   
                    $multiDrawDataAll=[];
                    if($drawOptions->MultiDrawOptions){
                        foreach($drawOptions->MultiDrawOptions as $multiDrawOptions){
                            $multiDrawData=[];
                            $multiDrawData['product_draws_id']=$product_draws_id;
                            $multiDrawData['LotteryTypeId']=$rule->LotteryTypeId;
                            $multiDrawData['ProductId'] = $drawOptions->ProductId;
                            $multiDrawData['MinLines']=$multiDrawOptions->MinLines;
                            $multiDrawData['MaxLines'] = $multiDrawOptions->MaxLines; 
                            $multiDrawData['NumberOfDraws'] = $multiDrawOptions->NumberOfDraws; 
                            $multiDrawData['Discount'] = $multiDrawOptions->Discount; 
                            $multiDrawData['Weeks'] = $multiDrawOptions->Weeks; 
                            $multiDrawDataAll[]=$multiDrawData;
                        }
                        $this->db->insert_batch('product_draws_options', $multiDrawDataAll); 
                    }
                }
            }
        }
    }
    public function getLotteryArray($priceDiscount,$rowid){
        if($priceDiscount){
            foreach($priceDiscount as $key=>$val){
                if($rowid==$val->LotteryTypeId){
                    return $priceDiscount[$key];         
                }
            }

        }
        return false;
    }

    public function getLotteryArrayByType($rulesArray,$lotteryType){
        if($rulesArray){
            foreach($rulesArray as $key=>$val){
                if($lotteryType==$val->LotteryType){
                    return $rulesArray[$key];         
                }
            }

        }
        return false;
    }

    public function getLotteryRulesByType($rulesArray,$lotteryType){
        if($rulesArray){
            foreach($rulesArray as $key=>$val){
                if($lotteryType==$val->LotteryType){
                    return $rulesArray[$key];         
                }
            }

        }
        return false;
    }
   /* public function getNumbersKey($lotteryType){
        $numbers=[];
        switch($lotteryType){
            
            case 'powerball':
            $numbers=['main','powerball'];
            break;
            
            case 'megamillions':
                $numbers=['main','megaball'];
            break;
            
            case 'euromillions':
                $numbers=['main','stars'];
            break;
            case 'eurojackpot':
                $numbers=['main','euro'];
            break;
            
            case 'superenalotto':
                $numbers=['main','superstar'];
            break;

            default :
            break;
        }
        return $numbers;
    } */
    public function processCartForTickets(){
        $postData=[];
        $cartData=$this->cart->contents();
        $options=[];
       
        if($cartData){
            foreach($cartData as $item){
                $lottery_type=strtolower($item['name']);
                $lottoData['type']=lottery_name_mapping($lottery_type,true);
                if(strtolower($item['name'])=='megamillions' || strtolower($item['name'])=='superenalotto' || strtolower($item['name'])=='powerball' || strtolower($item['name'])== 'lotto649'){
                    $lottoData['draws']=1;
                }
                else if(strtolower($item['name'])=='eurojackpot'){
                    $lottoData['weekdays']=['friday'];
                    $lottoData['weeks']=1;
                }
                
                else if(strtolower($item['name'])=='euromillions'){
                    $lottoData['weekdays']=["friday"];
                    $lottoData['weeks']=1;
                }
                $numbersKey=getNumbersKey($lottery_type);
               
                $lines=[];
                $numberLines=[];
              
                $newNumbers=[];
                $options=explode("|",$item['options']['row']);
                if($options){
                    $options=array_filter($options);
                    foreach($options as $option){
                        $numbers=new stdClass();
                        $newNumbers=explode("#",$option);
                        
                        if(isset($numbersKey[0])){
                            $numbers_key=$numbersKey[0];
                            $numbersVal=explode(",",$newNumbers[0]);
                            $numbers->$numbers_key = $numbersVal;
                        }

                        if(isset($numbersKey[1])){
                            $numbers_key=$numbersKey[1];
                            $numbersVal= explode(",",$newNumbers[1]);
                            $numbers->$numbers_key=count($numbersVal)<=1?implode(",",$numbersVal):$numbersVal;
                        }
                        $numberLines['random']=false;
                        $numberLines['numbers']=$numbers;
                        $lines[]=$numberLines;
                    }
                }
                $lottoData['lines']=$lines;
                $lottoData['order_details']=$item;
                $postData[]= $lottoData;
            }
        }
        return $postData;
       //echo json_encode($postData[0],JSON_NUMERIC_CHECK);
    }
    public function test(){
        $this->ecommpay->payment(); 
        echo "here";die;
       // $result= $this->ltech->tickets();
        $order_id=111;
        $ticket_id=12121;//$result['id'];
        $ticketData=[
            'user_id'=>$this->session->userdata('userId'),
            'ticket_id'=>$ticket_id,
            'order_id'=>$order_id,
        ];	
        $this->ticket->insert($ticketData);
        //pr($result);
        //$this->removeCartItem('32ddd47fce5bdb7796a088fb834dddb5');
        //pr($item);die;
    }


    public function order_success(){

    }

    public function order_decline(){

    }

    public function success(){  
       
        $file = '/public_html/lottoworld.flinnwestsolutions.com/application/controllers/logs.txt';
        $json=file_get_contents("php://input");
        $response=json_decode($json);
        $ref_id=$response->payment->id;
        file_put_contents(FCPATH."application/controllers/logs.txt","Success--------/n".print_r($json,1), FILE_APPEND | LOCK_EX);
        file_put_contents(FCPATH."application/controllers/logs.txt","Success--------/n".print_r($response,1), FILE_APPEND | LOCK_EX);
        /*$data = array(
            'full_response' => $json,
            'status' => 1,
            'ISOResp'=>'CAPTURED',

        );
        $this->db->where('ref_id', $ref_id);
        $this->db->update('payments',$data);*/


        $this->db->where('ref_id',$ref_id);
        $query=$this->db->get('payments');
        $result=($query->num_rows()>0)?$query->row_array():FALSE;
        $requestData=json_decode($result['cart_data']);
       //pr($requestData);die;
        if($requestData){
            foreach($requestData as $singleRequest){
                
                $order_details=$singleRequest->order_details;
                unset($singleRequest->order_details);
               
                $ticketRes = $this->ltech->tickets($singleRequest);
                $ticket_id='';
                $tickets_details='';
                if(isset($ticketRes['id'])){
                    $ticket_id=isset($ticketRes['id'])?$ticketRes['id']:'';
                    $tickets_details=$this->ltech->tickets_details( $ticket_id);
                }
            
                $paymentData=[
                    'ref_id'=>$ref_id,
                    'status'=>1,
                    'ISOResp'=>'CAPTURED',
                    'full_response'=>$json
                ];
                $this->db->where('ref_id', $ref_id);
                $this->db->update('payments', $paymentData);

                $ticketData=[
                    'user_id'=>$result['user_id'],
                    'ticket_id'=>$ticket_id,
                    'ref_id'=>$ref_id,
                    'lottery_type'=>lottery_name_mapping($singleRequest->type),
                    'order_id'=>$result['id'],
                    'subtotal'=>$order_details->ssubtotal,
                    'cart_items'=>json_encode($order_details),
                    'tickets_details'=>json_encode($tickets_details),
                    'object_data'=> json_encode($ticketRes),
                ];
                
                $this->ticket->insert($ticketData);
            }
        }
        die;
    }
    public function fail(){
        file_put_contents(FCPATH."application/controllers/logs.txt","/n Fail--------/n".print_r(file_get_contents("php://input"),1), FILE_APPEND | LOCK_EX);

        $json=file_get_contents("php://input");
        $response=json_decode($json);
        $refid=$response->payment->id;
       // file_put_contents(FCPATH."application/controllers/logs.txt","Success--------/n".print_r($json,1), FILE_APPEND | LOCK_EX);
       // file_put_contents(FCPATH."application/controllers/logs.txt","Success--------/n".print_r($response,1), FILE_APPEND | LOCK_EX);
        $data = array(
            'full_response' => $json,
           // 'status' => 1,
        );
        $this->db->where('ref_id', $refid);
        $this->db->update('payments',$data);
        die;
    }
    public function accentpay(){
        file_put_contents(FCPATH."application/controllers/logs.txt","/n payment--------/n".print_r(file_get_contents("php://input"),1), FILE_APPEND | LOCK_EX);
    }

    

}

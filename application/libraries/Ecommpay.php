<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ecommpay{
    public function checkData(){
        $data = $this->exec_curl(LTECH_API_URL."account","GET","",['Authorization: Basic '.base64_encode(LTECH_API_KEY.":")]);
        print_r($data);
    }

    public function payment(){
    

       $paymentData=array(
        "project_id"=> '30431',
        "payment_id"=> "test_payment_1542",
        "payment_currency"=> "GBP",
        "payment_amount"=> "31415",
        "payment_description"=> "test payment",
        "signature"=> "3SDK2ZdkvLAc+Yuv7eC+lolHlEIM2JEBkAxGLUURRH68AMHUny4ShQy9Oo5geEIaD/3DDOJkWWGwPUdkIb1qlQ==",

    );
    $getUrl="https://paymentpage.ecommpay.com/payment?project_id=30431&payment_id=test_payment_1542&payment_currency=GBP&payment_amount=31415&payment_description=test&signature=3SDK2ZdkvLAc+Yuv7eC+lolHlEIM2JEBkAxGLUURRH68AMHUny4ShQy9Oo5geEIaD/3DDOJkWWGwPUdkIb1qlQ==";
       $res=$this->exec_curl(    $getUrl,"GET","",$paymentData);
       print_r($res);
       echo  $res;
       die;
        
    }

     
    public function exec_curl($url,$type,$data=[],$headers=[]){
       
        $curl = curl_init($url);
        curl_setopt_array($curl, array(
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_HTTPHEADER => $headers
        ));
        
        switch ($type){
            case "POST":
                curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
                curl_setopt($curl,CURLOPT_POSTFIELDS,http_build_query($data));
            break;
            case "JSON":
               
                curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
                curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($data,JSON_NUMERIC_CHECK));
            break;
            case "GET":
                curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'GET');
                //curl_setopt($curl,CURLOPT_POSTFIELDS,http_build_query($data));
            break;
        }
        
        $response = curl_exec($curl);
        print_r($response);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            print_r($error_msg);
        }
        
        curl_close($curl);
        
        return json_decode($response,true);
    }
}


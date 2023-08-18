<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ltech{
    public function checkData(){
        $data = $this->exec_curl(LTECH_API_URL."account","GET","",['Authorization: Basic '.base64_encode(LTECH_API_KEY.":")]);
        print_r($data);
    }

    public function account(){
        return  $this->exec_curl(LTECH_API_URL."account","GET","",['Authorization: Basic '.base64_encode(LTECH_API_KEY.":")]);
        
    }

    public function draws($param=[]){
        $input_url=['draws'];
        if(array_key_exists('lottary_name',$param)){
            $input_url[]=$param['lottary_name'];
        }

        if(array_key_exists('lottary_date',$param)){
            $input_url[]=$param['lottary_date'];
        }
        $end_point = implode("/",$input_url);

        return  $this->exec_curl(LTECH_API_URL.$end_point,"GET","",['Authorization: Basic '.base64_encode(LTECH_API_KEY.":")]);
        
    }
    public function tickets($postData,$param=[]){
        $end_point = 'tickets';
        return  $this->exec_curl(LTECH_API_URL.$end_point,"JSON",$postData,['Authorization: Basic '.base64_encode(LTECH_API_KEY.":")]);
        //return  $this->exec_curl('https://api.demo.ltech.com/v5/tickets/861bfae7-c18d-4553-976e-6459bf686139',"JSON",$postData,['Authorization: Basic '.base64_encode(LTECH_API_KEY.":")]);
        
    }   
    public function tickets_details($ticket_id,$param=[]){
        $end_point = 'tickets/'.$ticket_id;
        return  $this->exec_curl(LTECH_API_URL.$end_point,"GET",[],['Authorization: Basic '.base64_encode(LTECH_API_KEY.":")]);
        //return  $this->exec_curl('https://api.demo.ltech.com/v5/tickets/861bfae7-c18d-4553-976e-6459bf686139',"JSON",$postData,['Authorization: Basic '.base64_encode(LTECH_API_KEY.":")]);
        
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
        
        curl_close($curl);
        
        return json_decode($response,true);
    }
}


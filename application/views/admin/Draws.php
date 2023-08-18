<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Draws extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/lottery_model');
        $this->load->model('admin/user_model');
        $this->load->model('admin/draws_model');
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
            $count = $this->draws_model->userDrawsListingCount($searchText);
          
        $config = array();
        $config["base_url"] = base_url() . "admin/productDrawsList/";
        $config["total_rows"] = $count;
        $config["per_page"] = 20;
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
		
        $data["links"] = $this->pagination->create_links();

			// $returns = $this->paginationCompress ( "admin/paymentList/", $count, 8 );
            
            $data['userRecords'] = $this->draws_model->userDrawsListing($searchText, $config["per_page"], $page);
     
            $this->global['pageTitle'] = 'LotoWorld : Product Draws';
            
            $this->loadViews("admin/productDrawsList", $this->global, $data , NULL);
    }
}

function addNew()
{
    if($this->isAdmin() == TRUE)
    {
        $this->loadThis();
    }
    else
    {

        $data['roles'] = $this->user_model->getUserRoles();
        $data['infos'] = $this->draws_model->getLotteries();
        
        $this->global['pageTitle'] = 'LotoWorld : Add New Draw';

        $this->loadViews("admin/addProductDraws", $this->global, $data, NULL);
    }
}

function addNewDraws()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('data','data','trim|required|max_length[128]');
            


            // $this->form_validation->set_rules('MinLines','MinLines','trim|required|max_length[128]');
            // $this->form_validation->set_rules('MaxLines','MaxLines','trim|required|max_length[128]');
            // $this->form_validation->set_rules('NumberOfDraws','NumberOfDraws','trim|required|max_length[128]');
            // $this->form_validation->set_rules('Discount','Discount','trim|required|max_length[128]');
            // $this->form_validation->set_rules('Weeks','Weeks','trim|required|max_length[128]');

         
            // $this->form_validation->set_rules('MinLines2','MinLines2','trim|required|max_length[128]');
            // $this->form_validation->set_rules('MaxLines2','MaxLines2','trim|required|max_length[128]');
            // $this->form_validation->set_rules('NumberOfDraws2','NumberOfDraws2','trim|required|max_length[128]');
            // $this->form_validation->set_rules('Discount2','Discount2','trim|required|max_length[128]');
            // $this->form_validation->set_rules('Weeks2','Weeks2','trim|required|max_length[128]');

            
            // $this->form_validation->set_rules('MinLines3','MinLines3','trim|required|max_length[128]');
            // $this->form_validation->set_rules('MaxLines3','MaxLines3','trim|required|max_length[128]');
            // $this->form_validation->set_rules('NumberOfDraws3','NumberOfDraws3','trim|required|max_length[128]');
            // $this->form_validation->set_rules('Discount3','Discount3','trim|required|max_length[128]');
            // $this->form_validation->set_rules('Weeks3','Weeks3','trim|required|max_length[128]');

            
            // $this->form_validation->set_rules('MinLines4','MinLines4','trim|required|max_length[128]');
            // $this->form_validation->set_rules('MaxLines4','MaxLines4','trim|required|max_length[128]');
            // $this->form_validation->set_rules('NumberOfDraws4','NumberOfDraws4','trim|required|max_length[128]');
            // $this->form_validation->set_rules('Discount4','Discount4','trim|required|max_length[128]');
            // $this->form_validation->set_rules('Weeks4','Weeks4','trim|required|max_length[128]');
        

            
            
            // if($this->form_validation->run() == FALSE)
            // {
            //     $this->addNew();
            // }
            // else
            // {
               
                // $LotteryTypeId = $this->input->post('LotteryTypeId');
                // $ProductId = $this->input->post('ProductId');


                // // $MinLines = $this->input->post('MinLines');
                // // $MaxLines = $this->input->post('MaxLines');
                // $IsSubcription = $this->input->post('IsSubcription');
                // $NumberOfDraws = $this->input->post('NumberOfDraws');
                // $Discount = $this->input->post('Discount');
                // $Weeks = $this->input->post('Weeks');

                // $MinLines2 = $this->input->post('MinLines2');
                // $MaxLines2 = $this->input->post('MaxLines2');
                // $IsSubcription2 = $this->input->post('IsSubcription2');
                // $NumberOfDraws2 = $this->input->post('NumberOfDraws2');
                // $Discount2 = $this->input->post('Discount2');
                // $Weeks2 = $this->input->post('Weeks2');

                // $MinLines3 = $this->input->post('MinLines3');
                // $MaxLines3 = $this->input->post('MaxLines3');
                // $IsSubcription3 = $this->input->post('IsSubcription3');
                // $NumberOfDraws3 = $this->input->post('NumberOfDraws3');
                // $Discount3 = $this->input->post('Discount3');
                // $Weeks3 = $this->input->post('Weeks3');

                // $MinLines4 = $this->input->post('MinLines4');
                // $MaxLines4 = $this->input->post('MaxLines4');
                // $IsSubcription4 = $this->input->post('IsSubcription4');
                // $NumberOfDraws4 = $this->input->post('NumberOfDraws4');
                // $Discount4 = $this->input->post('Discount4');
                // $Weeks4 = $this->input->post('Weeks4');

                $testing = $this->input->post('data');
           
                echo "<pre>";
                print_r($testing);
                
                echo "</pre>";
                
               if(array_key_exists("IsSubcription",$testing)){
                    $data = array(
                        'ProductId' => $testing['ProductId'],
                        'LotteryTypeId' => $testing['LotteryTypeId'],
                        'IsSubscription' => $testing['IsSubcription'],
                        );
                    }
                        else{
                            $data = array(
                                'ProductId' => $testing['ProductId'],
                                'LotteryTypeId' => $testing['LotteryTypeId'],
                                'IsSubscription' => 0,
                                );
                        }
             
                
                
                        echo "<pre>";
                        print_r($data);
                        
                        echo "</pre>";
               
                // $productDraw = array('LotteryTypeId'=>$LotteryTypeId, 'ProductId'=> $ProductId,'IsSubscription'=>$IsSubcription);
             
                
                
                $result = $this->draws_model->addNewDraws($data);

                // $rowsData = array(
                //     array('product_draws_id'=>$result,
                //         'LotteryTypeId'=>$LotteryTypeId, 
                //         'ProductId'=> $ProductId, 
                //         'MinLines'=>$MinLines,
                //         'MaxLines'=>$MaxLines,
                //         'NumberOfDraws'=>$NumberOfDraws,
                //         'Discount'=>$Discount,
                //         'Weeks'=>$Weeks),
                //         array('product_draws_id'=>$result,
                //         'LotteryTypeId'=>$LotteryTypeId, 
                //         'ProductId'=> $ProductId, 
                //         'MinLines2'=>$MinLines2,
                //         'MaxLines2'=>$MaxLines2,
                //         'NumberOfDraws2'=>$NumberOfDraws2,
                //         'Discount2'=>$Discount2,
                //         'Weeks2'=>$Weeks2),
                //         array('product_draws_id'=>$result,
                //         'LotteryTypeId'=>$LotteryTypeId, 
                //         'ProductId'=> $ProductId, 
                //         'MinLines3'=>$MinLines3,
                //         'MaxLines3'=>$MaxLines3,
                //         'NumberOfDraws3'=>$NumberOfDraws3,
                //         'Discount3'=>$Discount3,
                //         'Weeks3'=>$Weeks3),
                //         array('product_draws_id'=>$result,
                //         'LotteryTypeId'=>$LotteryTypeId, 
                //         'ProductId'=> $ProductId, 
                //         'MinLines4'=>$MinLines4,
                //         'MaxLines4'=>$MaxLines4,
                //         'NumberOfDraws4'=>$NumberOfDraws4,
                //         'Discount4'=>$Discount4,
                //         'Weeks4'=>$Weeks4),

                // );
               


                // $productDrawOptions = array('product_draws_id'=>$result,'LotteryTypeId'=>$LotteryTypeId, 'ProductId'=> $ProductId, 'MinLines'=>$MinLines,
                // 'MaxLines'=>$MaxLines,'NumberOfDraws'=>$NumberOfDraws,'Discount'=>$Discount,'Weeks'=>$Weeks);

                // $productDrawOptions = array('product_draws_id'=>$result,'LotteryTypeId'=>$LotteryTypeId, 'ProductId'=> $ProductId, 'MinLines'=>$MinLines,
                // 'MaxLines'=>$MaxLines,'NumberOfDraws'=>$NumberOfDraws,'Discount'=>$Discount,'Weeks'=>$Weeks);

                // $productDrawOptions = array('product_draws_id'=>$result,'LotteryTypeId'=>$LotteryTypeId, 'ProductId'=> $ProductId, 'MinLines'=>$MinLines,
                // 'MaxLines'=>$MaxLi￼
// Lotto649
// ￼ IsSubcriptionnes,'NumberOfDraws'=>$NumberOfDraws,'Discount'=>$Discount,'Weeks'=>$Weeks);

                // $productDrawOptions = array('product_draws_id'=>$result,'LotteryTypeId'=>$LotteryTypeId, 'ProductId'=> $ProductId, 'MinLines'=>$MinLines,
                // 'MaxLines'=>$MaxLines,'NumberOfDraws'=>$NumberOfDraws,'Discount'=>$Discount,'Weeks'=>$Weeks);

                
                // $data[] = array(
                //     'product_draws_id'=>$result,
                //     'ProductId' => $testing['ProductId'],
                //     'LotteryTypeId' => $testing['LotteryTypeId'],
                //     'IsSubcription' => $testing['IsSubcription'],

                //     );
                    foreach($testing['options'] as $option){

                        $draw_data = array(
                            'product_draws_id'=>$result,
                            'ProductId' => $testing['ProductId'],
                            'LotteryTypeId' => $testing['LotteryTypeId'], 
                             'MinLines'=>$option['MinLines'],
                            'MaxLines'=>$option['MaxLines'],
                            'NumberOfDraws'=>$option['NumberOfDraws'],
                            'Discount'=>$option['Discount'],
                            'Weeks'=>$option['Weeks']
                        );
                          
                        $result2 = $this->draws_model->addNewDraws2($draw_data);
                       
                        //$option['lid']=$testing['ProductId'];
                        // print_r($option);
                    }
                
                
                
                // echo $this->db->last_query();die;
                
                if($result > 0 || $result2 > 0)
                {
                    $this->session->set_flashdata('success', 'New Lottery created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Lottery creation failed');
                }
                
                redirect('admin/addProductDraws');
            // }
        }
    }


    function deleteDraw($userId)
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
           
            $userInfo = array('isDeleted'=>1, 'modified'=>date('Y-m-d H:i:s'));
            
            $result = $this->draws_model->deleteDraw($userId, $userInfo);
           
            
            if ($result > 0) { 
                
                $this->session->set_flashdata('success', 'Product Draw Deleted successfully');
             }
            else {
                
                $this->session->set_flashdata('error', 'Product Draw Deletion failed');
                 }

            redirect('admin/productDrawsList');
        }
    }

    function editDraws($userId = NULL)
    {
        if($this->isAdmin() == TRUE || $userId == 1)
        {
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('admin/editProductDraws');
            }
            
            $data['roles'] = $this->user_model->getUserRoles();
            $data['Information'] = $this->draws_model->getDrawInfo($userId);
            $data['Info'] = $this->draws_model->getDrawInfo2($userId);
            
            $data['infos'] = $this->draws_model->getLotteries();
            
            $this->global['pageTitle'] = 'LotoWorld : Edit Draws';
            
            $this->loadViews("admin/editProductDraws", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editDraws2($userId = NULL)
    {

        echo "<pre>";
        print_r($this->input->post('data'));
        echo "</pre>";die;

        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('data','data','trim|required|max_length[128]');
            // $this->form_validation->set_rules('LotteryTypeId','LotteryTypeId','trim|required|max_length[128]');
            // $this->form_validation->set_rules('ProductId','ProductId','trim|required|max_length[128]');
            // $this->form_validation->set_rules('MinLines','MinLines','trim|required|max_length[128]');
            // $this->form_validation->set_rules('MaxLines','MaxLines','trim|required|max_length[128]');
            // $this->form_validation->set_rules('NumberOfDraws','NumberOfDraws','trim|required|max_length[128]');
            // $this->form_validation->set_rules('Discount','Discount','trim|required|max_length[128]');
            // $this->form_validation->set_rules('Weeks','Weeks','trim|required|max_length[128]');
         
         
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editLottery($userId);
            }
            else
            {

                $testing = $this->input->post('data');

                if(array_key_exists("IsSubcription",$testing)){
                    $data = array(
                        'ProductId' => $testing['ProductId'],
                        'LotteryTypeId' => $testing['LotteryTypeId'],
                        'IsSubscription' => $testing['IsSubcription'],
                        );
                    }
                        else{
                            $data = array(
                                'ProductId' => $testing['ProductId'],
                                'LotteryTypeId' => $testing['LotteryTypeId'],
                                'IsSubscription' => 0,
                                );
                        }

                
                $result = $this->draws_model->updateDraw($data, $userId);

                foreach($testing['options'] as $option){

                    $draw_data = array(
                        'product_draws_id'=>$result,
                        'ProductId' => $testing['ProductId'],
                        'LotteryTypeId' => $testing['LotteryTypeId'], 
                         'MinLines'=>$option['MinLines'],
                        'MaxLines'=>$option['MaxLines'],
                        'NumberOfDraws'=>$option['NumberOfDraws'],
                        'Discount'=>$option['Discount'],
                        'Weeks'=>$option['Weeks']
                    );
                
                    $result2 = $this->draws_model->updateDraw2($draw_data, $userId);
                }


                if($result == true AND $result2 == true)
                {
                    $this->session->set_flashdata('success', 'Lottery updated successfully');
                    
                }
                else
                {
                    $this->session->set_flashdata('error', 'Lottery updation failed');
                }
                
               redirect('admin/productDraws');
            }
        }
    }
    

}
    
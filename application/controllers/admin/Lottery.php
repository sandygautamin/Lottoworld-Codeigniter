<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Lottery extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/lottery_model');
        $this->load->model('admin/user_model');
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
            $count = $this->lottery_model->userLotteryListingCount($searchText);
          
        $config = array();
        $config["base_url"] = base_url() . "admin/paymentList/";
        $config["total_rows"] = $count;
        $config["per_page"] = 10;
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
            
            $data['userRecords'] = $this->lottery_model->userLotteryListing($searchText, $config["per_page"], $page);
     
            $this->global['pageTitle'] = 'LotoWorld : Payments';
            
            $this->loadViews("admin/lotteries", $this->global, $data , NULL);
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
        $this->load->model('admin/user_model');
        $data['roles'] = $this->user_model->getUserRoles();
        
        $this->global['pageTitle'] = 'LotoWorld : Add New Lottery';

        $this->loadViews("admin/addLottery", $this->global, $data, NULL);
    }
}

function addNewLottery()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('LotteryTypeId','LotteryTypeId','trim|required|max_length[128]');
            $this->form_validation->set_rules('LotteryName','LotteryName','trim|required|max_length[128]');
            $this->form_validation->set_rules('MinLines','MinLines','trim|required|max_length[128]');
            $this->form_validation->set_rules('MaxLines','MaxLines','trim|required|max_length[128]');
            $this->form_validation->set_rules('NumberOfMainNumbers','NumberOfMainNumbers','trim|required|max_length[128]');
            $this->form_validation->set_rules('MinSelectNumber','MinSelectNumber','trim|required|max_length[128]');
            $this->form_validation->set_rules('AmountOfMainNumbersToMatch','AmountOfMainNumbersToMatch','trim|required|max_length[128]');
            $this->form_validation->set_rules('AmountOfExtraNumbersToMatch','AmountOfExtraNumbersToMatch','trim|required|max_length[128]');
            $this->form_validation->set_rules('NumberOfExtraNumbers','NumberOfExtraNumbers','trim|required|max_length[128]');
            $this->form_validation->set_rules('MaxExtraNumbers','MaxExtraNumbers','trim|required|max_length[128]');
            $this->form_validation->set_rules('MinExtraNumber','MinExtraNumber','trim|required|max_length[128]');
            $this->form_validation->set_rules('DrawsPerWeek','DrawsPerWeek','trim|required|max_length[128]');
            $this->form_validation->set_rules('DrawDaysWeekly','DrawDaysWeekly','trim|required|max_length[128]');
            $this->form_validation->set_rules('Jackpot','Jackpot','trim|required|max_length[128]');
            $this->form_validation->set_rules('DrawId','DrawId','trim|required|max_length[128]');
            $this->form_validation->set_rules('DrawDate','DrawDate','trim|required|max_length[128]');
            $this->form_validation->set_rules('IsMainPic','IsMainPic','trim|required|max_length[128]');
            $this->form_validation->set_rules('EvenLinesOnly','EvenLinesOnly','trim|required|max_length[128]');
            $this->form_validation->set_rules('LotteryCurrency','LotteryCurrency','trim|required|max_length[128]');
            $this->form_validation->set_rules('LotteryCurrency2','LotteryCurrency2','trim|required|max_length[128]');
            $this->form_validation->set_rules('CountryCode','CountryCode','trim|required|max_length[128]');
            $this->form_validation->set_rules('CountryName','CountryName','trim|required|max_length[128]');
            $this->form_validation->set_rules('PricePerShare','PricePerShare','trim|required|max_length[128]');
            $this->form_validation->set_rules('PricePerLine','PricePerLine','trim|required|max_length[128]');
            $this->form_validation->set_rules('BrandId','BrandId','trim|required|max_length[128]');
            $this->form_validation->set_rules('Discount','Discount','trim|required|max_length[128]');
            $this->form_validation->set_rules('Discount2','Discount2','trim|required|max_length[128]');
            $this->form_validation->set_rules('Price','Price','trim|required|max_length[128]');
            $this->form_validation->set_rules('VipPrice','VipPrice','trim|required|max_length[128]');
            $this->form_validation->set_rules('NumberOfDraws','NumberOfDraws','trim|required|max_length[128]');
            $this->form_validation->set_rules('NumberOfLines','NumberOfLines','trim|required|max_length[128]');

            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
               
                $LotteryTypeId = $this->input->post('LotteryTypeId');
                $LotteryName = $this->input->post('LotteryName');
                $MinLines = $this->input->post('MinLines');
                $MaxLines = $this->input->post('MaxLines');
                $NumberOfMainNumbers = $this->input->post('NumberOfMainNumbers');
                $MinSelectNumber = $this->input->post('MinSelectNumber');
                $AmountOfMainNumbersToMatch = $this->input->post('AmountOfMainNumbersToMatch');
                $AmountOfExtraNumbersToMatch = $this->input->post('AmountOfExtraNumbersToMatch');
                $NumberOfExtraNumbers = $this->input->post('NumberOfExtraNumbers');
                $MaxExtraNumbers = $this->input->post('MaxExtraNumbers');
                $MinExtraNumber = $this->input->post('MinExtraNumber');
                $DrawsPerWeek = $this->input->post('DrawsPerWeek');
                $DrawDaysWeekly = $this->input->post('DrawDaysWeekly');
                $Jackpot = $this->input->post('Jackpot');
                $DrawId = $this->input->post('DrawId');
                $DrawDate = $this->input->post('DrawDate');
                $IsMainPic = $this->input->post('IsMainPic');
                $EvenLinesOnly = $this->input->post('EvenLinesOnly');
                $LotteryCurrency = $this->input->post('LotteryCurrency');
                $LotteryCurrency2 = $this->input->post('LotteryCurrency2');
                $CountryCode = $this->input->post('CountryCode');

                $CountryName = $this->input->post('CountryName');
                $PricePerShare = $this->input->post('PricePerShare');
                $PricePerLine = $this->input->post('PricePerLine');
                $BrandId = $this->input->post('BrandId');
                $Discount = $this->input->post('Discount');
                $Discount2 = $this->input->post('Discount2');
                $Price = $this->input->post('Price');
                $VipPrice = $this->input->post('VipPrice');

                $NumberOfDraws = $this->input->post('NumberOfDraws');
                $NumberOfLines = $this->input->post('NumberOfLines');
               
                $userInfo = array('LotteryTypeId'=>$LotteryTypeId, 'LotteryName'=> $LotteryName, 'MinLines'=>$MinLines,
                'MaxLines'=>$MaxLines,'NumberOfMainNumbers'=>$NumberOfMainNumbers,'MinSelectNumber'=>$MinSelectNumber,'AmountOfMainNumbersToMatch'=>$AmountOfMainNumbersToMatch,'AmountOfExtraNumbersToMatch'=>$AmountOfExtraNumbersToMatch,'NumberOfExtraNumbers'=>$NumberOfExtraNumbers, 'MaxExtraNumbers'=>$MaxExtraNumbers, 
                'MinExtraNumber'=>$MinExtraNumber,'DrawsPerWeek'=>$DrawsPerWeek,'DrawDaysWeekly'=>$DrawDaysWeekly,'Jackpot'=>$Jackpot,'DrawId'=>$DrawId,'DrawDate'=>$DrawDate,'IsMainPic'=>$IsMainPic,'EvenLinesOnly'=>$EvenLinesOnly,'LotteryCurrency'=>$LotteryCurrency,
                'LotteryCurrency2'=>$LotteryCurrency2,'CountryCode'=>$CountryCode,'CountryName'=>$CountryName,'PricePerShare'=>$PricePerShare,'PricePerLine'=>$PricePerLine,'BrandId'=>$BrandId,'Discount'=>$Discount,'Discount2'=>$Discount2,
                'Price'=>$Price,'VipPrice'=>$VipPrice,'NumberOfDraws'=>$NumberOfDraws,'NumberOfLines'=>$NumberOfLines,);
                
                $this->load->model('lottery_model');
                $result = $this->lottery_model->addNewUser($userInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Lottery created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Lottery creation failed');
                }
                
                redirect('admin/lotteries');
            }
        }
    }


    function deleteLottery($userId)
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
           
            $userInfo = array('isDeleted'=>1, 'modified'=>date('Y-m-d H:i:s'));
            
            $result = $this->lottery_model->deleteUser($userId, $userInfo);
            
            if ($result > 0) { 
                
                $this->session->set_flashdata('success', 'User Deleted successfully');
             }
            else {
                
                $this->session->set_flashdata('error', 'User Deletion failed');
                 }

            redirect('admin/lotteries');
        }
    }

    function editLottery($userId = NULL)
    {
        if($this->isAdmin() == TRUE || $userId == 1)
        {
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('admin/lotteries');
            }
            
            $data['roles'] = $this->user_model->getUserRoles();
            $data['Info'] = $this->lottery_model->getLotteryInfo($userId);
            
            $this->global['pageTitle'] = 'LotoWorld : Edit Lottery';
            
            $this->loadViews("admin/editLottery", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editLottery2($userId = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('LotteryTypeId','LotteryTypeId','trim|required|max_length[128]');
            $this->form_validation->set_rules('LotteryName','LotteryName','trim|required|max_length[128]');
            $this->form_validation->set_rules('MinLines','MinLines','trim|required|max_length[128]');
            $this->form_validation->set_rules('MaxLines','MaxLines','trim|required|max_length[128]');
            $this->form_validation->set_rules('NumberOfMainNumbers','NumberOfMainNumbers','trim|required|max_length[128]');
            $this->form_validation->set_rules('MinSelectNumber','MinSelectNumber','trim|required|max_length[128]');
            $this->form_validation->set_rules('AmountOfMainNumbersToMatch','AmountOfMainNumbersToMatch','trim|required|max_length[128]');
            $this->form_validation->set_rules('AmountOfExtraNumbersToMatch','AmountOfExtraNumbersToMatch','trim|required|max_length[128]');
            $this->form_validation->set_rules('NumberOfExtraNumbers','NumberOfExtraNumbers','trim|required|max_length[128]');
            $this->form_validation->set_rules('MaxExtraNumbers','MaxExtraNumbers','trim|required|max_length[128]');
            $this->form_validation->set_rules('MinExtraNumber','MinExtraNumber','trim|required|max_length[128]');
            $this->form_validation->set_rules('DrawsPerWeek','DrawsPerWeek','trim|required|max_length[128]');
            $this->form_validation->set_rules('DrawDaysWeekly','DrawDaysWeekly','trim|required|max_length[128]');
            $this->form_validation->set_rules('Jackpot','Jackpot','trim|required|max_length[128]');
            $this->form_validation->set_rules('DrawId','DrawId','trim|required|max_length[128]');
            $this->form_validation->set_rules('DrawDate','DrawDate','trim|required|max_length[128]');
            $this->form_validation->set_rules('IsMainPic','IsMainPic','trim|required|max_length[128]');
            $this->form_validation->set_rules('EvenLinesOnly','EvenLinesOnly','trim|required|max_length[128]');
            $this->form_validation->set_rules('LotteryCurrency','LotteryCurrency','trim|required|max_length[128]');
            $this->form_validation->set_rules('LotteryCurrency2','LotteryCurrency2','trim|required|max_length[128]');
            $this->form_validation->set_rules('CountryCode','CountryCode','trim|required|max_length[128]');
            $this->form_validation->set_rules('CountryName','CountryName','trim|required|max_length[128]');
            $this->form_validation->set_rules('PricePerShare','PricePerShare','trim|required|max_length[128]');
            $this->form_validation->set_rules('PricePerLine','PricePerLine','trim|required|max_length[128]');
            $this->form_validation->set_rules('BrandId','BrandId','trim|required|max_length[128]');
            $this->form_validation->set_rules('Discount','Discount','trim|required|max_length[128]');
            $this->form_validation->set_rules('Discount2','Discount2','trim|required|max_length[128]');
            $this->form_validation->set_rules('Price','Price','trim|required|max_length[128]');
            $this->form_validation->set_rules('VipPrice','VipPrice','trim|required|max_length[128]');
            $this->form_validation->set_rules('NumberOfDraws','NumberOfDraws','trim|required|max_length[128]');
            $this->form_validation->set_rules('NumberOfLines','NumberOfLines','trim|required|max_length[128]');
            // $this->form_validation->set_rules('country','Country','trim|required|max_length[128]');
            // $this->form_validation->set_rules('city','City','trim|required|max_length[128]');
            // $this->form_validation->set_rules('address','Address','trim|required|max_length[128]');
            // $this->form_validation->set_rules('zipcode','ZipCode','trim|required|max_length[128]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editLottery($userId);
            }
            else
            {
                $LotteryTypeId = $this->input->post('LotteryTypeId');
                $LotteryName = $this->input->post('LotteryName');
                $MinLines = $this->input->post('MinLines');
                $MaxLines = $this->input->post('MaxLines');
                $NumberOfMainNumbers = $this->input->post('NumberOfMainNumbers');
                $MinSelectNumber = $this->input->post('MinSelectNumber');
                $AmountOfMainNumbersToMatch = $this->input->post('AmountOfMainNumbersToMatch');
                $AmountOfExtraNumbersToMatch = $this->input->post('AmountOfExtraNumbersToMatch');
                $NumberOfExtraNumbers = $this->input->post('NumberOfExtraNumbers');
                $MaxExtraNumbers = $this->input->post('MaxExtraNumbers');
                $MinExtraNumber = $this->input->post('MinExtraNumber');
                $DrawsPerWeek = $this->input->post('DrawsPerWeek');
                $DrawDaysWeekly = $this->input->post('DrawDaysWeekly');
                $Jackpot = $this->input->post('Jackpot');
                $DrawId = $this->input->post('DrawId');
                $DrawDate = $this->input->post('DrawDate');
                $IsMainPic = $this->input->post('IsMainPic');
                $EvenLinesOnly = $this->input->post('EvenLinesOnly');
                $LotteryCurrency = $this->input->post('LotteryCurrency');
                $LotteryCurrency2 = $this->input->post('LotteryCurrency2');
                $CountryCode = $this->input->post('CountryCode');

                $CountryName = $this->input->post('CountryName');
                $PricePerShare = $this->input->post('PricePerShare');
                $PricePerLine = $this->input->post('PricePerLine');
                $BrandId = $this->input->post('BrandId');
                $Discount = $this->input->post('Discount');
                $Discount2 = $this->input->post('Discount2');
                $Price = $this->input->post('Price');
                $VipPrice = $this->input->post('VipPrice');

                $NumberOfDraws = $this->input->post('NumberOfDraws');
                $NumberOfLines = $this->input->post('NumberOfLines');
               
                $userInfo = array('LotteryTypeId'=>$LotteryTypeId, 'LotteryName'=> $LotteryName, 'MinLines'=>$MinLines,
                'MaxLines'=>$MaxLines,'NumberOfMainNumbers'=>$NumberOfMainNumbers,'MinSelectNumber'=>$MinSelectNumber,'AmountOfMainNumbersToMatch'=>$AmountOfMainNumbersToMatch,'AmountOfExtraNumbersToMatch'=>$AmountOfExtraNumbersToMatch,'NumberOfExtraNumbers'=>$NumberOfExtraNumbers, 'MaxExtraNumbers'=>$MaxExtraNumbers, 
                'MinExtraNumber'=>$MinExtraNumber,'DrawsPerWeek'=>$DrawsPerWeek,'DrawDaysWeekly'=>$DrawDaysWeekly,'Jackpot'=>$Jackpot,'DrawId'=>$DrawId,'DrawDate'=>$DrawDate,'IsMainPic'=>$IsMainPic,'EvenLinesOnly'=>$EvenLinesOnly,'LotteryCurrency'=>$LotteryCurrency,
                'LotteryCurrency2'=>$LotteryCurrency2,'CountryCode'=>$CountryCode,'CountryName'=>$CountryName,'PricePerShare'=>$PricePerShare,'PricePerLine'=>$PricePerLine,'BrandId'=>$BrandId,'Discount'=>$Discount,'Discount2'=>$Discount2,
                'Price'=>$Price,'VipPrice'=>$VipPrice,'NumberOfDraws'=>$NumberOfDraws,'NumberOfLines'=>$NumberOfLines,);
                
                
                $result = $this->lottery_model->updateLottery($userInfo, $userId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Lottery updated successfully');
                    
                }
                else
                {
                    $this->session->set_flashdata('error', 'Lottery updation failed');
                }
                
               redirect('admin/lotteries');
            }
        }
    }
    

}
    
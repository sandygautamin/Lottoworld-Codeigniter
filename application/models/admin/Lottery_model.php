<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login_model (Login Model)
 * Login model class to get to authenticate user credentials 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Lottery_model extends CI_Model
{
    
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     * 
     * 
     * 
     * 
     * */


    function userLotteryListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('lotteries');
 
       
               
        if(!empty($searchText)) {
            $likeCriteria = "(lotteries.LotteryName  LIKE '%".$searchText."%'
                            )";
            $this->db->where($likeCriteria);
        }
     
        
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function userLotteryListing($searchText = '', $page, $segment) 
    {
        $this->db->select('*');
        $this->db->from('lotteries');
        
       
        if(!empty($searchText)) {
            $likeCriteria = "(lotteries.LotteryName  LIKE '%".$searchText."%'
           )";

            $this->db->where($likeCriteria);
        }
       
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        
        $result = $query->result();        
        return $result;
    }

    function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('lotteries', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function deleteUser($userId, $userInfo)
    {
        $this->db->where('id', $userId);
        $this->db->delete('lotteries');
        
        return $this->db->affected_rows();
    }

    function getLotteryInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('lotteries');
        
        $this->db->where('id', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }

    function updateLottery($userInfo, $userId)
    {
        
        $this->db->where('id', $userId);
        $this->db->update('lotteries', $userInfo);
        // echo $this->db->last_query();die;
        return TRUE;
        
    }

}
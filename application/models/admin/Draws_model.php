<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login_model (Login Model)
 * Login model class to get to authenticate user credentials 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Draws_model extends CI_Model
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

    function getLotteries(){
        $this->db->select('*');
        $this->db->from('lotteries');
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        
        $result = $query->result();        
        return $result;
    }


    function userDrawsListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('product_draws');
        $this->db->join('lotteries', 'product_draws.LotteryTypeId = lotteries.LotteryTypeId','left');
        $this->db->join('product_draws_options as draws', 'draws.product_draws_id = product_draws.id','right');
        $this->db->group_by('draws.product_draws_id');
        $this->db->order_by("draws.id", "desc");
        if(!empty($searchText)) {
            $likeCriteria = "(draws.LotteryTypeId  LIKE '%".$searchText."%'
            OR lotteries.LotteryName  LIKE '%".$searchText."%'
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
    function userDrawsListing($searchText = '', $page, $segment) 
    {
        $this->db->select('*');
        $this->db->from('product_draws');
        $this->db->join('lotteries', 'product_draws.LotteryTypeId = lotteries.LotteryTypeId','left');
        $this->db->join('product_draws_options as draws', 'draws.product_draws_id = product_draws.id','right');
        $this->db->group_by('draws.product_draws_id');
        $this->db->order_by("draws.id", "desc");
        
       
        if(!empty($searchText)) {
            $likeCriteria = "(draws.LotteryTypeId  LIKE '%".$searchText."%'
            OR lotteries.LotteryName  LIKE '%".$searchText."%'
           )";

            $this->db->where($likeCriteria);
        }
       
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        
        $result = $query->result();        
        return $result;
    }

    function addNewDraws($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('product_draws', $userInfo);
        
        $insert_id = $this->db->insert_id();
        // echo $insert_id;die;
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    function addNewDraws2($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('product_draws_options', $userInfo);
        // echo $this->db->last_query();die;
        $insert_id = $this->db->insert_id();
        // echo $insert_id;die;
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function deleteDraw($userId, $userInfo)
    {
        
        $this->db->where('id', $userId);
        $this->db->delete('product_draws');
        
        return $this->db->affected_rows();
    }

    function deleteDraw2($userId, $userInfo)
    {
        
        $this->db->where('product_draws_id', $userId);
        $this->db->delete('product_draws_options');
        
        return $this->db->affected_rows();
    }

    function getDrawInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('product_draws');
        $this->db->join('product_draws_options as draws', 'draws.product_draws_id = product_draws.id','left');
        $this->db->where('draws.product_draws_id', $userId);
        
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        
        $result = $query->result();        
        // echo $this->db->last_query();
        return $result;
    }

    function getDrawInfo2($userId)
    {
        $this->db->select('*');
        $this->db->from('product_draws');
      
        $this->db->where('id', $userId);
        
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        
         
        // echo $this->db->last_query();
        return $query->row();
    }

    function updateDraw($userInfo, $userId)
    {
        
        $this->db->where('id', $userId);
        $this->db->update('product_draws', $userInfo);
        return TRUE;
       
        
    }

    function updateDraw2($userInfo, $userId)
    {
        
        $this->db->where('id', $userId);
        $this->db->update('product_draws_options', $userInfo);
        return TRUE;
        // echo $this->db->last_query();die;
        
    }

}
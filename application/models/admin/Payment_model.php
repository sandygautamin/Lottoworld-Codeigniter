<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login_model (Login Model)
 * Login model class to get to authenticate user credentials 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Payment_model extends CI_Model
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


    function userPaymentListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('payments as BaseTbl');
        $this->db->join('tickets', 'tickets.user_id = BaseTbl.user_id','right');
        $this->db->join('users', 'users.id = BaseTbl.user_id','left');
        $this->db->group_by('BaseTbl.id');
       
               
        if(!empty($searchText)) {
            $likeCriteria = "(users.fname  LIKE '%".$searchText."%'
                            OR  users.lname  LIKE '%".$searchText."%'
                            OR  users.created  LIKE '%".$searchText."%'
                            OR  BaseTbl.amount  LIKE '%".$searchText."%'
                            OR  tickets.lottery_type  LIKE '%".$searchText."%'
                            OR  BaseTbl.token  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('users.isDeleted', 0);
        $this->db->where('users.roleId !=', 1);
        
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
    function userPaymentListing($searchText = '', $page, $segment) 
    {
        $this->db->select('*');
        $this->db->from('payments as BaseTbl');
        $this->db->join('tickets', 'tickets.user_id = BaseTbl.user_id','right');
        $this->db->join('users', 'users.id = BaseTbl.user_id','left');
        $this->db->group_by('BaseTbl.id');
        if(!empty($searchText)) {
            $likeCriteria = "(users.fname  LIKE '%".$searchText."%'
                            OR  users.lname  LIKE '%".$searchText."%'
                            OR  users.created  LIKE '%".$searchText."%'
                            OR  BaseTbl.amount  LIKE '%".$searchText."%'
                            OR  tickets.lottery_type  LIKE '%".$searchText."%'
                            OR  BaseTbl.token  LIKE '%".$searchText."%')";

            $this->db->where($likeCriteria);
        }
        $this->db->where('users.isDeleted', 0);
        $this->db->where('users.roleId !=', 1);
       
        $this->db->order_by('users.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        
        $result = $query->result();        
        return $result;
    }

   


}
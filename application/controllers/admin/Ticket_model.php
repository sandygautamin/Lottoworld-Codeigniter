<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login_model (Login Model)
 * Login model class to get to authenticate user credentials 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Ticket_model extends CI_Model
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


    function userTicketListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tickets as BaseTbl');
        $this->db->join('users', 'users.id = BaseTbl.user_id','left');
        $this->db->group_by('BaseTbl.id');
       
               
        if(!empty($searchText)) {
            $likeCriteria = "(users.fname  LIKE '%".$searchText."%'
                            OR  users.lname  LIKE '%".$searchText."%'
                            OR  users.created  LIKE '%".$searchText."%'
                            OR  BaseTbl.lottery_type  LIKE '%".$searchText."%'
                            )";
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
    function userTicketListing($searchText = '', $page, $segment) 
    {
        $this->db->select('*');
        $this->db->from('tickets as BaseTbl');
        $this->db->join('users', 'users.id = BaseTbl.user_id','left');
        $this->db->group_by('BaseTbl.id');
        if(!empty($searchText)) {
            $likeCriteria = "(users.fname  LIKE '%".$searchText."%'
                            OR  users.lname  LIKE '%".$searchText."%'
                            OR  users.created  LIKE '%".$searchText."%'
                            OR  BaseTbl.lottery_type  LIKE '%".$searchText."%'
                            )";
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

    function getRows($params = array()) {
		
        $this->db->select('*');
        $this->db->from('tickets');
        // echo "<pre>";
        // print_r($params);
        // echo "</pre>";
    
        //fetch data by conditions
        if (array_key_exists("conditions", $params)) {
            foreach ($params['conditions'] as $key => $value) {
                // print_r($value);die;
                $this->db->where($key, $value);
                // print_r($this->db->where($key, $value));die;
            }
        }
    
        if (array_key_exists("order_id", $params)) {
            $this->db->where('order_id', $params['order_id']);
            $query = $this->db->get();
            // print_r($query);die;
            $result = $query->row_array();
        } else {
            //set start and limit
            if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit'], $params['start']);
            } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit']);
            }
            $query = $this->db->get();
            if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
                $result = $query->num_rows();
            } elseif (array_key_exists("returnType", $params) && $params['returnType'] == 'single') {
                $result = ($query->num_rows() > 0) ? $query->row_array() : FALSE;
            } else {
                $result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
            }
        }
    
        //return fetched data
        return $result;
    }

   


}
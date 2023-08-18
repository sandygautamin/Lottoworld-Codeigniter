<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ticket extends CI_Model {

    function __construct() {
        $this->userTbl = 'tickets';
    }

    /*
     * get rows from the users table
     */

    function getRows($params = array()) {
		
        $this->db->select('*');
        $this->db->from($this->userTbl);
		

        //fetch data by conditions
        if (array_key_exists("conditions", $params)) {
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        if (array_key_exists("id", $params)) {
            $this->db->where('id', $params['id']);
            $query = $this->db->get();
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

    /*
     * Insert user information
     */

    public function insert($data = array()) {
        //add created and modified data if not included
        if (!array_key_exists("created", $data)) {
            $data['created'] = date("Y-m-d H:i:s");
        }
        if (!array_key_exists("modified", $data)) {
            $data['modified'] = date("Y-m-d H:i:s");
        }

        //insert user data to users table
        $insert = $this->db->insert($this->userTbl, $data);

        //return the status
        if ($insert) {
            return $this->db->insert_id();
            ;
        } else {
            return false;
        }
    }

    /*
     * Remove User Information 
     */

    public function remove($userId) {
        return $this->db->delete($this->userTbl, array('id' => $userId));
    }

    /*
     * Password Reset user information
     */

    public function password_reset($user = array()) {


        $password = $user['password'];
        $this->db->where('email', $user['email']);
        $update = $this->db->update('users', array('password' => MD5($password)));
        if ($update)
            return true;
        else
            return false;
    }

    public function update($data = array()) {


        //add created and modified data if not included

        if (!array_key_exists("modified", $data)) {
            $data['modified'] = date("Y-m-d H:i:s");
        }
        //echo $this->userTbl;
        $this->db->where('id', $data['id']);

        //insert user data to users table
        $update = $this->db->update($this->userTbl, $data);

        //return the status
        if ($update) {
            return true;
        } else {
            return false;
        }
    }

}

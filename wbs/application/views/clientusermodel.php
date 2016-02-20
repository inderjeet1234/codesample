<?php
/**
 * Created by JetBrains PhpStorm.
 * User: macc
 * Date: 7/24/13
 * Time: 2:55 PM
 * To change this template use File | Settings | File Templates.
 */
class Clientusermodel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }



    function getmainuserdetails()
    {
        $query = $this->db->query("select * from admincompany_users where  id=".$this->uri->segment(4));




            $row = $query->row_array();

          return $row;
    }



    public function getusers($startlimit,$limit) {


         $this->db->limit($limit,$startlimit);
        $query = $this->db->get_where("admincompany_users",array('company_type'=>2));


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function getcompanies() {



        $query = $this->db->get_where("company",array('company_type'=>2));


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

}
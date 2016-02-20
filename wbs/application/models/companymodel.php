<?php
/**
 * Created by JetBrains PhpStorm.
 * User: macc
 * Date: 7/24/13
 * Time: 2:55 PM
 * To change this template use File | Settings | File Templates.
 */
class Companymodel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }



    function getcompanydetails()
    {
        $query = $this->db->query("select * from company where id=".$this->session->userdata('maincompany'));




            $row = $query->row_array();

          return $row;
    }


}
<?php
/**
 * Created by JetBrains PhpStorm.
 * User: macc
 * Date: 7/24/13
 * Time: 2:55 PM
 * To change this template use File | Settings | File Templates.
 */
class Profilemodel extends CI_Model {

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
        $query = $this->db->query("select * from users where  id=".$this->session->userdata('user_id'));




            $row = $query->row_array();

          return $row;
    }



    function getpopupmainuserdetails($id)
    {
        $query = $this->db->query("select * from users where  id=".$id);




        $row = $query->row_array();

        return $row;
    }



    public function getprojects() {



        $query = $this->db->query("select p.id as id,p.project_name as project_name,ap.isnotification  from projects p,assign_emp ap  where p.status=1 and p.id=ap.project_id and ap.username='".$this->session->userdata('username')."'");





        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }





}
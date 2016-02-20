<?php
/**
 * Created by JetBrains PhpStorm.
 * User: macc
 * Date: 7/24/13
 * Time: 2:55 PM
 * To change this template use File | Settings | File Templates.
 */
class Assignprojectsmodel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }



    function getdetail()
    {
        $query = $this->db->query("select * from users where  id=".$this->uri->segment(4));




            $row = $query->row_array();

          return $row;
    }



    public function getusers($startlimit,$limit) {


         $this->db->limit($limit,$startlimit);
        $query = $this->db->get_where("users",array('company_type'=>2));


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function getcompanies() {



        $query = $this->db->get_where("company",array('company_type'=>3));


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function getwbsemp() {



        $query = $this->db->get_where("users",array('company_type'=>1));


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function getclientemp($id) {



        $query = $this->db->get_where("users",array('company_id'=>$id));


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }




    function getprojectname($id)
    {
        $query = $this->db->query("select * from projects where id=".$id);




        $row = $query->row_array();

        return $row['project_name'];
    }




    public function getuserid($id)
    {
        $query = $this->db->query("select * from users where username='".$id."'");




        $row = $query->row_array();

        return $row['id'];
    }

    function getusername($id)
    {
        $query = $this->db->query("select * from users where username='".$id."'");




        $row = $query->row_array();

        return $row['name'];
    }

    function getcomtype($id)
    {
        $query = $this->db->query("select * from users where username='".$id."'");




        $row = $query->row_array();

        return $row['company_type'];
    }





    function getcompanyname($id)
    {
        $query = $this->db->query("select * from company where id=".$id);




        $row = $query->row_array();

        return $row['company_name'];
    }
	
	
	
	 function getuseremail($id)
    {
        $query = $this->db->query("select * from users where id=".$id);




        $row = $query->row_array();

        return $row['email'];
    }



    function getassigneddetails()
    {
        $query = $this->db->query("select * from assignprojects where  id=".$this->uri->segment(4));




        $row = $query->row_array();

        return $row;
    }



    public function getemployes() {



        $query = $this->db->get_where("assign_emp",array('project_id'=>$this->uri->segment(4)));


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {

                $data[] = $row->username;
            }
            return $data;
        }
        return false;
    }


    public function getemployees($id) {



        $query = $this->db->get_where("assign_emp",array('project_id'=>$id));


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {

                $data[] = $row->username;
            }
            return $data;
        }
        return false;
    }




    function getusercompanyid($id)
    {
        $query = $this->db->query("select * from users where username='".$id."'");
        $row = $query->row_array();

        return $row['company_id'];
    }

    function getusercompanytype($id)
    {
        $query = $this->db->query("select * from users where username='".$id."'");
        $row = $query->row_array();

        return $row['company_type'];
    }




}
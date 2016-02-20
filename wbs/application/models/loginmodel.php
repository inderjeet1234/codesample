<?php
/**
 * Created by JetBrains PhpStorm.
 * User: macc
 * Date: 7/24/13
 * Time: 2:55 PM
 * To change this template use File | Settings | File Templates.
 */
class Loginmodel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }



    function checklogin($username,$password)
    {

        $query = $this->db->query("select * from users where status=1 and username='".$username."'");



        if ($query->num_rows() > 0)
        {
            $row = $query->row_array();

            if($row['password']==md5($password))
            {
                $newdata = array(
                    'username'  => $username,
                    'user_id'=>$row['id'],
                    'role'     => $row['role'],
                    'name'     => $row['name'],
                    'company_id'=>$row['company_id'],
                    'company_type'=>$row['company_type'],
                    'logged_in' => TRUE
                );
				
				 $admincompany=$this->getadmincompany();
                $this->session->set_userdata('admin_company',$admincompany);
				
                $this->session->set_userdata($newdata);

                return true;
            }
            else
                return false;
        }
    }
        function checkcompany()
        {
            $query = $this->db->query("select * from company where company_type=1");



                if ($query->num_rows() > 0)
                {

                    $row = $query->row_array();
                    $this->session->set_userdata('maincompany',$row['id']);
                    return true;

                }
                else
                {
                    return false;
                }



         }

    function selectlogo($id)
    {
        $query = $this->db->query("select * from company where id=".$id);



		if($query->num_rows>0)
		{
        $row = $query->row_array();

        return $row['logo'];
		}
    }

    function selecttopcolor($id)
    {
        $query = $this->db->query("select * from company where id=".$id);



if($query->num_rows>0)
		{
        $row = $query->row_array();

        return $row['color'];
		}
    }


    public function getnotification() {


      //  $this->db->limit($limit,$startlimit);
        $query = $this->db->query("select * from notification where user_id=".$this->session->userdata('user_id')." order by id desc limit 0,8");


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getallnotification() {


        //  $this->db->limit($limit,$startlimit);
        $query = $this->db->query("select * from notification where  user_id=".$this->session->userdata('user_id')." order by id desc");


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }





    function getusercompanytypefromid($id)
    {
        $query = $this->db->query("select * from users where id=".$id);
        $row = $query->row_array();

        return $row['company_type'];
    }






    function getadmincompany()
    {
        $query = $this->db->query("select * from company where company_type=1");



        if($query->num_rows>0)
        {
            $row = $query->row_array();

            return $row['company_name'];
        }
    }





}
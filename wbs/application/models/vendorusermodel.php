<?php
/**
 * Created by JetBrains PhpStorm.
 * User: macc
 * Date: 7/24/13
 * Time: 2:55 PM
 * To change this template use File | Settings | File Templates.
 */
class Vendorusermodel extends CI_Model {

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
        $query = $this->db->query("select * from users where  id=".$this->uri->segment(4));




            $row = $query->row_array();

          return $row;
    }



    public function getusers($startlimit=0,$limit=0) {


        if($this->input->post('searchfil'))
        {
            $query = $this->db->query("select * from users where company_type=3 and username  LIKE '".$this->input->post('searchfil')."%' or company_type=3 and name  LIKE '".$this->input->post('searchfil')."%'");
        }

        elseif($this->uri->segment(3)=='filtersbycompanies' && $this->uri->segment(4)!='all')
        {
            $query = $this->db->query("select * from users where company_id=".$this->uri->segment(4));

        }

        else
        {

            $this->db->limit($limit,$startlimit);
            $query = $this->db->get_where("users",array('company_type'=>3));
        }




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

    function getcompanyname($id)
    {
        $query = $this->db->query("select * from company where id=".$id);




        $row = $query->row_array();

        return $row['company_name'];
    }

}
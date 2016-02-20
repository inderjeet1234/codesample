<?php
/**
 * Created by JetBrains PhpStorm.
 * User: macc
 * Date: 7/24/13
 * Time: 2:55 PM
 * To change this template use File | Settings | File Templates.
 */
class Projectsmodel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }



    function getprojectdetails()
    {
        $query = $this->db->query("select * from projects where id=".$this->uri->segment(4));




            $row = $query->row_array();

          return $row;
    }
	
	
	
    function getcompanyname($id)
    {
        $query = $this->db->query("select * from company where id=".$id);




            $row = $query->row_array();

          return $row['company_name'];
    }




    public function getprojects($startlimit=0,$limit=0) {



        if($this->uri->segment(3)=='filtersbycompanies' && $this->uri->segment(4)!='all')
        {
            $query = $this->db->query("select * from projects where  company_id=".$this->uri->segment(4));



        }
        elseif($this->input->post('searchfil'))
        {
            $query = $this->db->query("select * from projects where  project_name  LIKE '".$this->input->post('searchfil')."%' ");
        }
        else
        {
            $this->db->limit($limit,$startlimit);
            $query = $this->db->get("projects");
        }



        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }







    public function getcompletedprojects($startlimit,$limit) {


       // $this->db->limit($limit,$startlimit);
       // $query = $this->db->get_where("projects",array('status'=>3));

        $query= $this->db->query("select *,pp.id as id,pp.company_id as company_id from projects pp,assign_emp ep where pp.id=ep.project_id and pp.status=3 and ep.username='".$this->session->userdata('username')."' limit $startlimit,$limit");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }



    public function getinactiveprojects($startlimit,$limit) {


       // $this->db->limit($limit,$startlimit);
        // $query = $this->db->get_where("projects",array('status'=>3));

        $query= $this->db->query("select *,pp.id as id,pp.company_id as company_id from projects pp,assign_emp ep where pp.id=ep.project_id and pp.status=2 and ep.username='".$this->session->userdata('username')."' limit $startlimit,$limit");

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
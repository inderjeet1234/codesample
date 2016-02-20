<?php
/**
 * Created by JetBrains PhpStorm.
 * User: macc
 * Date: 7/24/13
 * Time: 2:55 PM
 * To change this template use File | Settings | File Templates.
 */
class Postsmodel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }





 function getpostuserfullname($id)
    {
        $query = $this->db->query("select * from posts where id=".$id);




        $row = $query->row_array();
        $query1 = $this->db->query("select * from users where id=".$row['user_id']);




        $row1 = $query1->row_array();

        return $row1['name'];
    }






    function getpostdetails()
    {
        $query = $this->db->query("select * from posts where  id=".$this->uri->segment(4));




            $row = $query->row_array();

          return $row;
    }



    public function getdrafts($startlimit,$limit) {


         $this->db->limit($limit,$startlimit);
        $this->db->where('status !=1 and user_id='.$this->session->userdata('user_id'));
        $query = $this->db->get("posts");


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



    function getposttitle($id)
    {
        $query = $this->db->query("select * from posts where id=".$id);




        $row = $query->row_array();

        return $row['title'];
    }



    function getpostuser($id)
    {
        $query = $this->db->query("select * from posts where id=".$id);




        $row = $query->row_array();

        return $row['user_id'];
    }




    function getprojectapprover($cid,$pid)
    {
       // $query = $this->db->query("select * from assign_emp where company_id=".$cid."  and project_id=".$pid."  and is_approver=1");


      if($this->session->userdata('company_type')==3)
		{
			 $query = $this->db->query("select * from assign_emp where company_type=1  and project_id=".$pid."  and is_approver=1");
		}
		else
		{
        $query = $this->db->query("select * from assign_emp where company_id=".$cid."  and project_id=".$pid."  and is_approver=1");
		}




        $row = $query->row_array();

        return $row['username'];
    }




    function getusercompanyid($id)
    {
        $query = $this->db->query("select * from users where username='".$id."'");
  $row = $query->row_array();

        return $row['company_id'];
    }


    function getuserfullname($id)
    {
        $query = $this->db->query("select * from users where username='".$id."'");
        $row = $query->row_array();

        return $row['name'];
    }

    function getusercompanytype($id)
    {
        $query = $this->db->query("select * from users where username='".$id."'");
        $row = $query->row_array();

        return $row['company_type'];
    }





    function getpostprojectid($id)
    {
        $query = $this->db->query("select * from posts where id=".$id);




        $row = $query->row_array();

        return $row['project_id'];
    }






    public function getpublishedposts($startlimit,$limit) {


        $this->db->limit($limit,$startlimit);



       /* if($this->uri->segment(3)=='filtersbyproject' && $this->uri->segment(4)!='all')
        {


            if($this->session->userdata('company_type')==1)
                $query = $this->db->query("select * from posts where status=1 and wbs_visible=1 and project_id=".$this->uri->segment(4)." order by id desc");
            if($this->session->userdata('company_type')==2)
                $query = $this->db->query("select * from posts where status=1 and client_visible=1 and project_id=".$this->uri->segment(4)." order by id desc");
            if($this->session->userdata('company_type')==3)
                $query = $this->db->query("select * from posts where status=1 and vendor_visible=1 and project_id=".$this->uri->segment(4)." order by id desc");

        }*/

        if($this->uri->segment(3)=='filtersbyproject' && $this->uri->segment(4)!='all')
        {

            if($this->session->userdata('company_type')==1)
                $query = $this->db->query("select * from posts where status=1 and wbs_visible=1 and project_id in(select id from projects  where id=".$this->uri->segment(4)."  and status=1) order by published_date desc");
            if($this->session->userdata('company_type')==2)
                $query = $this->db->query("select * from posts where status=1 and client_visible=1 and project_id in(select id from projects  where id=".$this->uri->segment(4)."  and status=1) order by published_date desc");
            if($this->session->userdata('company_type')==3)
                $query = $this->db->query("select * from posts where status=1 and vendor_visible=1 and project_id in(select id from projects  where id=".$this->uri->segment(4)."  and status=1) order by published_date desc");

        }









        elseif($this->uri->segment(3)=='filtersbycompanies' && $this->uri->segment(4)!='all')
        {

            if($this->session->userdata('company_type')==1)
                $query = $this->db->query("select * from posts where status=1 and wbs_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and pp.company_id=".$this->uri->segment(4)."  and em.username='".$this->session->userdata('username')."') order by published_date desc");
            if($this->session->userdata('company_type')==2)
                $query = $this->db->query("select * from posts where status=1 and client_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and pp.company_id=".$this->uri->segment(4)."   and em.username='".$this->session->userdata('username')."') order by published_date desc");
            if($this->session->userdata('company_type')==3)
                $query = $this->db->query("select * from posts where status=1 and vendor_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and pp.company_id=".$this->uri->segment(4)."   and em.username='".$this->session->userdata('username')."') order by published_date desc");

        }
        else
        {

            if($this->session->userdata('company_type')==1)
                $query = $this->db->query("select * from posts where status=1 and wbs_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."') order by published_date desc limit 0,5");
            if($this->session->userdata('company_type')==2)
                $query = $this->db->query("select * from posts where status=1 and client_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."') order by published_date desc limit 0,5");
            if($this->session->userdata('company_type')==3)
                $query = $this->db->query("select * from posts where status=1 and vendor_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."') order by published_date desc limit 0,5");

        }













      /*  if($this->session->userdata('company_type')==1)
        $query = $this->db->query("select * from posts where status=1 and wbs_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."') order by id desc");
        if($this->session->userdata('company_type')==2)
            $query = $this->db->query("select * from posts where status=1 and client_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."') order by id desc");
        if($this->session->userdata('company_type')==3)
            $query = $this->db->query("select * from posts where status=1 and vendor_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."') order by id desc");

            */
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }






    public function getloadmorepublishedposts($startlimit,$limit) {


        $this->db->limit($limit,$startlimit);



        /* if($this->uri->segment(3)=='filtersbyproject' && $this->uri->segment(4)!='all')
         {


             if($this->session->userdata('company_type')==1)
                 $query = $this->db->query("select * from posts where status=1 and wbs_visible=1 and project_id=".$this->uri->segment(4)." order by id desc");
             if($this->session->userdata('company_type')==2)
                 $query = $this->db->query("select * from posts where status=1 and client_visible=1 and project_id=".$this->uri->segment(4)." order by id desc");
             if($this->session->userdata('company_type')==3)
                 $query = $this->db->query("select * from posts where status=1 and vendor_visible=1 and project_id=".$this->uri->segment(4)." order by id desc");

         }*/

        if($this->uri->segment(3)=='filtersbyproject' && $this->uri->segment(4)!='all')
        {

            if($this->session->userdata('company_type')==1)
                $query = $this->db->query("select * from posts where status=1 and wbs_visible=1 and project_id in(select id from projects  where id=".$this->uri->segment(4)."  and status=1) order by published_date desc");
            if($this->session->userdata('company_type')==2)
                $query = $this->db->query("select * from posts where status=1 and client_visible=1 and project_id in(select id from projects  where id=".$this->uri->segment(4)."  and status=1) order by published_date desc");
            if($this->session->userdata('company_type')==3)
                $query = $this->db->query("select * from posts where status=1 and vendor_visible=1 and project_id in(select id from projects  where id=".$this->uri->segment(4)."  and status=1) order by published_date desc");

        }









        elseif($this->uri->segment(3)=='filtersbycompanies' && $this->uri->segment(4)!='all')
        {

            if($this->session->userdata('company_type')==1)
                $query = $this->db->query("select * from posts where status=1 and wbs_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and pp.company_id=".$this->uri->segment(4)."  and em.username='".$this->session->userdata('username')."') order by published_date desc");
            if($this->session->userdata('company_type')==2)
                $query = $this->db->query("select * from posts where status=1 and client_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and pp.company_id=".$this->uri->segment(4)."   and em.username='".$this->session->userdata('username')."') order by published_date desc");
            if($this->session->userdata('company_type')==3)
                $query = $this->db->query("select * from posts where status=1 and vendor_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and pp.company_id=".$this->uri->segment(4)."   and em.username='".$this->session->userdata('username')."') order by published_date desc");

        }
        else
        {

            if($this->session->userdata('company_type')==1)
                $query = $this->db->query("select * from posts where status=1 and wbs_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."') order by published_date desc limit $startlimit,$limit");
            if($this->session->userdata('company_type')==2)
                $query = $this->db->query("select * from posts where status=1 and client_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."') order by published_date desc limit $startlimit,$limit");
            if($this->session->userdata('company_type')==3)
                $query = $this->db->query("select * from posts where status=1 and vendor_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."') order by published_date desc limit $startlimit,$limit");

        }













        /*  if($this->session->userdata('company_type')==1)
          $query = $this->db->query("select * from posts where status=1 and wbs_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."') order by id desc");
          if($this->session->userdata('company_type')==2)
              $query = $this->db->query("select * from posts where status=1 and client_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."') order by id desc");
          if($this->session->userdata('company_type')==3)
              $query = $this->db->query("select * from posts where status=1 and vendor_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."') order by id desc");

              */
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function getnotifiedposts($id) {




            $query = $this->db->query("select * from posts where id=".$id);



        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function getpending($startlimit,$limit) {


        $this->db->limit($limit,$startlimit);

       // $query = $this->db->get_where("posts",array('status'=>4));
        if($this->session->userdata('company_type')==1)
        $query = $this->db->query("select * from posts where status=4 and  company_type!=2 and project_id in(select project_id from assign_emp where company_type!=2 and username='".$this->session->userdata('username')."' and is_approver=1) order by published_date desc limit $startlimit,$limit");
        else
         $query = $this->db->query("select * from posts where status=4 and  company_type=2  and project_id in(select project_id from assign_emp where company_type=2 and username='".$this->session->userdata('username')."' and is_approver=1) order by published_date desc limit $startlimit,$limit");


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


    public function getprojects() {



                 $query = $this->db->query("select p.id as id,p.project_name as project_name  from projects p,assign_emp ap  where p.status=1 and p.id=ap.project_id and ap.username='".$this->session->userdata('username')."'");





        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }




    public function getcompaniesFilters()
    {
        $query = $this->db->query("select * from company  where id in (select p.company_id as company_id from projects p,assign_emp ap  where  p.id=ap.project_id and p.status=1 and ap.username='".$this->session->userdata('username')."')");





        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;


    }



    public function getuserdeatils($id) {



        $query = $this->db->query("select * from users  where id=$id" );





        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function getcomments($id) {


   // $this->db->limit(5,0);

    // $query = $this->db->get_where("posts",array('status'=>4));
    $query = $this->db->query("select * from comments where post_id=".$id."  order by id desc limit 0,5");

    if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    return false;
}




    public function getmorecomments($id,$startlimit) {




        // $query = $this->db->get_where("posts",array('status'=>4));
        $query = $this->db->query("select * from comments where post_id=".$id." order by id desc limit ".$startlimit.",5   ");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function getnoofcomments($id) {


        //$this->db->limit(5,6);

        // $query = $this->db->get_where("posts",array('status'=>4));
        $query = $this->db->query("select * from comments where post_id=".$id." order by id desc limit 6,5");


        return $query->num_rows();

        //return false;
    }

    public function gettotalcomments($id) {


        //$this->db->limit(5,6);

        // $query = $this->db->get_where("posts",array('status'=>4));
        $query = $this->db->query("select * from comments where post_id=".$id." order by id desc");


        return $query->num_rows();

        //return false;
    }






    public function getcompletedpublishedposts()
    {



        if($this->session->userdata('company_type')==1)
            $query = $this->db->query("select * from posts where status=1 and wbs_visible=1 and project_id=".$this->uri->segment(4)." order by published_date desc");
        if($this->session->userdata('company_type')==2)
            $query = $this->db->query("select * from posts where status=1 and client_visible=1 and project_id=".$this->uri->segment(4)." order by published_date desc");
        if($this->session->userdata('company_type')==3)
            $query = $this->db->query("select * from posts where status=1 and vendor_visible=1 and project_id=".$this->uri->segment(4)." order by published_date desc");


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }





    public function getinactivepublishedposts()
    {


        if($this->session->userdata('company_type')==1)
            $query = $this->db->query("select * from posts where status=1 and wbs_visible=1 and project_id=".$this->uri->segment(4)." order by published_date desc");
        if($this->session->userdata('company_type')==2)
            $query = $this->db->query("select * from posts where status=1 and client_visible=1 and project_id=".$this->uri->segment(4)." order by published_date desc");
        if($this->session->userdata('company_type')==3)
            $query = $this->db->query("select * from posts where status=1 and vendor_visible=1 and project_id=".$this->uri->segment(4)." order by published_date desc");




        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }







    function getsharedusers($cid,$pid)
    {
        $query = $this->db->query("select * from assign_emp where company_type=".$cid."  and project_id=".$pid);




        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }










}
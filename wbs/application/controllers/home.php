<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('base.php');
class Home extends Base_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    public $selectedmenu;
    public function __construct()
    {
        parent::__construct();
        $this->selectedmenu='1';

    }

    public function index()
    {

        $this->load->library('pagination');
        $this->load->model('postsmodel','',true);

        $data['limit']=($this->uri->segment(4))?$this->uri->segment(4):1;




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










        /*

         if($this->session->userdata('company_type')==1)
             $query = $this->db->query("select * from posts where status=1 and wbs_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."')");
         if($this->session->userdata('company_type')==2)
             $query = $this->db->query("select * from posts where status=1 and client_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."')");
         if($this->session->userdata('company_type')==3)
             $query = $this->db->query("select * from posts where status=1 and vendor_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."')");


        */

        $data['total_rows'] = $query->num_rows();

        $data['per_page'] = '2';
        $data['no_of_page']=ceil($data['total_rows']/$data['per_page']);
        $data['startlimit']=($data['limit']-1)*$data['per_page'];




        $this->load->model('postsmodel','',true);
        $data['data']=$this->postsmodel->getpublishedposts($data['startlimit'],$data['per_page']);



        $data['companiesfilters']=$this->postsmodel->getcompaniesFilters();
        $data['projectsfilters']=$this->postsmodel->getprojects();

        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');
        $this->load->view('common/index',$data);
        $this->load->view('common/footer');

    }









    public function loadmore()
    {

        $this->load->library('pagination');
        $this->load->model('postsmodel','',true);

        $limit=$this->input->post('limit');

        $data['nextlimit']=$limit;


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
                $query = $this->db->query("select * from posts where status=1 and wbs_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."') order by published_date desc limit $limit,5");
            if($this->session->userdata('company_type')==2)
                $query = $this->db->query("select * from posts where status=1 and client_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."') order by published_date desc limit $limit,5");
            if($this->session->userdata('company_type')==3)
                $query = $this->db->query("select * from posts where status=1 and vendor_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."') order by published_date desc limit $limit,5");

        }


        $data['total_rows'] = $query->num_rows();






        $this->load->model('postsmodel','',true);
        $data['data']=$this->postsmodel->getloadmorepublishedposts($limit,5);






        $this->load->view('common/ajaxposts',$data);


    }



    public  function notification()
    {
        $this->load->model('loginmodel','',true);
        $data['data']=$this->loginmodel->getnotification();
        $query = $this->db->query("select * from notification where status=1 and user_id=".$this->session->userdata('user_id')." order by id desc");
        $data['totalcount']=$query->num_rows();

        $query = $this->db->query("select * from notification where user_id=".$this->session->userdata('user_id')."  order by id desc limit 0,8");
        $data['totalcounts']=$query->num_rows();
       // print_r( $data['data']);
        $this->load->view('common/notification',$data);
    }

    public  function notify()
    {
        if($this->uri->segment(4))
        {


            $this->load->library('pagination');
            $this->load->model('postsmodel','',true);

           // $data['limit']=($this->uri->segment(4))?$this->uri->segment(4):1;


                $query = $this->db->query("select * from posts where id=".$this->uri->segment(4));






            $this->load->model('postsmodel','',true);
            $data['data']=$this->postsmodel->getnotifiedposts($this->uri->segment(4));

            $this->load->view('common/header');
            $this->load->view('common/left');
            $this->load->view('common/main');
            $this->load->view('common/notifypost',$data);
            $this->load->view('common/footer');




        }
        else
        {
            if($this->input->post())
            {
                if(is_array($this->input->post('checknot')))
                {
                    foreach ($this->input->post('checknot') as $notificationid)
                    {
                        $dataasd=array('status'=>2);
                        $this->db->where('id',$notificationid);
                        $this->db->update('notification',$dataasd);
                    }


                }

            }


        $this->load->model('loginmodel','',true);
        $data['data']=$this->loginmodel->getallnotification();
        $query = $this->db->query("select * from notification where  user_id=".$this->session->userdata('user_id')." order by id desc limit 0,20");
        $data['totalcount']=$query->num_rows();
        // print_r( $data['data']);
        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');

        $this->load->view('common/notify',$data);
        $this->load->view('common/footer');

        }

    }



    public function completedprojectposts()
    {

        $this->load->library('pagination');
        $this->load->model('postsmodel','',true);



        if($this->session->userdata('company_type')==1)
            $query = $this->db->query("select * from posts where status=1 and wbs_visible=1 and project_id=".$this->uri->segment(4)." order by published_date desc ");
        if($this->session->userdata('company_type')==2)
            $query = $this->db->query("select * from posts where status=1 and client_visible=1 and project_id=".$this->uri->segment(4)." order by published_date desc ");
        if($this->session->userdata('company_type')==3)
            $query = $this->db->query("select * from posts where status=1 and vendor_visible=1 and project_id=".$this->uri->segment(4)." order by published_date desc ");
        $data['total_rows'] = $query->num_rows();






        $this->load->model('postsmodel','',true);
        $data['data']=$this->postsmodel->getcompletedpublishedposts();

        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');
        $this->load->view('common/completedprojectposts',$data);
        $this->load->view('common/footer');

    }


    public function inactiveprojectposts()
    {


        $this->load->library('pagination');
        $this->load->model('postsmodel','',true);



        if($this->session->userdata('company_type')==1)
            $query = $this->db->query("select * from posts where status=1 and wbs_visible=1 and project_id=".$this->uri->segment(4)." order by published_date desc ");
        if($this->session->userdata('company_type')==2)
            $query = $this->db->query("select * from posts where status=1 and client_visible=1 and project_id=".$this->uri->segment(4)." order by published_date desc ");
        if($this->session->userdata('company_type')==3)
            $query = $this->db->query("select * from posts where status=1 and vendor_visible=1 and project_id=".$this->uri->segment(4)." order by published_date desc ");
        $data['total_rows'] = $query->num_rows();






        $this->load->model('postsmodel','',true);
        $data['data']=$this->postsmodel->getinactivepublishedposts();

        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');
        $this->load->view('common/inactiveprojectposts',$data);
        $this->load->view('common/footer');

    }





    public function changenotifystatus()
    {
        $notifyid=$this->input->post('val');
        $dataasd=array('status'=>2);
        $this->db->where('id',$notifyid);
        $this->db->update('notification',$dataasd);

    }




}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
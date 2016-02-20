<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_Controller extends CI_Controller {

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

    public $logo;
    public $color;
    public $activeprojectcount;
    public $activepostcount;
    public $selectedmenu;
    public $totglobalpending;

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Calcutta');
        $this->selectedmenu=0;
        $this->load->library('session');
        $this->load->helper('url');

        // ensure user is signed in
        if ( $this->session->userdata('logged_in') == FALSE ) {
            redirect( 'http://www.thewednesday.in', 'refresh');    // no session established, kick back to login page
        }
        else
        {
            $role=$this->session->userdata('role');
            $this->load->model('loginmodel','',true);
            if($this->loginmodel->checkcompany())
            {
                $this->session->set_userdata('checkcompany',1);
            }
            else
            {
                $this->session->set_userdata('checkcompany',2);
            }
			if($this->session->userdata('checkcompany')==1 && $this->session->userdata('username')!='manik')
			{
            $this->logo=$this->loginmodel->selectlogo($this->session->userdata('company_id'));
            $this->color=$this->loginmodel->selecttopcolor($this->session->userdata('company_id'));
            $this->activeprojectcount=$this->db->query("select * from projects pp, assign_emp ap where pp.id=ap.project_id and ap.username='".$this->session->userdata('username')."' and pp.status=1")->num_rows();

            if($this->session->userdata('company_type')==1)
                $query = $this->db->query("select * from posts where status=1 and wbs_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."') order by id desc");
            if($this->session->userdata('company_type')==2)
                $query = $this->db->query("select * from posts where status=1 and client_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."') order by id desc");
            if($this->session->userdata('company_type')==3)
                $query = $this->db->query("select * from posts where status=1 and vendor_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$this->session->userdata('username')."') order by id desc");


            $this->activepostcount=$query->num_rows();


           //     $this->totglobalpending = $this->db->query("select * from posts where status=4  and company_id=".$this->session->userdata('company_id')."  and project_id in(select project_id from assign_emp where username='".$this->session->userdata('username')."' and is_approver=1)")->num_rows();

                if($this->session->userdata('company_type')==1)
                    $this->totglobalpending = $this->db->query("select * from posts where status=4  and  company_type!=2   and project_id in(select project_id from assign_emp where company_type!=2 and username='".$this->session->userdata('username')."' and is_approver=1)")->num_rows();
                else
                    $this->totglobalpending = $this->db->query("select * from posts where status=4   and  company_type=2  and project_id in(select project_id from assign_emp where company_type=2 and username='".$this->session->userdata('username')."' and is_approver=1)")->num_rows();





            }

        }

    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
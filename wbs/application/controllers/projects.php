<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('base.php');
class Projects extends Base_Controller {

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
        $this->selectedmenu='5';

    }

    public function create()
    {

	 $this->load->model('projectsmodel','',true);
        if($this->uri->segment(4))
        {
            $this->load->model('projectsmodel','',true);
            $data['val']=$this->projectsmodel->getprojectdetails();
        }
        else
        {
            $val=array(

                'id'=>0,
                'project_name'=>'',
                'location'=>'',
                'company_id'=>'',
                'from_date'=>'',
                'to_date'=>'',
				'description'=>'',
				'status'=>1,


            );
            $data['val']=$val;
        }
		 $data['select']=$this->projectsmodel->getcompanies();
        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');
        $this->load->view('projects/create',$data);
        $this->load->view('common/footer');

    }




    public function save()
    {
            if($this->input->post('id'))
            {
                $data=array(


                    'project_name'=>$this->input->post('project_name'),

                    'location'=>$this->input->post('location'),
					'company_id'=>$this->input->post('company_id'),
                    'from_date'=>$this->input->post('from_date'),
                    'to_date'=>$this->input->post('to_date'),
					'description'=>$this->input->post('description'),
                    'status'=>$this->input->post('status'),



                );

               if($this->input->post('status')==3)
                   $data['completed_date']=date("Y-m-d H:i:s");
                


                $this->db->where('id',$this->input->post('id'));
                $this->db->update('projects',$data);


                if($this->input->post('status')==3)
                {


                $this->load->model('assignprojectsmodel','',true);
                $employees=$this->assignprojectsmodel->getemployees($this->input->post('id'));
                foreach($employees as $valk)
                {

                    $uid=$this->assignprojectsmodel->getuserid($valk);
                    $name=$this->assignprojectsmodel->getusername($valk);
                    $compptype=$this->assignprojectsmodel->getcomtype($valk);


                    $notifydata=array(

                        'user_id'=> $uid,
                        'msg'=>'Project - "'.$this->input->post('project_name').'" has been marked as Completed.',
                        'status'=>1,
                        'link_fld'=>'projects/completed',

                    );
                    $this->db->insert('notification', $notifydata);
                }
                }



                if($this->input->post('status')==2)
                {


                    $this->load->model('assignprojectsmodel','',true);
                    $employees=$this->assignprojectsmodel->getemployees($this->input->post('id'));
                    foreach($employees as $valk)
                    {

                        $uid=$this->assignprojectsmodel->getuserid($valk);
                        $name=$this->assignprojectsmodel->getusername($valk);
                        $compptype=$this->assignprojectsmodel->getcomtype($valk);

                        if($compptype!=1)
                            continue;
                        $notifydata=array(

                            'user_id'=> $uid,
                            'msg'=>'Project - "'.$this->input->post('project_name').'" has been marked as Inactive.',
                            'status'=>1,
                            'link_fld'=>'projects/inactive',

                        );
                        $this->db->insert('notification', $notifydata);
                    }
                }




            }
            else
            {
                $data=array(

                      'project_name'=>$this->input->post('project_name'),

                    'location'=>$this->input->post('location'),
					'company_id'=>$this->input->post('company_id'),
                    'from_date'=>$this->input->post('from_date'),
                    'to_date'=>$this->input->post('to_date'),
					'description'=>$this->input->post('description'),
                    'status'=>$this->input->post('status')

                );

               
                $this->db->insert('projects',$data);
               
            }

        redirect('projects');

    }

   

    public function index()
    {
        $this->load->library('pagination');
        $this->load->model('projectsmodel','',true);

        $data['companiesfilters']=$this->projectsmodel->getcompanies();

        $data['searchfill']='';
        $data['paginationenable']=true;


        if($this->uri->segment(3)=='filtersbycompanies' && $this->uri->segment(4)!='all')
        {
            $data['total_rows'] = $this->db->query("select * from projects where  company_id=".$this->uri->segment(4))->num_rows();
            $data['data']=$this->projectsmodel->getprojects();
            $data['paginationenable']=false;


        }

        elseif($this->input->post('searchfil'))
        {
            $data['total_rows'] = $this->db->query("select * from projects where  project_name  LIKE '".$this->input->post('searchfil')."%' ")->num_rows();
            $data['data']=$this->projectsmodel->getprojects();
            $data['paginationenable']=false;
            $data['searchfill']=$this->input->post('searchfil');

        }
        else
        {

            $data['searchfill']='';

            if($this->uri->segment(3)=='filtersbycompanies')
            {
                $data['limit']=1;
            }
            else
            {
                $data['limit']=($this->uri->segment(4))?$this->uri->segment(4):1;
            }



            $data['total_rows'] = $this->db->get('projects')-> num_rows();

            $data['per_page'] = '10';
            $data['no_of_page']=ceil($data['total_rows']/$data['per_page']);
            $data['startlimit']=($data['limit']-1)*$data['per_page'];



            $this->load->model('projectsmodel','',true);
            $data['data']=$this->projectsmodel->getprojects($data['startlimit'],$data['per_page']);
        }




        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');
        $this->load->view('projects/listprojects',$data);
        $this->load->view('common/footer');

    }



    public function completed()
    {
        $this->selectedmenu=7;
        $this->load->library('pagination');
        $this->load->model('projectsmodel','',true);

        $data['limit']=($this->uri->segment(4))?$this->uri->segment(4):1;

        $data['total_rows'] =$this->db->query("select * from projects pp,assign_emp ep where pp.id=ep.project_id and pp.status=3 and ep.username='".$this->session->userdata('username')."'")->num_rows();

        $data['per_page'] = '10';
        $data['no_of_page']=ceil($data['total_rows']/$data['per_page']);
        $data['startlimit']=($data['limit']-1)*$data['per_page'];



        $this->load->model('projectsmodel','',true);
        $data['data']=$this->projectsmodel->getcompletedprojects($data['startlimit'],$data['per_page']);
        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');
        $this->load->view('projects/listcompletedprojects',$data);
        $this->load->view('common/footer');

    }




    public function inactive()
    {
        $this->selectedmenu=8;
        $this->load->library('pagination');
        $this->load->model('projectsmodel','',true);

        $data['limit']=($this->uri->segment(4))?$this->uri->segment(4):1;
        $data['total_rows'] =$this->db->query("select * from projects pp,assign_emp ep where pp.id=ep.project_id and pp.status=2 and ep.username='".$this->session->userdata('username')."'")->num_rows();

        $data['per_page'] = '10';
        $data['no_of_page']=ceil($data['total_rows']/$data['per_page']);
        $data['startlimit']=($data['limit']-1)*$data['per_page'];



        $this->load->model('projectsmodel','',true);
        $data['data']=$this->projectsmodel->getinactiveprojects($data['startlimit'],$data['per_page']);
        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');
        $this->load->view('projects/listinactiveprojects',$data);
        $this->load->view('common/footer');

    }








}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
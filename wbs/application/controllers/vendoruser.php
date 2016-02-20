<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('base.php');
class Vendoruser extends Base_Controller {

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
        $this->selectedmenu='4';

    }

    public function create()
    {

        $this->load->model('vendorusermodel','',true);
        if($this->uri->segment(4))
        {
            $this->load->model('vendorusermodel','',true);
            $data['val']=$this->vendorusermodel->getmainuserdetails();
        }
        else
        {
            $val=array(

                'id'=>0,
                'name'=>'',
                'designation'=>'',
                'contact_number'=>'',
                'email'=>'',
                'status'=>1,
                'company_id'=>0,



            );
            $data['val']=$val;
        }
        $data['select']=$this->vendorusermodel->getcompanies();
        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');
        $this->load->view('vendoruser/create',$data);
        $this->load->view('common/footer');

    }




    public function save()
    {
            if($this->input->post('id'))
            {
                $data=array(


                    'name'=>$this->input->post('name'),

                    'contact_number'=>$this->input->post('contact_number'),
                    'email'=>$this->input->post('email'),
                    'designation'=>$this->input->post('designation'),
                    'status'=>$this->input->post('status'),
                    'company_id'=>$this->input->post('company_id'),


                );
                if($this->input->post('password'))
                {
                    $data['password']=md5($this->input->post('password'));
                }
                if(!empty($_FILES['pic']['name']))
                {
                    $pic=time().$this->input->post('pic');
                    $res=move_uploaded_file($_FILES['pic']['tmp_name'],'img/admincompany/'.$pic);
                    if($res)
                    $data['pic']=$pic;
                }


                $this->db->where('id',$this->input->post('id'));
                $this->db->update('users',$data);





            }
            else
            {


                $isusernameexists=$this->db->get_where('users',array('username'=>$this->input->post('email')))->num_rows();

                if($isusernameexists)
                {
                    $this->session->set_flashdata('userexists','User Already Exists.');
                    redirect('vendoruser/create');
                }
                else
                {
                $data=array(

                    'name'=>$this->input->post('name'),
                    'username'=>$this->input->post('email'),
                    'contact_number'=>$this->input->post('contact_number'),
                    'email'=>$this->input->post('email'),
                    'designation'=>$this->input->post('designation'),
                    'registerDate'=>date("Y-m-d H:i:s"),
                    'lastvisitDate'=>date("Y-m-d H:i:s"),
                    'company_type'=>3,
                    'company_id'=>$this->input->post('company_id'),
                    'password'=>md5($this->input->post('password')),
                    'role'=>3,
                    'status'=>$this->input->post('status'),
                    'sendEmail'=>1,
                );

                if(!empty($_FILES['pic']['name']))
                {
                    $pic=time().$this->input->post('pic');
                    $res=move_uploaded_file($_FILES['pic']['tmp_name'],'img/admincompany/'.$pic);
                    if($res)
                        $data['pic']=$pic;
                }




                $this->db->insert('users',$data);
				
				  $this->load->library( 'email' );
                    $this->email->set_mailtype("html");
                    $this->email->from( 'no-reply@thewednesday.in', 'WBS Event Management Portal' );
                    $this->email->to($this->input->post('email'));
                    $this->email->subject('Your Account has been created on the '.$this->session->userdata('admin_company') .' Portal');
                    $this->email->message( $this->load->view('mail/newaccount',$data, true ) );
                    $this->email->send();


                }
            }

        redirect('vendoruser/users');

    }




    public function users()
    {
        $this->load->library('pagination');
        $this->load->model('vendorusermodel','',true);
        $data['paginationenable']=true;

        if($this->input->post('searchfil'))
        {
            $data['total_rows'] = $this->db->query("select * from users where company_type=3 and username  LIKE '".$this->input->post('searchfil')."%' or company_type=3 and name  LIKE '".$this->input->post('searchfil')."%'")->num_rows();
            $data['data']=$this->vendorusermodel->getusers();
            $data['paginationenable']=false;
            $data['searchfill']=$this->input->post('searchfil');

        }
        elseif($this->uri->segment(3)=='filtersbycompanies' && $this->uri->segment(4)!='all')
        {
            $data['total_rows'] = $this->db->query("select * from users where company_id=".$this->uri->segment(4))->num_rows();
            $data['data']=$this->clientusermodel->getusers();
            $data['paginationenable']=false;
            $data['searchfill']='';
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


            $data['total_rows'] = $this->db->get_where('users',array('company_type'=>3))-> num_rows();

            $data['per_page'] = '10';
            $data['no_of_page']=ceil($data['total_rows']/$data['per_page']);
            $data['startlimit']=($data['limit']-1)*$data['per_page'];

            $this->load->model('vendorusermodel','',true);
            $data['data']=$this->vendorusermodel->getusers($data['startlimit'],$data['per_page']);
        }




        $data['companiesfilters']=$this->vendorusermodel->getcompanies();




        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');
        $this->load->view('vendoruser/listusers',$data);
        $this->load->view('common/footer');

    }






}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
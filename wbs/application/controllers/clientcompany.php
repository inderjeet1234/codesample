<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('base.php');
class Clientcompany extends Base_Controller {

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
        $this->selectedmenu='3';

    }

    public function create()
    {


        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');
        $this->load->view('clientcompany/create');
        $this->load->view('common/footer');

    }

    public function manage()
    {



        $this->load->model('clientcompanymodel','',true);
        $data['val']=$this->clientcompanymodel->getcompanydetails();

        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main',$data);
        $this->load->view('clientcompany/manage');
        $this->load->view('common/footer');

    }


    public function save()
    {

        $isusernameexists=$this->db->get_where('users',array('username'=>$this->input->post('admin_email')))->num_rows();

        if($isusernameexists)
        {
            $this->session->set_flashdata('userexists','User Already Exists.');
            redirect('clientcompany/create');
        }
        else
        {


        if(!empty($_FILES['logo']['name']))
        {
            $picc=time().$_FILES['logo']['name'];
            move_uploaded_file($_FILES['logo']['tmp_name'],"img/company/".$picc);

            $data=array(

                'company_name'=>$this->input->post('company_name'),
            'color'=>$this->input->post('color'),
            'admin_name'=>$this->input->post('admin_name'),
            'admin_email'=>$this->input->post('admin_email'),
            'admin_pass'=>md5($this->input->post('password')),
                'status'=>$this->input->post('status'),
                'logo'=>$picc,
                'company_type'=>2,

            );

             $this->db->insert('company',$data);
                    $userdata=array(


                        'name'=>$this->input->post('admin_name'),
                        'username'=>$this->input->post('admin_email'),
                        'email'=>$this->input->post('admin_email'),
                        'password'=>md5($this->input->post('password')),
                        'role'=>2,
                        'status'=>1,
                        'sendEmail'=>1,
                        'registerDate'=>date("Y-m-d H:i:s"),
                        'lastvisitDate'=>date("Y-m-d H:i:s"),
                        'company_type'=>2,
                        'company_id'=>$this->db->insert_id()
                    );

                    $this->db->insert('users',$userdata);
					
					 $this->load->library( 'email' );
            $this->email->set_mailtype("html");
            $this->email->from( 'no-reply@thewednesday.in', 'WBS Event Management Portal' );
            $this->email->to($this->input->post('admin_email'));
            $this->email->subject('Your Account has been created on the '.$this->session->userdata('admin_company') .' Portal');
            $this->email->message( $this->load->view('mail/newaccount',$userdata, true ) );
            $this->email->send();


        }
        else

        {
            $data=array(

                'company_name'=>$this->input->post('company_name'),
                'color'=>$this->input->post('color'),
                'admin_name'=>$this->input->post('admin_name'),
                'admin_email'=>$this->input->post('admin_email'),
                'admin_pass'=>md5($this->input->post('password')),
                'company_type'=>2,
                'status'=>$this->input->post('status'),
            );

            $this->db->insert('company',$data);
            $userdata=array(


                'name'=>$this->input->post('admin_name'),
                'username'=>$this->input->post('admin_email'),
                'email'=>$this->input->post('admin_email'),
                'password'=>md5($this->input->post('password')),
                'role'=>2,
                'status'=>1,
                'sendEmail'=>1,
                'registerDate'=>date("Y-m-d H:i:s"),
                'lastvisitDate'=>date("Y-m-d H:i:s"),
                'company_type'=>2,
                'company_id'=>$this->db->insert_id(),
            );

            $this->db->insert('users',$userdata);
			
			 $this->load->library( 'email' );
            $this->email->set_mailtype("html");
            $this->email->from( 'no-reply@thewednesday.in', 'WBS Event Management Portal' );
            $this->email->to($this->input->post('admin_email'));
            $this->email->subject('Your Account has been created on the '.$this->session->userdata('admin_company') .' Portal');
            $this->email->message( $this->load->view('mail/newaccount',$userdata, true ) );
            $this->email->send();


        }

        redirect('clientcompany');

        }
    }

    public function update()
    {

        if(!empty($_FILES['logo']['name']))
        {
            $picc=time().$_FILES['logo']['name'];
            move_uploaded_file($_FILES['logo']['tmp_name'],"img/company/".$picc);

            $data=array(

                'company_name'=>$this->input->post('company_name'),
                'color'=>$this->input->post('color'),
                'admin_name'=>$this->input->post('admin_name'),
               // 'admin_email'=>$this->input->post('admin_email'),
                'logo'=>$picc,
                'status'=>$this->input->post('status'),

            );
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('company',$data);


        }
        else

        {
            $data=array(

                'company_name'=>$this->input->post('company_name'),
                'color'=>$this->input->post('color'),
                'admin_name'=>$this->input->post('admin_name'),
                'status'=>$this->input->post('status'),
                //'admin_email'=>$this->input->post('admin_email')

            );

            $this->db->where('id',$this->input->post('id'));
            $this->db->update('company',$data);


        }

        redirect('clientcompany');


    }

    function index()
    {
        $this->load->library('pagination');
        $this->load->model('clientcompanymodel','',true);


        $data['paginationenable']=true;

        if($this->input->post('searchfil'))
        {
            $data['total_rows'] = $this->db->query("select * from company where company_type=2 and company_name  LIKE '".$this->input->post('searchfil')."%' ")->num_rows();
            $data['data']=$this->clientcompanymodel->getcompanies();
            $data['paginationenable']=false;
            $data['searchfill']=$this->input->post('searchfil');

        }
        else
        {

            $data['searchfill']='';
            $data['limit']=($this->uri->segment(4))?$this->uri->segment(4):1;

            $data['total_rows'] = $this->db->get_where('company',array('company_type'=>2))->num_rows();

            $data['per_page'] = '10';
            $data['no_of_page']=ceil($data['total_rows']/$data['per_page']);
            $data['startlimit']=($data['limit']-1)*$data['per_page'];



            $this->load->model('clientcompanymodel','',true);
            $data['data']=$this->clientcompanymodel->getcompanies($data['startlimit'],$data['per_page']);
        }





        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');
        $this->load->view('clientcompany/listusers',$data);
        $this->load->view('common/footer');


    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
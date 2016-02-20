<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('base.php');
class Company extends Base_Controller {

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
    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('role')!=1)
        {
            redirect('home');
        }


    }

    public function create()
    {
        if($this->session->userdata('checkcompany')==1)
        {
            redirect('company/manage');
        }

        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');
        $this->load->view('company/create');
        $this->load->view('common/footer');

    }

    public function manage()
    {
		
        if($this->session->userdata('checkcompany')==2)
        {
            redirect('company/create');
        }

        $this->load->model('companymodel','',true);
        $data['val']=$this->companymodel->getcompanydetails();

        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main',$data);
        $this->load->view('company/manage');
        $this->load->view('common/footer');

    }


    public function save()
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
                'logo'=>$picc,
                'company_type'=>1,

            );
			$this->session->set_userdata('company_type',1);
			$this->session->set_userdata('company_id',$this->db->insert_id());

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
                        'company_type'=>1,
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
                'company_type'=>1,
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
                'company_type'=>1,
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

        redirect('company/manage');


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
                'admin_email'=>$this->input->post('admin_email'),
                'logo'=>$picc

            );
            $this->db->where('id',$this->session->userdata('maincompany'));
            $this->db->update('company',$data);


        }
        else

        {
            $data=array(

                'company_name'=>$this->input->post('company_name'),
                'color'=>$this->input->post('color'),
                'admin_name'=>$this->input->post('admin_name'),
                'admin_email'=>$this->input->post('admin_email')

            );

            $this->db->where('id',$this->session->userdata('maincompany'));
            $this->db->update('company',$data);


        }

        redirect('company/manage');


    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('base.php');
class Profile extends Base_Controller {

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

        $this->load->model('profilemodel','',true);


    }

    public function index()
    {



            $this->load->model('profilemodel','',true);
            $data['val']=$this->profilemodel->getmainuserdetails();
            $data['projects']=$this->profilemodel->getprojects();

        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');
        $this->load->view('profile/create',$data);
        $this->load->view('common/footer');

    }




    public function popupprofile()
    {


        $profileid=$this->input->post('id');
        $this->load->model('profilemodel','',true);
        $data['val']=$this->profilemodel->getpopupmainuserdetails($profileid);



        $this->load->view('profile/popupprofile',$data);


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
				'sendemail'=>$this->input->post('sendemail'),



            );
            $this->session->set_userdata('name',$this->input->post('name'));
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

            $projects=$this->profilemodel->getprojects();
            if(is_array($projects))
            {
                foreach($projects as $provalue)
                {
                    $idf=$provalue->id;
                    $field='pro_'.$idf;
                    if(isset($_POST[$field]))
                    {
                        $data=array('isnotification'=>1);
                    }
                    else
                    {
                        $data=array('isnotification'=>0);
                    }
                        $this->db->where('username',$this->session->userdata('username'));
                        $this->db->update('assign_emp',$data);

                }
            }




        }

        redirect('home');

    }






}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
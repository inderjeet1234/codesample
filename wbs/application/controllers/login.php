<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }
    public function index()
	{

        //$this->load->view('login');
		redirect( 'http://www.thewednesday.in', 'refresh');
	}
    public function getlogin()
    {

        $username=$this->input->post('username');
        $password=$this->input->post('password');
        if(!$username && !$password)
           redirect( 'http://www.thewednesday.in', 'refresh');
        if($username=='manik' && $password=='gupta')
        {
            $newdata = array(
                'username'  => 'manik',
                'role'     => '1',
                'logged_in' => TRUE
            );

            $this->session->set_userdata($newdata);
            redirect('company/manage');
        }
        else
        {
            $this->load->model('loginmodel','',true);
            if($this->loginmodel->checklogin($username,$password))
            {
                redirect('home');
            }
            else
            {
                $query = $this->db->query("select * from users where status=2 and username='".$username."'");
                if ($query->num_rows() > 0)
                {
                    $this->session->set_flashdata('invalid', 'Your Account has been Deactivated.');
                    redirect( 'http://www.thewednesday.in', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('invalid', 'Invalid Email or Password');
                   redirect( 'http://www.thewednesday.in', 'refresh');
                }


            }


        }


    }



    function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect( 'http://www.thewednesday.in', 'refresh');
    }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
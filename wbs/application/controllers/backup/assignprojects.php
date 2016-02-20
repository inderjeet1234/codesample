<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('base.php');
class Assignprojects extends Base_Controller {

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

        $this->load->model('assignprojectsmodel','',true);
        $this->selectedmenu='5';

    }

    public function create()
    {

        $this->load->model('assignprojectsmodel','',true);
        $num=$this->db->get_where('assignprojects',array('id'=>$this->uri->segment(4)))-> num_rows();
        $data['select']=$this->assignprojectsmodel->getcompanies();
        $data['wbsemp']=$this->assignprojectsmodel->getwbsemp();
        $data['clientemp']=$this->assignprojectsmodel->getclientemp($this->uri->segment(6));

        if($num!=0)
        {
            $data['company_name']=$this->assignprojectsmodel->getcompanyname($this->uri->segment(6));
            $data['project_name']=$this->assignprojectsmodel->getprojectname($this->uri->segment(4));

            $data['val']=$this->assignprojectsmodel->getassigneddetails();
            $data['employees']=$this->assignprojectsmodel->getemployes();

            $this->load->view('common/header');
            $this->load->view('common/left');
            $this->load->view('common/main');
            $this->load->view('assignprojects/edit',$data);
            $this->load->view('common/footer');
        }
        else
        {
            $data['company_name']=$this->assignprojectsmodel->getcompanyname($this->uri->segment(6));
            $data['project_name']=$this->assignprojectsmodel->getprojectname($this->uri->segment(4));

            $this->load->view('common/header');
            $this->load->view('common/left');
            $this->load->view('common/main');
            $this->load->view('assignprojects/create',$data);
            $this->load->view('common/footer');


        }



    }




    public function save()
    {




        if($this->input->post('id'))
            {
                $venapp=array();
                $joomvendors=$this->input->post('vendors');
                if($this->input->post('add_vendors_to_project')==1 && !empty($joomvendors[0]) && is_array($joomvendors))
                {       $hh=0;
                        foreach ($this->input->post('vendors') as $val) {
                            $venapp[]=$this->input->post('app_for_vendor'.$hh);
                            $hh++;
                        }
                    $resapp=implode(',',$venapp);

                }
                else
                {
                    $resapp='';
                }

                if($this->input->post('add_vendors_to_project')==1 && !empty($joomvendors[0]))
                {
                    $vendoorsdata=implode(',',$this->input->post('vendors'));
                }
                else
                {
                    $vendoorsdata='';
                }

                $data=array(

                    'id'=>$this->input->post('id'),
                    'company_id'=>$this->input->post('company_id'),
                    'add_vendors_to_project'=>$this->input->post('add_vendors_to_project'),
                    'vendors'=>$vendoorsdata,
                    'app_for_wbs'=>$this->input->post('app_for_wbs'),
                    'app_for_client'=>$this->input->post('app_for_client'),
                    'app_for_vendor'=>$resapp,



                );


                $num=$this->db->get_where('assignprojects',array('id'=>$this->input->post('id')))->num_rows();

                if($num==0)
                {
                $this->db->insert('assignprojects',$data);

                if(is_array($this->input->post('wbsemp')))
                {
                    foreach($this->input->post('wbsemp') as $val)
                    {


                        if($this->input->post('app_for_wbs')==2)
                        {
                            $isapp=1;
                        }
                        else
                        {
                            if($val==$this->input->post('wbs_approver'))
                                $isapp=1;
                            else
                                $isapp=2;
                        }


                        $data=array(

                            'project_id'=>$this->input->post('id'),

                            'username'=>$val,
                            'is_approver'=>$isapp,
                            'company_id'=>$this->assignprojectsmodel->getusercompanyid($val),
                         'company_type'=>$this->assignprojectsmodel->getusercompanytype($val),
                            'isnotification'=>1
                        );
                        $this->db->insert('assign_emp',$data);

                    }

                }


                if(is_array($this->input->post('clientemp')))
                {
                    foreach($this->input->post('clientemp') as $val)
                    {






                        if($this->input->post('app_for_client')==2)
                        {
                            $isapp=1;
                        }
                        else
                        {
                            if($val==$this->input->post('client_approver'))
                                $isapp=1;
                            else
                                $isapp=2;
                        }


                        $data=array(

                            'project_id'=>$this->input->post('id'),

                            'username'=>$val,
                            'is_approver'=>$isapp,
                            'company_id'=>$this->assignprojectsmodel->getusercompanyid($val),
                            'company_type'=>$this->assignprojectsmodel->getusercompanytype($val),
                            'isnotification'=>1
                        );
                        $this->db->insert('assign_emp',$data);

                    }

                }


                if(is_array($this->input->post('vendors')))
                {
                    $ff=0;
                    foreach($this->input->post('vendors') as $value)
                    {
                        foreach($this->input->post('vdemp'.$ff) as $val)
                        {
                          /*  if($this->input->post('app_for_vendor'.$ff)==2)
                            {
                                $isapp=1;
                            }
                            else
                            {
                                if($val==$this->input->post('vendor_approver'.$ff))
                                    $isapp=1;
                                else
                                    $isapp=2;
                            }*/
                            $isapp=2;

                            $data=array(

                                'project_id'=>$this->input->post('id'),

                                'username'=>$val,
                                'is_approver'=>$isapp,
                                'company_id'=>$this->assignprojectsmodel->getusercompanyid($val),
                                'company_type'=>$this->assignprojectsmodel->getusercompanytype($val),
                                'isnotification'=>1
                            );
                            $this->db->insert('assign_emp',$data);
                        }

                        $ff++;

                    }
                }

                }
                else
                {
                    $this->update();
                    return;
                }

             

            }



      //  $this->load->model('assignprojectsmodel','',true);
        $employees=$this->assignprojectsmodel->getemployees($this->input->post('id'));

        if(is_array($employees))
        {
        foreach($employees as $valk)
        {


            $uid= $this->assignprojectsmodel->getuserid($valk);
			
            $notifydata=array(

              'user_id'=>$uid,
                'msg'=>'New Project - "'.$this->assignprojectsmodel->getprojectname($this->input->post('id')).'" has been assigned to you.',
                'status'=>1,

            );
            $this->db->insert('notification', $notifydata);
			
			$maildata=array(
			'name'=>$this->assignprojectsmodel->getusername($valk),
			'project_name'=>$this->assignprojectsmodel->getprojectname($this->input->post('id')),
			
			);
			  $this->load->library( 'email' );
                    $this->email->set_mailtype("html");
                    $this->email->from( 'no-reply@thewednesday.in', 'WBS Event Management Portal' );
                    $this->email->to($valk);
                    $this->email->subject('New Project - "'.$this->assignprojectsmodel->getprojectname($this->input->post('id')).'" has been assigned to you.');
                    $this->email->message( $this->load->view('mail/newproject',$maildata, true ) );
                    $this->email->send();
			
			
			
			
			
			
			

        }
    }
        redirect('projects');

    }








    public function update()
    {




        if($this->input->post('id'))
        {
            $this->db->where('project_id',$this->input->post('id'));
            $this->db->delete('assign_emp');
            $venapp=array();
            $joomvendors=$this->input->post('vendors');

            if($this->input->post('add_vendors_to_project')==1  && !empty($joomvendors[0]) && is_array($joomvendors))
            {       $hh=0;
                foreach ($this->input->post('vendors') as $val) {
                    $venapp[]=$this->input->post('app_for_vendor'.$hh);
                    $hh++;
                }
                $resapp=implode(',',$venapp);

            }
            else
            {
                $resapp='';
            }


            if($this->input->post('add_vendors_to_project')==1 && !empty($joomvendors[0]))
            {
                $vendoorsdata=implode(',',$this->input->post('vendors'));
            }
            else
            {
                $vendoorsdata='';
            }

            $data=array(

               // 'id'=>$this->input->post('id'),
                'company_id'=>$this->input->post('company_id'),
                'add_vendors_to_project'=>$this->input->post('add_vendors_to_project'),
                'vendors'=>$vendoorsdata,
                'app_for_wbs'=>$this->input->post('app_for_wbs'),
                'app_for_client'=>$this->input->post('app_for_client'),
                'app_for_vendor'=>$resapp,



            );


            $this->db->where('id',$this->input->post('id'));
            $this->db->update('assignprojects',$data);

            if(is_array($this->input->post('wbsemp')))
            {
                foreach($this->input->post('wbsemp') as $val)
                {



                    if($this->input->post('app_for_wbs')==2)
                    {
                        $isapp=1;
                    }
                    else
                    {
                        if($val==$this->input->post('wbs_approver'))
                            $isapp=1;
                        else
                            $isapp=2;
                    }


                    $data=array(

                        'project_id'=>$this->input->post('id'),

                        'username'=>$val,
                        'is_approver'=>$isapp,
                        'company_id'=>$this->assignprojectsmodel->getusercompanyid($val),
                        'company_type'=>$this->assignprojectsmodel->getusercompanytype($val),
                    );
                    $this->db->insert('assign_emp',$data);

                }

            }


            if(is_array($this->input->post('clientemp')))
            {
                foreach($this->input->post('clientemp') as $val)
                {


                    if($this->input->post('app_for_client')==2)
                    {
                        $isapp=1;
                    }
                    else
                    {
                        if($val==$this->input->post('client_approver'))
                            $isapp=1;
                        else
                            $isapp=2;
                    }


                    $data=array(

                        'project_id'=>$this->input->post('id'),

                        'username'=>$val,
                        'is_approver'=>$isapp,
                        'company_id'=>$this->assignprojectsmodel->getusercompanyid($val),
                        'company_type'=>$this->assignprojectsmodel->getusercompanytype($val),
                    );
                    $this->db->insert('assign_emp',$data);

                }

            }


            if(is_array($this->input->post('vendors')))
            {
                $ff=0;
                foreach($this->input->post('vendors') as $value)
                {
                    foreach($this->input->post('vdemp'.$ff) as $val)
                    {
                        /* if($this->input->post('app_for_vendor'.$ff)==2)
                        {
                            $isapp=1;
                        }
                        else
                        {
                            if($val==$this->input->post('vendor_approver'.$ff))
                                $isapp=1;
                            else
                                $isapp=2;
                        }*/

                        $isapp=2;

                        $data=array(

                            'project_id'=>$this->input->post('id'),

                            'username'=>$val,
                            'is_approver'=>$isapp,
                            'company_id'=>$this->assignprojectsmodel->getusercompanyid($val),
                            'company_type'=>$this->assignprojectsmodel->getusercompanytype($val),
                        );
                        $this->db->insert('assign_emp',$data);
                    }

                    $ff++;

                }
            }



        }

       // $this->load->model('assignprojectsmodel','',true);
        $employees=$this->assignprojectsmodel->getemployees($this->input->post('id'));
        if(is_array($employees))
        {
        foreach($employees as $valk)
        {

            $uid=$this->assignprojectsmodel->getuserid($valk);
            $notifydata=array(

                'user_id'=>$uid,
                'msg'=>'New Project - "'.$this->assignprojectsmodel->getprojectname($this->input->post('id')).'" has been assigned to you.',
                'status'=>1,

            );
            $this->db->insert('notification', $notifydata);

        }
        }
        redirect('projects');

    }


    public  function ajaxvendors()
    {
       $data['post']=$this->input->post('val');
        if(!empty($data['post'][0]))
        $this->load->model('assignprojectsmodel','',true);
        $this->load->view('assignprojects/ajaxvendors',$data);

    }


    public  function ajaxappvendors()
    {
        $data['post']=$this->input->post('val');
        if(!empty($data['post'][0]))
            $this->load->model('assignprojectsmodel','',true);
        $this->load->view('assignprojects/ajaxappvendors',$data);

    }





    public  function appwbs()
    {
        $data['setwbs']=$this->input->post('val');
       // $data['setwbs']=explode(",",$this->input->post('val'));
        $data['appt']=$this->input->post('appp');
            $this->load->model('assignprojectsmodel','',true);
        $data['wbsemp']=$this->assignprojectsmodel->getwbsemp();
       // $data['clientemp']=$this->assignprojectsmodel->getclientemp($this->uri->segment(6));
        $this->load->view('assignprojects/appwbs',$data);

    }


    public  function appclient()
    {
        $data['setwbs']=$this->input->post('val');

        $data['appt']=$this->input->post('appp');
            $this->load->model('assignprojectsmodel','',true);

         $data['clientemp']=$this->assignprojectsmodel->getclientemp($this->input->post('cid'));

        $this->load->view('assignprojects/appclient',$data);

    }





    public  function appvendor()
    {
        $data['setwbs']=$this->input->post('val');

        $data['appt']=$this->input->post('appp');
        $data['i']=$this->input->post('reld');
        $this->load->model('assignprojectsmodel','',true);

       // $data['clientemp']=$this->assignprojectsmodel->getclientemp($this->input->post('cid'));

        $this->load->view('assignprojects/appvendor',$data);

    }






    /*public function index()
    {
        $this->load->library('pagination');
        $this->load->model('assignprojectsmodel','',true);

        $data['limit']=($this->uri->segment(4))?$this->uri->segment(4):1;
        $data['total_rows'] = $this->db->get_where('assignprojects',array('company_type'=>2))-> num_rows();

        $data['per_page'] = '2';
        $data['no_of_page']=ceil($data['total_rows']/$data['per_page']);
        $data['startlimit']=($data['limit']-1)*$data['per_page'];



        $this->load->model('assignprojectsmodel','',true);
        $data['data']=$this->assignprojectsmodel->getusers($data['startlimit'],$data['per_page']);
        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');
        $this->load->view('assignprojects/list',$data);
        $this->load->view('common/footer');

    }*/






}


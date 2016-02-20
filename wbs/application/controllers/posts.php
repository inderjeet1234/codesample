<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('base.php');
class Posts extends Base_Controller {

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
        $this->load->model('postsmodel','',true);
        $this->selectedmenu='6';

    }

    function getmorecomment()
    {
        $this->load->model('postsmodel','',true);
        $data['data']=$this->postsmodel->getmorecomments($this->input->post('val'),$this->input->post('limit'));
        $this->load->view('posts/ajaxmorecomment',$data);
    }

    public function create()
    {
        $this->selectedmenu='21';

        $this->load->model('postsmodel','',true);
        if($this->uri->segment(4))
        {
            $this->load->model('postsmodel','',true);
            $data['val']=$this->postsmodel->getpostdetails();
            $data['projects']=$this->postsmodel->getprojects($data['val']['company_id']);
        }
        else
        {
            $val=array(

                'id'=>0,
                'title'=>'',
                'description'=>'',
                'attachments'=>'',
                'created_date'=>'',
                'user_id'=>'',
                'company_id'=>'',
                'project_id'=>'',
                'company_type'=>'',
                'location'=>'',
                'status'=>2,
                'group_visible'=>''



            );
            $data['val']=$val;
        }
        //$data['select']=$this->postsmodel->getcompanies();

            $data['projects']=$this->postsmodel->getprojects();

        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');
        $this->load->view('posts/create',$data);
        $this->load->view('common/footer');

    }




    public function reject()
    {

        $this->load->model('postsmodel','',true);
		$this->load->model('assignprojectsmodel','',true);
        if($this->input->post('id'))
        {
            $data=array(
                'status'=>3,
                'rejected_reason'=>$this->input->post('rejected_reason'),

            );
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('posts',$data);



            if($this->input->post('b1')==3)
            {

                $uid=$this->postsmodel->getpostuser($this->input->post('id'));
				$useremail=$this->assignprojectsmodel->getuseremail($uid);

                $notifydata=array(

                    'user_id'=>$uid,
                    'msg'=>'Your Post - "'.$this->input->post('title').'" has been rejected .',
                    'status'=>1,
                    'link_fld'=>'posts/create/id/'.$this->input->post('id'),


                );
                $this->db->insert('notification',$notifydata);
				
				
											
			$maildata=array(
			'name'=>$name,
			
			'post_title'=>$this->input->post('title'),
			
			);
				if($this->db->query("select * from users where sendemail=1 and username='".$useremail."'")->num_rows()>0)
				{
								
						if($this->db->query("select * from assign_emp where isnotification=1 and username='$useremail' and project_id=(select project_id from posts where id=".$this->input->post('id').")")->num_rows()>0)	
						
						{	
								$this->load->library( 'email' );
								$this->email->set_mailtype("html");
								$this->email->from( 'no-reply@thewednesday.in', 'WBS Event Management Portal' );
								$this->email->to($useremail);
								$this->email->subject('Your Post - "'.$this->input->post('title').'" has been rejected .');
								$this->email->message( $this->load->view('mail/poststatus',$maildata, true ) );
								$this->email->send();
						}		
				}		
			

            }




            redirect('posts/pending');
        }
        if($this->uri->segment(4))
        {
            $this->load->model('postsmodel','',true);
            $data['val']=$this->postsmodel->getpostdetails();
            $data['projects']=$this->postsmodel->getprojects($data['val']['company_id']);
        }


        //$data['select']=$this->postsmodel->getcompanies();

        $data['projects']=$this->postsmodel->getprojects();

        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');
        $this->load->view('posts/reject',$data);
        $this->load->view('common/footer');

    }


    public  function ajaxprojects()
    {
        $this->load->model('postsmodel','',true);



        $data['projects']=$this->postsmodel->getprojects($this->input->post('val'));

        $this->load->view('posts/ajaxprojects',$data);

    }






    public function save()
    {



            if($this->input->post('id'))
            {
                $data=array(

                    'title'=>$this->input->post('title'),
                    'description'=>$this->input->post('description'),

                   // 'created_date'=>date("Y-m-d H:i:s"),
					'published_date'=>date("Y-m-d H:i:s"),
					
                    //'user_id'=>$this->session->userdata('user_id'),
                    'company_id'=>$this->input->post('company_id'),
                    'project_id'=>$this->input->post('project_id'),
                    'company_type'=>$this->session->userdata('company_type'),
                    'location'=>'desktop',
                    'status'=>$this->input->post('b1'),
                    'wbs_visible'=>($this->input->post('wbs_visible'))?1:0,
                    'client_visible'=>($this->input->post('client_visible'))?1:0,
                    'vendor_visible'=>($this->input->post('vendor_visible'))?1:0,
                );



                if($this->session->userdata('company_type')==1)
                {
                    $data['wbs_visible']=1;
                }
                if($this->session->userdata('company_type')==2)
                {
                    $data['client_visible']=1;
                }
                if($this->session->userdata('company_type')==3)
                {
                    $data['vendor_visible']=1;
                }


                if(is_array($_FILES['attachment']['name']))
                {
                    $trarray=array();
                    foreach ($_FILES['attachment']['name'] as $key=>$attchter) {



                    $pic=time().$attchter;
                    $res=move_uploaded_file($_FILES['attachment']['tmp_name'][$key],'img/posts/'.$pic);
                    if($res)
                        $trarray[]=$pic;
                    }
                    $data['attachments']=implode(',',$trarray);
                }
                       
					   if(empty($data['attachments']))
                        unset($data['attachments']);

                $this->db->where('id',$this->input->post('id'));
                $this->db->update('posts',$data);




            }
            else
            {
                $data=array(

                    'title'=>$this->input->post('title'),
                    'description'=>$this->input->post('description'),

                    'created_date'=>date("Y-m-d H:i:s"),
					'published_date'=>date("Y-m-d H:i:s"),
					
                    'user_id'=>$this->session->userdata('user_id'),
                    'company_id'=>$this->input->post('company_id'),
                    'project_id'=>$this->input->post('project_id'),
                    'company_type'=>$this->session->userdata('company_type'),
                    'location'=>'desktop',
                    'status'=>$this->input->post('b1'),
                    'wbs_visible'=>($this->input->post('wbs_visible'))?1:0,
                    'client_visible'=>($this->input->post('client_visible'))?1:0,
                    'vendor_visible'=>($this->input->post('vendor_visible'))?1:0,
                );


                 
                if($this->session->userdata('company_type')==1)
                {
                    $data['wbs_visible']=1;
                }
                if($this->session->userdata('company_type')==2)
                {
                    $data['client_visible']=1;
                }
                if($this->session->userdata('company_type')==3)
                {
                    $data['vendor_visible']=1;
                }


                if(is_array($_FILES['attachment']['name']))
                {
                    $trarray=array();
                    foreach ($_FILES['attachment']['name'] as $key=>$attchter) {



                        $pic=time().$attchter;
                        $res=move_uploaded_file($_FILES['attachment']['tmp_name'][$key],'img/posts/'.$pic);
                        if($res)
                            $trarray[]=$pic;
                    }
                    $data['attachments']=implode(',',$trarray);
                }

                $this->db->insert('posts',$data);

            }





        if($this->input->post('b1')==1)
        {
            $ddr=array();
            if($data['wbs_visible']==1)
                $ddr[]=1;
            if($data['client_visible']==1)
                $ddr[]=2;
            if($data['vendor_visible']==1)
                $ddr[]=3;




            $this->load->model('assignprojectsmodel','',true);

            $postnewid=$this->db->insert_id();

            $employees=$this->assignprojectsmodel->getemployees($this->input->post('project_id'));
            foreach($employees as $valk)
            {

                $uid=$this->assignprojectsmodel->getuserid($valk);
                $name=$this->assignprojectsmodel->getusername($valk);
                $compptype=$this->assignprojectsmodel->getcomtype($valk);


                
                if($this->input->post('id'))
                {
                    $postname=$this->postsmodel->getpostuserfullname($this->input->post('id'));

                }
                else
                {
                    $postname=$this->postsmodel->getpostuserfullname($postnewid);

                }


                if(!in_array($compptype,$ddr))
                    continue;
                $notifydata=array(

                    'user_id'=>$uid,
                    'msg'=>'New Post - "'.$this->input->post('title').'" has been created in Project-"'.$this->assignprojectsmodel->getprojectname($this->input->post('project_id')).'" by "'.$postname.'".',
                    'status'=>1,


                );
                if($this->input->post('id'))
                {
                    $notifydata['link_fld']='home/notify/id/'.$this->input->post('id');
                }
                else
                {
                    $notifydata['link_fld']='home/notify/id/'.$postnewid;
                }
                $this->db->insert('notification', $notifydata);
				
				
						
			$maildata=array(
			'name'=>$name,
			'project_name'=>$this->assignprojectsmodel->getprojectname($this->input->post('project_id')),
			'post_title'=>$this->input->post('title'),
			
			);
			
			
			
			if($this->db->query("select * from users where sendemail=1 and username='".$valk."'")->num_rows()>0)
				{
								
					if($this->db->query("select * from assign_emp where isnotification=1 and username='$valk' and project_id=".$this->input->post('project_id'))->num_rows()>0)	
						
						{	
			  $this->load->library( 'email' );
                    $this->email->set_mailtype("html");
                    $this->email->from( 'no-reply@thewednesday.in', 'WBS Event Management Portal' );
                    $this->email->to($valk);
                    $this->email->subject('New Post - "'.$this->input->post('title').'" has been created in Project-"'.$this->assignprojectsmodel->getprojectname($this->input->post('project_id')).'" by "'.$postname.'".');
                    $this->email->message( $this->load->view('mail/publishpost',$maildata, true ) );
                    $this->email->send();
					
						}
				}		
				
				
            }
        }




            if($this->input->post('b1')==4)
            {




                $this->load->model('assignprojectsmodel','',true);


                $username=$this->postsmodel->getprojectapprover($this->session->userdata('company_id'),$this->input->post('project_id'));
                    $uid=$this->assignprojectsmodel->getuserid($username);
                    $name=$this->assignprojectsmodel->getusername($username);


                    $notifydata=array(

                        'user_id'=>$uid,
                        'msg'=>'New Post - "'.$this->input->post('title').'" has been recived for approval from "'.$this->session->userdata('name').'" in Project-"'.$this->assignprojectsmodel->getprojectname($this->input->post('project_id')).'"',
                        'status'=>1,
                        'link_fld'=>'posts/pending/',


                    );

                    $this->db->insert('notification', $notifydata);
					
					
									
			$maildata=array(
			'name'=>$name,
			'project_name'=>$this->assignprojectsmodel->getprojectname($this->input->post('project_id')),
			'post_title'=>$this->input->post('title'),
			
			);
			
			
			if($this->db->query("select * from users where sendemail=1 and username='".$username."'")->num_rows()>0)
				{
								
				if($this->db->query("select * from assign_emp where isnotification=1 and username='$username' and project_id=".$this->input->post('project_id'))->num_rows()>0)	
						
						{
			
			  $this->load->library( 'email' );
                    $this->email->set_mailtype("html");
                    $this->email->from( 'no-reply@thewednesday.in', 'WBS Event Management Portal' );
                    $this->email->to($username);
                    $this->email->subject('New Post - "'.$this->input->post('title').'" has been recived for approval from "'.$this->session->userdata('name').'" in Project - "'.$this->assignprojectsmodel->getprojectname($this->input->post('project_id')).'"');
                    $this->email->message( $this->load->view('mail/newpostforapp',$maildata, true ) );
                    $this->email->send();
					     
						 }
				 }		 
			




            }







        if($this->input->post('b1')==1)
        redirect('home');
        else
         redirect('posts/drafts');

    }


     public  function addcomment()
     {

         foreach ($_FILES["images"]["error"] as $key => $error) {
             if ($error == UPLOAD_ERR_OK) {
                 $name = time().$_FILES["images"]["name"][$key];
                 move_uploaded_file( $_FILES["images"]["tmp_name"][$key], "uploads/" .$name);
             }
         }


        echo "<input type='hidden' name='att[]' value='".$name."' />";

     }

    public  function commentsave()
    {


        $data=array(

            'comment_msg'=>$this->input->post('cm'),


            'created_date'=>date("Y-m-d H:i:s"),
            'user_id'=>$this->session->userdata('user_id'),

            'post_id'=>$this->input->post('post_id'),

            'location'=>'Desktop',


            'status'=>1,

        );
        $vigh=$this->input->post('att');
        if(!empty($vigh[0]))
            $data['attachment']=implode(",",$this->input->post('att'));
        $this->db->insert('comments',$data);

        $this->load->model('postsmodel','',true);


        $row['val']= $this->db->get_where('comments',array('id'=>$this->db->insert_id()))->row_array();








       // $projectid= $this->postsmodel->getpostprojectid($this->input->post('post_id'));
       // $projectname=$this->postsmodel->getprojectname($projectid);
       // $posttitle=$this->postsmodel->getposttitle($this->input->post('post_id'));

       /* $notifydata=array(

            'user_id'=>$this->postsmodel->getpostuser($this->input->post('post_id')),
            'msg'=>'"'.$this->session->userdata('name').'" commented on post - "'.$posttitle.'" in Project - "'.$projectname.'"',
            'status'=>1,
            'link_fld'=>'home/notify/id/'.$this->input->post('post_id'),

        );*/


        $projectid= $this->postsmodel->getpostprojectid($this->input->post('post_id'));
        $projectname=$this->postsmodel->getprojectname($projectid);
        $posttitle=$this->postsmodel->getposttitle($this->input->post('post_id'));


            $ddr=array();
            if($this->db->query("select * from posts where wbs_visible=1 and   id=".$this->input->post('post_id'))->num_rows()>0)
                $ddr[]=1;
            if($this->db->query("select * from posts where client_visible=1 and   id=".$this->input->post('post_id'))->num_rows()>0)
                $ddr[]=2;
            if($this->db->query("select * from posts where vendor_visible=1  and id=".$this->input->post('post_id'))->num_rows()>0)
                $ddr[]=3;




            $this->load->model('assignprojectsmodel','',true);
            $employees=$this->assignprojectsmodel->getemployees($projectid);
            foreach($employees as $valk)
            {

                $uid=$this->assignprojectsmodel->getuserid($valk);
                $name=$this->assignprojectsmodel->getusername($valk);
                $compptype=$this->assignprojectsmodel->getcomtype($valk);
                if(!in_array($compptype,$ddr))
                    continue;
                 if($uid==$this->session->userdata('user_id'))
                     continue;

                $notifydata=array(

                    'user_id'=> $uid,
                    'msg'=>'"'.$this->session->userdata('name').'" commented on post - "'.$posttitle.'" in Project - "'.$projectname.'"',
                    'status'=>1,
                    'link_fld'=>'home/notify/id/'.$this->input->post('post_id'),

                );
                $this->db->insert('notification', $notifydata);
				
				
				
				
				
				
				
				
				
				
				
				
            }


            $this->load->view('posts/ajaxcomment',$row);
    }


    function deletecomment()
    {
        $this->db->where('id',$this->input->post('val'));
        $this->db->delete('comments');
        echo "1";
    }







    public function drafts()
    {
        $this->selectedmenu='22';
        $this->load->library('pagination');
        $this->load->model('postsmodel','',true);

        $data['limit']=($this->uri->segment(4))?$this->uri->segment(4):1;
        $data['total_rows'] = $this->db->where('status !=1 and user_id='.$this->session->userdata('user_id'))->get('posts')->num_rows();

        $data['per_page'] =10;
        $data['no_of_page']=ceil($data['total_rows']/$data['per_page']);
        $data['startlimit']=($data['limit']-1)*$data['per_page'];



        $this->load->model('postsmodel','',true);
        $data['data']=$this->postsmodel->getdrafts($data['startlimit'],$data['per_page']);
        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');
        $this->load->view('posts/drafts',$data);
        $this->load->view('common/footer');

    }



    public function pending()
    {
        $this->selectedmenu='23';
        $this->load->library('pagination');
        $this->load->model('postsmodel','',true);

        $data['limit']=($this->uri->segment(4))?$this->uri->segment(4):1;
		
       // $data['total_rows'] = $this->db->query("select * from posts where status=4  and company_id=".$this->session->userdata('company_id')."  and project_id in(select project_id from assign_emp where username='".$this->session->userdata('username')."' and is_approver=1)")->num_rows();

        if($this->session->userdata('company_type')==1)
            $data['total_rows'] = $this->db->query("select * from posts where status=4  and  company_type!=2  and project_id in(select project_id from assign_emp where company_type!=2 and username='".$this->session->userdata('username')."' and is_approver=1)")->num_rows();
        else
            $data['total_rows'] = $this->db->query("select * from posts where status=4 and  company_type=2   and project_id in(select project_id from assign_emp where company_type=2 and username='".$this->session->userdata('username')."' and is_approver=1)")->num_rows();



        $data['per_page'] = 10;
        $data['no_of_page']=ceil($data['total_rows']/$data['per_page']);
        $data['startlimit']=($data['limit']-1)*$data['per_page'];



        $this->load->model('postsmodel','',true);
        $data['data']=$this->postsmodel->getpending($data['startlimit'],$data['per_page']);
        $this->load->view('common/header');
        $this->load->view('common/left');
        $this->load->view('common/main');
        $this->load->view('posts/pending',$data);
        $this->load->view('common/footer');

    }



    function delete()
    {

        $this->db->where('id',$this->uri->segment(4));
        $this->db->delete('posts');
        redirect('posts/drafts');
    }


    public  function  approvers()
    {
       $id=(int)$this->input->post('val');
        $num = $this->db->query("select * from assign_emp where username='".$this->session->userdata("username")."' and is_approver=1 and project_id=".$id)->num_rows();
        if($num>0)
        {
            $tum=$this->db->query("select * from assignprojects where add_vendors_to_project=2 and id=".$id)->num_rows();
            if($tum>0)
            {
                echo "11";

            }
            else{
                echo "1";
            }

        }
        else
        {
            echo "2";
        }

    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
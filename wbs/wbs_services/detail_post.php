<?
$con =mysql_connect("localhost:3306","admin_wbs","mrtech@123");
$db =mysql_select_db("admin_wbs",$con);

$id = $_GET['id'];
			 
$sql1 = "select id,user_id,title,location,created_date,description,attachments from posts where id='".$id."'";
$result1 =mysql_query($sql1);
$row = mysql_num_rows($result1);
	if($row>0)
	{
		while($row = mysql_fetch_array($result1))
		{
	 $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
     $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];	
	 $aa=explode("/",$pageURL);
	 $cc=$aa[0]."/".$aa[1]."/".$aa[2]."/".$aa[3]."/uploads/".$row['attachments'];
	 
	         $user_id =$row['user_id'];
			 
		     $sql4 = "select name,pic from users where id='".$user_id."'";
			 $result4 =mysql_query($sql4);
		     while($row4 = mysql_fetch_array($result4)){
			 
	         $p_user_pic =$aa[0]."/".$aa[1]."/".$aa[2]."/".$aa[3]."/img/admincompany/".$row4['pic'];
	 
			if($row['title']==NULL)
			$row['title']="";
			if($row['location']==NULL)
			$row['location']="";
			if($row['created_date']==NULL)
			$row['created_date']="";
			if($row['description']==NULL)
			$row['description']="";
			if($cc==NULL)
			$cc='';
			if($row4['name']=='NULL')
			$row4['name']="";
			if($row4['pic']=='NULL')
			$p_user_pic=$aa[0]."/".$aa[1]."/".$aa[2]."/".$aa[3]."/img/admincompany/default.jpg";
			
					
$json_array[]=array('title' =>$row['title'],'location' =>$row['location'],'created_date' =>$row['created_date'],'description' =>$row['description'],'attachments' =>$cc,'pname' =>$row4['name'],'p_user_pic' =>$p_user_pic);
		} 
		}
	echo json_encode(array('Posts'=>$json_array));	
	} else {
	 $json_array[]=array('title' =>'','location' =>'','created_date' =>'','description' =>'','attachments' =>'');
	 echo json_encode(array('No Posts'=>$json_array));	
	 }	
		
	
				 
/*
 $sql2 = "select user_id,comment_msg,attachment,created_date from comments where post_id='".$id."'";
$result2 =mysql_query($sql2);
$row2 = mysql_num_rows($result2);
	if($row2>0){
		while($row2 = mysql_fetch_array($result2))
		{
		 $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
         $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		  $aa=explode("/",$pageURL);
	      $cc=$aa[0]."/".$aa[1]."/".$aa[2]."/".$aa[3]."/uploads/".$row2['attachment'];
		 
		     $user_id =$row2['user_id'];
		     $sql5 = "select name,pic from users where id='".$user_id."'";
			 $result5 =mysql_query($sql5);
		    while($row5 = mysql_fetch_array($result5)){
			
		
	 	 
	 $aa=explode("/",$pageURL);
	 $c_user_pic=$aa[0]."/".$aa[1]."/".$aa[2]."/".$aa[3]."/img/admincompany/".$row['attachments'];
		
		
			if($row2['comment_msg']=='NULL')
			$row2['comment_msg']="";
			if($cc==NULL)
			$cc="";
			if($row2['created_date']=='NULL')
			$row2['created_date']="";
			if($row5['name']=='NULL')
			$row5['name']="";
			if($row5['pic']=='NULL')
			$c_user_pic=$aa[0]."/".$aa[1]."/".$aa[2]."/".$aa[3]."/img/admincompany/default.jpg";
					  
$json_array1[]=array('comment_msg' =>$row2['comment_msg'],'attachment' =>$cc,'created_date1' =>$row2['created_date'],'cname' =>$row5['name'],'cname' =>$row5['name'],'c_user_pic' =>$c_user_pic);
        }
		}
		echo json_encode(array('Comments'=>$json_array1));
	 }	
	 else {	
	$json_array1[]=array('comment_msg' =>'','attachment' =>'','created_date1' =>'','cname' =>'','c_user_pic' =>'');
	echo json_encode(array('No Comments'=>$json_array1));
       }
		
				*/

?>
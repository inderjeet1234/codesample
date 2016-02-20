<?php
$con =mysql_connect("localhost:3306","admin_wbs","mrtech@123");
$db =mysql_select_db("admin_wbs",$con);

$id = $_GET['id'];
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
	 $c_user_pic=$aa[0]."/".$aa[1]."/".$aa[2]."/".$aa[3]."/img/admincompany/".$row5['pic'];
		
		
			if($row2['comment_msg']==NULL)
			$row2['comment_msg']="";
			if($row2['attachment']==NULL)
			$cc="";
			if($row2['created_date']==NULL)
			$row2['created_date']="";
			if($row5['name']==NULL)
			$row5['name']="";
			if($row5['pic']==NULL)
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
		
				

?>
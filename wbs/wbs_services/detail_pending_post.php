<?
$con =mysql_connect("localhost:3306","admin_wbs","mrtech@123");
$db =mysql_select_db("admin_wbs",$con);

/*$con =mysql_connect("localhost","root","");
$db =mysql_select_db("wbs1",$con);
*/
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
			if($row['attachments']==NULL)
			$cc='';
			if($row4['name']==NULL)
			$row4['name']="";
			if($row4['pic']==NULL)
			$p_user_pic=$aa[0]."/".$aa[1]."/".$aa[2]."/".$aa[3]."/img/admincompany/default.jpg";
			
					
$json_array[]=array('title' =>$row['title'],'location' =>$row['location'],'created_date' =>$row['created_date'],'description' =>$row['description'],'attachments' =>$cc,'pname' =>$row4['name'],'p_user_pic' =>$p_user_pic);
		} 
		}
	echo json_encode(array('Posts'=>$json_array));	
	} 
	
	else {
	 $json_array[]=array('title' =>'','location' =>'','created_date' =>'','description' =>'','attachments' =>'','pname' =>'','p_user_pic' =>'',);
	 echo json_encode(array('No Pending Posts'=>$json_array));	
	 }	
		
	
				 


?>
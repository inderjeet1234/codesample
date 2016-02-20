<?
$con =mysql_connect("localhost:3306","admin_wbs","mrtech@123");
$db =mysql_select_db("admin_wbs",$con);

$user_name = $_GET['user_name'];
			 
$sql1 = "select project_id,is_approver from assign_emp where username='".$user_name."'";
$result1 =mysql_query($sql1);
$row = mysql_num_rows($result1);
	if($row>0)
	{
		while($row = mysql_fetch_array($result1))
		{
	
	         $project_id =$row['project_id'];
			 
		     $sql4 = "select project_name from projects where id='".$row['project_id']."'";
			 $result4 =mysql_query($sql4);
		     while($row4 = mysql_fetch_array($result4)){
			 
	        
	 
			if($row['project_id']==NULL)
			$row['project_id']="";
			if($row['is_approver']==NULL)
			$row['is_approver']="";
			if($row4['project_name']==NULL)
			$row4['project_name']="";
					
$json_array[]=array('project_id' =>$row['project_id'],'project_name' =>$row4['project_name'],'is_approver' =>$row['is_approver']);
		} 
		}
	echo json_encode(array('Projects'=>$json_array));	
	} else {
	 $json_array[]=array('project_id' =>$row['project_id'],'project_name' =>$row4['project_name'],'is_approver' =>$row['is_approver']);
	 echo json_encode(array('No Projects'=>$json_array));	
	 }	
		
	
				 


?>
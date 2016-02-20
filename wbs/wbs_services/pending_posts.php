<?php
$con =mysql_connect("localhost:3306","admin_wbs","mrtech@123");
$db =mysql_select_db("admin_wbs",$con);

$username = $_GET['username'];
$company_id = $_GET['company_id'];

 $sql1 = "select * from posts where status=4  and company_id='".$company_id."'  and project_id in(select project_id from assign_emp where username='".$username."' and is_approver=1)";
	$result1 =mysql_query($sql1);
	$row = mysql_num_rows($result1);
	if($row>0){
		   while($row = mysql_fetch_array($result1)){
			 $json_array[]=array('id' =>$row['id'],'title' =>$row['title'],'created_date' =>$row['created_date']);
			}
	echo json_encode(array('Record'=>$json_array));	
	}
	else {
	
	$json_array[]=array();
	
	 echo json_encode(array('No Record'=>$json_array));	
 
    }
	?>
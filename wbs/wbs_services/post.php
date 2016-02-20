<?
$con =mysql_connect("localhost:3306","admin_wbs","mrtech@123");
$db =mysql_select_db("admin_wbs",$con);


$title = $_GET['title'];
$description = $_GET['description'];
$attachments =$_GET['attachments'];
$user_id =$_GET['user_id'];
$company_id = $_GET['company_id'];
$project_id = $_GET['project_id'];
$status =$_GET['status'];
$location = $_GET['location'];
$wbs_visible = $_GET['wbs_visible'];
$client_visible = $_GET['client_visible'];
$vendor_visible = $_GET['vendor_visible'];
$company_type = $_GET['company_type'];
$rejected_reason = $_GET['rejected_reason'];

 $sql1 ="insert into   posts(title,description,attachments,created_date,user_id,company_id,project_id,status,location,wbs_visible,client_visible,vendor_visible,company_type,
rejected_reason) values('$title','$description','$attachments',NOW(),'$user_id','$company_id','$project_id','$status','$location','$wbs_visible',
'$client_visible','$vendor_visible','$company_type','$rejected_reason')";


$result1 =mysql_query($sql1);


	if($result1==true){
	
	 $json_array[]=array();
	
	 echo json_encode(array('Data Entered Sucessfully'=>$json_array));	
	
	}else {
	
	$json_array[]=array();
	
	 echo json_encode(array('Error'=>$json_array));	
 
    }


?>
 
<?
$con =mysql_connect("localhost:3306","admin_wbs","mrtech@123");
$db =mysql_select_db("admin_wbs",$con);


$username = $_GET['username'];
$company_id = (int)$_GET['company_id'];

if($company_id==1){
  $sql1 = "select id,title,created_date from posts where status=1 and wbs_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$username."') order by id desc limit 0,15";

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
}
		
elseif($company_id==2){
 $sql1 = "select * from posts where status=1 and client_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$username."') order by id desc limit 0,15";

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
	}
		
	elseif($company_id==3){
 $sql1 = "select * from posts where status=1 and vendor_visible=1 and project_id in(select em.project_id as project_id from assign_emp em,projects pp where em.project_id=pp.id and pp.status=1 and em.username='".$username."') order by id desc limit 0,15";

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
	}
else {

$json_array[]=array();
	
	 echo json_encode(array('No Record'=>$json_array));	
 
}			
	


?>

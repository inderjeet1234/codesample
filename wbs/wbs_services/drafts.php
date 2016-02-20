<?
$con =mysql_connect("localhost:3306","admin_wbs","mrtech@123");
$db =mysql_select_db("admin_wbs",$con);


$userid = $_GET['userid'];
  $sql1 = "select id,title,created_date from posts where status!=1  and user_id='".$userid."'";

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

<?
$con =mysql_connect("localhost:3306","admin_wbs","mrtech@123");
$db =mysql_select_db("admin_wbs",$con);


/*$con =mysql_connect("localhost","root","");
$db =mysql_select_db("wbs1",$con);*/
 

$username = $_GET['username'];
$password = md5($_GET['password']);

$sqls="SELECT * FROM users where username='".$username."' and password='".$password."' and status =1";
$results =mysql_query($sqls);
$aa =mysql_num_rows($results);
if($aa>0){

while($rows =mysql_fetch_array($results)){

 $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
 $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	
	$aa=explode("/",$pageURL);
	 $cc=$aa[0]."/".$aa[1]."/".$aa[2]."/".$aa[3]."/img/admincompany/".$rows['pic'];

if($rows['id']==NULL)
$rows['id']="";
if($rows['name']==NULL)
$rows['name']="";
if($rows['role']==NULL)
$rows['role']="";
if($rows['company_type']==NULL)
$rows['company_type']="";
if($rows['company_id']==NULL)
$rows['company_id']="";
if($rows['pic']==NULL)
$cc=$aa[0]."/".$aa[1]."/".$aa[2]."/".$aa[3]."/img/admincompany/default.jpg";

$json_array[]=array('id' => $rows['id'],'name' => $rows['name'], 'role' => $rows['role'], 'company_type' => $rows['company_type'], 'company_id' => $rows['company_id'], 'pic' => $cc, 'username' => $rows['username']);	

 } 
				
 echo json_encode(array('Success'=>$json_array));
 	}
else {
$rows['id']="";
$rows['name']="";
$rows['role']="";
$rows['company_type']="";
$rows['company_id']="";

$json_array[]=array('id' => $rows['id'],'name' => $rows['name'], 'role' => $rows['role'], 'company_type' => $rows['company_type'], 'company_id' => $rows['company_id'], 'pic' => $rows['pic'], 'username' => $rows['username']);	
 echo json_encode(array('Failed'=>$json_array));	

}
?>
  
<?php
include "/usr/local/apache2.4/htdocs/db.php";
$page= trim($_POST['page']);
$number= trim($_POST['number']);


$list = 30;
$start_num = ($page - 1) * $list;





$sql = "SELECT * FROM review where number = '$number' ORDER BY number DESC limit $start_num, $list;";
$res = mysqli_query($conn, $sql);



mysqli_set_charset($conn,"utf8"); 

$result = array(); 

while($row = mysqli_fetch_array($res)) 
{ array_push($result, array('writer'=>$row[2],'writeAt'=>$row[1],'contents'=>$row[3],'id'=>$row[0],'number'=>$row[4])); } 

echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE); 
mysqli_close($conn); 

?>

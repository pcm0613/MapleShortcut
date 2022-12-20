<?php
include "/usr/local/apache2.4/htdocs/db.php";
session_start();
$nickName=$_SESSION['nickName'];
$number= trim($_POST['number']);
$dislike= trim($_POST['dislike']);

$now=date("Y-m-d H:i:s");

if($dislike=='true')
{
    $increase_sql = "UPDATE post SET love = love-1 WHERE number ='$number';";
}
else
{
    $increase_sql = "UPDATE post SET love = love+1 WHERE number ='$number';";
    
}
$increase_result = mysqli_query($conn, $increase_sql);




if($dislike=='true')
{
    $lovesql = "DELETE FROM love where nickName='$nickName' and number='$number';";
}
else
{
    $lovesql = "INSERT INTO love (create_time, nickName, number) VALUES ('$now','$nickName','$number');";
}
$lovesqlResult = mysqli_query($conn, $lovesql);



$sql = "SELECT * FROM love where number = '$number';";
$res = mysqli_query($conn, $sql);


mysqli_set_charset($conn,"utf8");
$result = array(); 

while($row = mysqli_fetch_array($res)) 
{ array_push($result, array('create_time'=>$row[1],'nickName'=>$row[2])); } 




echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE); 
mysqli_close($conn); 




/* $sql2 = "SELECT * FROM post WHERE ";
$file = file_get_contents( "student.json", true);
$json = json_decode ($file, true);


$name = $json [ "name"];
$직업 = $json [ "직업"];
$age = $json [ "age"];
$sql2 = "INSERT INTO 학생 (이름, 직업, 나이) VALUES ( '$name', '$profession', $age)";
$result = $conn-> query ($sql2);
if ($result) {
    echo "성공적으로 작성되었습니다";
}


 */
?>